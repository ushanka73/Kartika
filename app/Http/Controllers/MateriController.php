<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $semuaMateri = Materi::milikUser(auth()->user());

        $materiList = $semuaMateri;

        if ($request->mapel) {
            $materiList = $materiList->where('id_mapel', $request->mapel);
        }

        if ($request->cari) {
            $materiList = $materiList->filter(function ($m) use ($request) {
                return stripos($m->judul, $request->cari) !== false;
            });
        }

        $materiPerMapel = $semuaMateri->groupBy('id_mapel');

        $mapelGuru = collect();
        $kelasGuru = collect();

        if (auth()->user()->role === 'guru') {
            $jadwalGuru = Jadwal::with('mataPelajaran', 'kelas')
                ->where('id_guru', auth()->user()->guru->id_guru)
                ->get();

            $mapelGuru = $jadwalGuru->pluck('mataPelajaran')->unique('id_mapel');
            $kelasGuru = $jadwalGuru->pluck('kelas')->unique('id_kelas');
        }

        return view('materi', compact('semuaMateri', 'materiList', 'materiPerMapel', 'mapelGuru', 'kelasGuru'));
    }

    public function store(Request $request)
    {
        $idGuru = auth()->user()->guru->id_guru;

        $this->validasi($request);

        if (! $this->mengajar($idGuru, $request)) {
            return back()
                ->withErrors(['id_kelas' => 'Anda tidak mengajar mapel ini di kelas tersebut.'])
                ->withInput();
        }

        Materi::create([
            'id_guru'   => $idGuru,
            'id_mapel'  => $request->id_mapel,
            'id_kelas'  => $request->id_kelas,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => Materi::LINK_DRIVE,
        ]);

        return back()->with('sukses', 'Materi berhasil ditambahkan.');
    }

    public function update(Request $request, Materi $materi)
    {
        $idGuru = auth()->user()->guru->id_guru;

        if ($materi->id_guru != $idGuru) {
            abort(403, 'Ini bukan materi Anda.');
        }

        $this->validasi($request);

        if (! $this->mengajar($idGuru, $request)) {
            return back()
                ->withErrors(['id_kelas' => 'Anda tidak mengajar mapel ini di kelas tersebut.'])
                ->withInput();
        }

        $materi->update([
            'id_mapel'  => $request->id_mapel,
            'id_kelas'  => $request->id_kelas,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('sukses', 'Materi berhasil diubah.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->id_guru != auth()->user()->guru->id_guru) {
            abort(403, 'Ini bukan materi Anda.');
        }

        $materi->delete();

        return back()->with('sukses', 'Materi berhasil dihapus.');
    }

    private function validasi(Request $request)
    {
        $request->validate([
            'id_mapel'  => 'required|exists:mata_pelajarans,id_mapel',
            'id_kelas'  => 'required|exists:kelas,id_kelas',
            'judul'     => 'required|max:255',
            'deskripsi' => 'nullable|max:1000',
        ], [
            'id_mapel.required' => 'Pilih mata pelajaran dulu.',
            'id_kelas.required' => 'Pilih kelas dulu.',
            'judul.required'    => 'Judul materi wajib diisi.',
            'judul.max'         => 'Judul maksimal 255 karakter.',
            'deskripsi.max'     => 'Deskripsi maksimal 1000 karakter.',
        ]);
    }

    private function mengajar($idGuru, Request $request)
    {
        return Jadwal::where('id_guru', $idGuru)
            ->where('id_mapel', $request->id_mapel)
            ->where('id_kelas', $request->id_kelas)
            ->exists();
    }
}

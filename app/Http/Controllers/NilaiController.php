<?php

namespace App\Http\Controllers;

use App\Models\NilaiAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role === 'siswa') {
            return $this->siswa($request);
        }

        $idGuru = auth()->user()->guru->id_guru;

        $query = NilaiAkhir::with(['siswa', 'kelas', 'mataPelajaran'])
            ->where('id_guru', $idGuru)
            ->where('semester', $request->input('semester', 'Ganjil'));

        if ($request->kelas) {
            $query->where('id_kelas', $request->kelas);
        }

        if ($request->cari) {
            $idSiswa = DB::table('siswas')
                ->where('nama_lengkap', 'like', '%' . $request->cari . '%')
                ->pluck('id_siswa');

            $query->whereIn('id_siswa', $idSiswa);
        }

        $nilaiList = $query->orderBy('id_kelas')->get();

        $kelasList = DB::table('kelas')->orderBy('id_kelas')->get();
        $mapelList = DB::table('mata_pelajarans')->orderBy('nama_mapel')->get();
        $siswaList = DB::table('siswas')
            ->join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
            ->select('siswas.id_siswa', 'siswas.nama_lengkap', 'kelas.tingkat', 'kelas.jurusan')
            ->orderBy('siswas.nama_lengkap')
            ->get();

        $peran    = 'guru';
        $semester = $request->input('semester', 'Ganjil');

        return view('nilai', compact('peran', 'semester', 'nilaiList', 'kelasList', 'siswaList', 'mapelList'));
    }

    public function store(Request $request)
    {
        $idGuru = auth()->user()->guru->id_guru;

        $request->validate([
            'id_siswa'     => 'required|exists:siswas,id_siswa',
            'id_mapel'     => 'required|exists:mata_pelajarans,id_mapel',
            'semester'     => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|max:20',
            'nilai_akhir'  => 'required|integer|min:0|max:100',
        ], [
            'id_siswa.required'     => 'Pilih siswa dulu.',
            'id_mapel.required'     => 'Pilih mata pelajaran dulu.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'nilai_akhir.required'  => 'Nilai wajib diisi.',
            'nilai_akhir.integer'   => 'Nilai harus berupa angka bulat.',
            'nilai_akhir.min'       => 'Nilai minimal 0.',
            'nilai_akhir.max'       => 'Nilai maksimal 100.',
        ]);

        $sudahAda = NilaiAkhir::where('id_siswa', $request->id_siswa)
            ->where('id_mapel', $request->id_mapel)
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->exists();

        if ($sudahAda) {
            return back()
                ->withErrors(['id_siswa' => 'Siswa ini sudah punya nilai untuk mapel dan semester tersebut.'])
                ->withInput();
        }

        $idKelas = DB::table('siswas')->where('id_siswa', $request->id_siswa)->value('id_kelas');
        $kkm     = DB::table('mata_pelajarans')->where('id_mapel', $request->id_mapel)->value('kkm');

        if ($request->nilai_akhir >= $kkm) {
            $keterangan = 'Tuntas';
        } else {
            $keterangan = 'Belum Tuntas';
        }

        NilaiAkhir::create([
            'id_siswa'     => $request->id_siswa,
            'id_mapel'     => $request->id_mapel,
            'id_guru'      => $idGuru,
            'id_kelas'     => $idKelas,
            'semester'     => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_akhir'  => $request->nilai_akhir,
            'keterangan'   => $keterangan,
        ]);

        return back()->with('sukses', 'Nilai berhasil ditambahkan.');
    }


    public function update(Request $request, NilaiAkhir $nilai)
    {
        if ($nilai->id_guru != auth()->user()->guru->id_guru) {
            abort(403, 'Ini bukan nilai yang Anda input.');
        }
        $request->validate([
            'id_siswa'     => 'required|exists:siswas,id_siswa',
            'id_mapel'     => 'required|exists:mata_pelajarans,id_mapel',
            'semester'     => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|max:20',
            'nilai_akhir'  => 'required|integer|min:0|max:100',
        ], [
            'id_siswa.required'     => 'Pilih siswa dulu.',
            'id_mapel.required'     => 'Pilih mata pelajaran dulu.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'nilai_akhir.required'  => 'Nilai wajib diisi.',
            'nilai_akhir.integer'   => 'Nilai harus berupa angka bulat.',
            'nilai_akhir.min'       => 'Nilai minimal 0.',
            'nilai_akhir.max'       => 'Nilai maksimal 100.',
        ]);

        $sudahAda = NilaiAkhir::where('id_siswa', $request->id_siswa)
            ->where('id_mapel', $request->id_mapel)
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->where('id_nilai', '!=', $nilai->id_nilai)
            ->exists();

        if ($sudahAda) {
            return back()
                ->withErrors(['id_siswa' => 'Siswa ini sudah punya nilai untuk mapel dan semester tersebut.'])
                ->withInput();
        }

        $idKelas = DB::table('siswas')->where('id_siswa', $request->id_siswa)->value('id_kelas');
        $kkm     = DB::table('mata_pelajarans')->where('id_mapel', $request->id_mapel)->value('kkm');


        if ($request->nilai_akhir >= $kkm) {
            $keterangan = 'Tuntas';
        } else {
            $keterangan = 'Belum Tuntas';
        }

        $nilai->update([
            'id_siswa'     => $request->id_siswa,
            'id_mapel'     => $request->id_mapel,
            'id_kelas'     => $idKelas,
            'semester'     => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_akhir'  => $request->nilai_akhir,
            'keterangan'   => $keterangan,
        ]);

        return back()->with('sukses', 'Nilai berhasil diubah.');
    }


    public function destroy(NilaiAkhir $nilai)
    {
        if ($nilai->id_guru != auth()->user()->guru->id_guru) {
            abort(403, 'Ini bukan nilai yang Anda input.');
        }
        $nilai->delete();

        return back()->with('sukses', 'Nilai berhasil dihapus.');
    }

    public function siswa(Request $request)
    {
        $siswa    = auth()->user()->siswa;
        $semester = $request->input('semester', 'Ganjil');

        $nilaiList = NilaiAkhir::with('mataPelajaran', 'guru')
            ->where('id_siswa', $siswa->id_siswa)
            ->where('semester', $semester)
            ->get();

        $peran = 'siswa';

        return view('nilai', compact('peran', 'siswa', 'semester', 'nilaiList'));
    }
}

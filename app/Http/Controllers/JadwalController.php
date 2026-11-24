<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $hariList      = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hariIni       = Jadwal::hariIni();
        $jadwalPerHari = Jadwal::milikUser(auth()->user());

        // pilihan dropdown untuk form admin
        $kelasList = Kelas::orderBy('tingkat')->orderBy('jurusan')->get();
        $mapelList = MataPelajaran::orderBy('nama_mapel')->get();
        $guruList  = Guru::orderBy('nama_lengkap')->get();

        return view('jadwal', compact('hariList', 'hariIni', 'jadwalPerHari', 'kelasList', 'mapelList', 'guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas'     => 'required|exists:kelas,id_kelas',
            'id_mapel'     => 'required|exists:mata_pelajarans,id_mapel',
            'id_guru'      => 'required|exists:gurus,id_guru',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
            'ruang'        => 'required|max:50',
            'semester'     => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|max:20',
        ], [
            'id_kelas.required'     => 'Pilih kelas dulu.',
            'id_mapel.required'     => 'Pilih mata pelajaran dulu.',
            'id_guru.required'      => 'Pilih guru dulu.',
            'hari.required'         => 'Pilih hari dulu.',
            'jam_mulai.required'    => 'Jam mulai wajib diisi.',
            'jam_selesai.required'  => 'Jam selesai wajib diisi.',
            'jam_selesai.after'     => 'Jam selesai harus setelah jam mulai.',
            'ruang.required'        => 'Ruang wajib diisi.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
        ]);

        Jadwal::create([
            'id_kelas'     => $request->id_kelas,
            'id_mapel'     => $request->id_mapel,
            'id_guru'      => $request->id_guru,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'ruang'        => $request->ruang,
            'semester'     => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return back()->with('sukses', 'Jadwal berhasil ditambahkan.');
    }


    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'id_kelas'     => 'required|exists:kelas,id_kelas',
            'id_mapel'     => 'required|exists:mata_pelajarans,id_mapel',
            'id_guru'      => 'required|exists:gurus,id_guru',
            'hari'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
            'ruang'        => 'required|max:50',
            'semester'     => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|max:20',
        ], [
            'id_kelas.required'     => 'Pilih kelas dulu.',
            'id_mapel.required'     => 'Pilih mata pelajaran dulu.',
            'id_guru.required'      => 'Pilih guru dulu.',
            'hari.required'         => 'Pilih hari dulu.',
            'hari.in'               => 'Hari harus Senin sampai Sabtu.',
            'jam_mulai.required'    => 'Jam mulai wajib diisi.',
            'jam_selesai.required'  => 'Jam selesai wajib diisi.',
            'jam_selesai.after'     => 'Jam selesai harus setelah jam mulai.',
            'ruang.required'        => 'Ruang wajib diisi.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
        ]);

        $jadwal->update([
            'id_kelas'     => $request->id_kelas,
            'id_mapel'     => $request->id_mapel,
            'id_guru'      => $request->id_guru,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'ruang'        => $request->ruang,
            'semester'     => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return back()->with('sukses', 'Jadwal berhasil diubah.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return back()->with('sukses', 'Jadwal berhasil dihapus.');
    }

}

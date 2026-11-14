<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        // Materi dibuat dari jadwal yang ada, sehingga guru, mapel, dan kelas selalu cocok.
        $jadwals = DB::table('jadwals')
            ->join('mata_pelajarans', 'jadwals.id_mapel', '=', 'mata_pelajarans.id_mapel')
            ->select('jadwals.id_guru', 'jadwals.id_mapel', 'jadwals.id_kelas', 'mata_pelajarans.nama_mapel', 'mata_pelajarans.kode_mapel')
            ->get();

        foreach ($jadwals as $j) {
            DB::table('materis')->insert([
                'id_guru' => $j->id_guru,
                'id_mapel' => $j->id_mapel,
                'id_kelas' => $j->id_kelas,
                'judul' => 'Pengantar ' . $j->nama_mapel,
                'deskripsi' => 'Materi pertemuan pertama ' . $j->nama_mapel . ' semester ganjil.',
                'file_path' => 'materi/' . strtolower($j->kode_mapel) . '-kelas' . $j->id_kelas . '-pertemuan1.pdf',
                'tanggal_upload' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

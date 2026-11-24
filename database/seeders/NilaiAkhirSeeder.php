<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiAkhirSeeder extends Seeder
{
    public function run(): void
    {
        $kkm = DB::table('mata_pelajarans')->pluck('kkm', 'id_mapel');
        $siswas = DB::table('siswas')->get();

        foreach ($siswas as $siswa) {
            $jadwals = DB::table('jadwals')->where('id_kelas', $siswa->id_kelas)->get();
            
            foreach ($jadwals as $jadwal) {
                foreach (['Ganjil','Genap'] as $smester){
                $nilai = rand(60, 98);

                DB::table('nilai_akhirs')->insert([
                    'id_siswa' => $siswa->id_siswa,
                    'id_mapel' => $jadwal->id_mapel,
                    'id_guru' => $jadwal->id_guru,
                    'id_kelas' => $siswa->id_kelas,
                    'semester' => $smester,
                    'tahun_ajaran' => '2026/2027',
                    'nilai_akhir' => $nilai,
                    'keterangan' => $nilai >= $kkm[$jadwal->id_mapel] ? 'Tuntas' : 'Belum Tuntas',
                    'tanggal_input' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                }
            }
        }
    }
}

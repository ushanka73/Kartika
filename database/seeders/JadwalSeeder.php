<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = DB::table('kelas')->orderBy('id_kelas')->pluck('id_kelas')->all();
        $mapel = DB::table('mata_pelajarans')->pluck('id_mapel', 'kode_mapel');
        $guru = DB::table('gurus')->pluck('id_guru', 'nip');

        // [index kelas, kode mapel, nip guru, hari, jam mulai, jam selesai, ruang]
        $jadwals = [
            [0, 'MTK', '198501012010011001', 'Senin', '07:00', '08:30', 'R-101'],
            [0, 'BIN', '198703152011012002', 'Selasa', '08:30', '10:00', 'R-101'],
            [0, 'FIS', '199008202015011003', 'Rabu', '10:15', '11:45', 'Lab Fisika'],
            [1, 'MTK', '198501012010011001', 'Senin', '08:30', '10:00', 'R-201'],
            [1, 'BIN', '198703152011012002', 'Kamis', '07:00', '08:30', 'R-201'],
            [1, 'BIG', '198703152011012002', 'Jumat', '07:00', '08:30', 'R-201'],
            [2, 'MTK', '198501012010011001', 'Selasa', '07:00', '08:30', 'R-301'],
            [2, 'FIS', '199008202015011003', 'Kamis', '10:15', '11:45', 'Lab Fisika'],
            [2, 'BIG', '198703152011012002', 'Sabtu', '07:00', '08:30', 'R-301'],
        ];

        foreach ($jadwals as [$k, $kode, $nip, $hari, $mulai, $selesai, $ruang]) {
            DB::table('jadwals')->insert([
                'id_kelas' => $kelas[$k],
                'id_mapel' => $mapel[$kode],
                'id_guru' => $guru[$nip],
                'hari' => $hari,
                'jam_mulai' => $mulai,
                'jam_selesai' => $selesai,
                'ruang' => $ruang,
                'semester' => 'Ganjil',
                'tahun_ajaran' => '2026/2027',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

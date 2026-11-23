<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $admin = DB::table('users')->where('username', 'admin')->value('id_user');
        $guru = DB::table('users')->where('username', 'guru1')->value('id_user');

        $pengumumans = [
            [
                'judul' => 'Jadwal Penilaian Tengah Semester',
                'isi' => 'Penilaian Tengah Semester Ganjil akan dilaksanakan pada minggu ketiga bulan Oktober. Siswa diharap mempersiapkan diri.',
                'id_user' => $admin,
                'tanggal_kadaluarsa' => now()->addMonth(),
            ],
            [
                'judul' => 'Libur Nasional',
                'isi' => 'Kegiatan belajar mengajar diliburkan sesuai kalender akademik pada hari libur nasional.',
                'id_user' => $admin,
                'tanggal_kadaluarsa' => now()->addMonth(),
            ],
            [
                'judul' => 'Pengumpulan Tugas Matematika',
                'isi' => 'Tugas Matematika bab 1 dikumpulkan paling lambat hari Jumat.',
                'id_user' => $guru,
                'tanggal_kadaluarsa' => now()->addWeek(),
            ],
        ];

        foreach ($pengumumans as $p) {
            DB::table('pengumumen')->insert($p + [
                'tanggal_posting' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

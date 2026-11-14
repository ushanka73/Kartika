<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluhanSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = DB::table('siswas')->pluck('id_siswa', 'nisn');

        $keluhans = [
            ['0091234561', 'AC kelas rusak', 'AC di ruang R-101 tidak dingin sejak minggu lalu.', 'Fasilitas', 'Diproses'],
            ['0081234563', 'Materi sulit dipahami', 'Mohon tambahan penjelasan untuk materi trigonometri.', 'Akademik', 'Selesai'],
            ['0071234566', 'Antrean perpustakaan', 'Pelayanan peminjaman buku di perpustakaan terlalu lama.', 'Pelayanan', 'Menunggu'],
            ['0081234564', 'Kantin kotor', 'Area kantin sering kotor setelah jam istirahat.', 'Lainnya', 'Ditolak'],
        ];

        foreach ($keluhans as [$nisn, $judul, $isi, $kategori, $status]) {
            DB::table('keluhans')->insert([
                'id_siswa' => $siswa[$nisn],
                'judul' => $judul,
                'isi' => $isi,
                'kategori' => $kategori,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

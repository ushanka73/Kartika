<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = [
            ['MTK', 'Matematika', 'Aljabar, geometri, trigonometri, dan statistika.', 75],
            ['BIN', 'Bahasa Indonesia', 'Keterampilan membaca, menulis, berbicara, dan menyimak.', 75],
            ['FIS', 'Fisika', 'Mekanika, termodinamika, gelombang, dan listrik.', 70],
            ['BIG', 'Bahasa Inggris', 'Grammar, reading, writing, dan speaking.', 75],
        ];

        foreach ($mapels as [$kode, $nama, $deskripsi, $kkm]) {
            DB::table('mata_pelajarans')->insert([
                'kode_mapel' => $kode,
                'nama_mapel' => $nama,
                'deskripsi' => $deskripsi,
                'kkm' => $kkm,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

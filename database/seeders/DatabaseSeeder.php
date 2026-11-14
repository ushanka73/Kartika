<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan mengikuti foreign key di migration.
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            GuruSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            MataPelajaranSeeder::class,
            JadwalSeeder::class,
            MateriSeeder::class,
            NilaiAkhirSeeder::class,
            PengumumanSeeder::class,
            KeluhanSeeder::class,
            TindakLanjutKeluhanSeeder::class,
        ]);
    }
}

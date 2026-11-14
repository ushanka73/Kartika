<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'id_user' => DB::table('users')->where('username', 'admin')->value('id_user'),
            'nama_lengkap' => 'Rina Kartika',
            'jenis_kelamin' => 'Perempuan',
            'email' => 'admin@sekolah.sch.id',
            'no_telepon' => '081200000001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

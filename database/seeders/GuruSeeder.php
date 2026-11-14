<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            [
                'username' => 'guru1',
                'nip' => '198501012010011001',
                'nama_lengkap' => 'Budi Santoso, S.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-01-01',
                'alamat' => 'Jl. Merdeka No. 10, Bandung',
                'no_telepon' => '081211110001',
                'email' => 'budi.santoso@sekolah.sch.id',
                'pendidikan_terakhir' => 'S1 Pendidikan Matematika',
            ],
            [
                'username' => 'guru2',
                'nip' => '198703152011012002',
                'nama_lengkap' => 'Siti Aminah, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1987-03-15',
                'alamat' => 'Jl. Malioboro No. 25, Yogyakarta',
                'no_telepon' => '081211110002',
                'email' => 'siti.aminah@sekolah.sch.id',
                'pendidikan_terakhir' => 'S1 Pendidikan Bahasa Indonesia',
            ],
            [
                'username' => 'guru3',
                'nip' => '199008202015011003',
                'nama_lengkap' => 'Agus Wijaya, M.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1990-08-20',
                'alamat' => 'Jl. Pahlawan No. 5, Surabaya',
                'no_telepon' => '081211110003',
                'email' => 'agus.wijaya@sekolah.sch.id',
                'pendidikan_terakhir' => 'S2 Pendidikan Fisika',
            ],
        ];

        foreach ($gurus as $guru) {
            $username = $guru['username'];
            unset($guru['username']);

            DB::table('gurus')->insert($guru + [
                'id_user' => DB::table('users')->where('username', $username)->value('id_user'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

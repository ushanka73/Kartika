<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            ['nip' => '198501012010011001', 'tingkat' => 'X', 'jurusan' => 'IPA'],
            ['nip' => '198703152011012002', 'tingkat' => 'XI', 'jurusan' => 'IPS'],
            ['nip' => '199008202015011003', 'tingkat' => 'XII', 'jurusan' => 'IPA'],
        ];

        foreach ($kelas as $k) {
            DB::table('kelas')->insert([
                'wali_kelas' => DB::table('gurus')->where('nip', $k['nip'])->value('id_guru'),
                'tingkat' => $k['tingkat'],
                'jurusan' => $k['jurusan'],
                'tahun_ajaran' => '2026/2027',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

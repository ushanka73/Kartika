<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = DB::table('kelas')->orderBy('id_kelas')->pluck('id_kelas')->all();

        $siswas = [
            ['siswa1', '0091234561', 'Andi Pratama', 'Laki-laki', 'Jakarta', '2010-02-11', 0],
            ['siswa2', '0091234562', 'Dewi Lestari', 'Perempuan', 'Bogor', '2010-05-23', 0],
            ['siswa3', '0081234563', 'Rizky Ramadhan', 'Laki-laki', 'Depok', '2009-09-07', 1],
            ['siswa4', '0081234564', 'Putri Anggraini', 'Perempuan', 'Bekasi', '2009-12-30', 1],
            ['siswa5', '0071234565', 'Fajar Nugroho', 'Laki-laki', 'Tangerang', '2008-04-18', 2],
            ['siswa6', '0071234566', 'Nabila Zahra', 'Perempuan', 'Bandung', '2008-07-02', 2],
        ];

        foreach ($siswas as $i => [$username, $nisn, $nama, $jk, $tempat, $tgl, $kelasIndex]) {
            DB::table('siswas')->insert([
                'id_user' => DB::table('users')->where('username', $username)->value('id_user'),
                'nisn' => $nisn,
                'nama_lengkap' => $nama,
                'jenis_kelamin' => $jk,
                'tempat_lahir' => $tempat,
                'tanggal_lahir' => $tgl,
                'alamat' => 'Jl. Pendidikan No. ' . ($i + 1) . ', ' . $tempat,
                'no_telepon' => '08573333000' . ($i + 1),
                'email' => $username . '@siswa.sekolah.sch.id',
                'id_kelas' => $kelas[$kelasIndex],
                'tahun_ajaran' => '2026/2027',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

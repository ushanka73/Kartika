<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');
        $now = now();

        $users = [
            ['username' => 'admin', 'role' => 'admin'],
            ['username' => 'guru1', 'role' => 'guru'],
            ['username' => 'guru2', 'role' => 'guru'],
            ['username' => 'guru3', 'role' => 'guru'],
            ['username' => 'siswa1', 'role' => 'siswa'],
            ['username' => 'siswa2', 'role' => 'siswa'],
            ['username' => 'siswa3', 'role' => 'siswa'],
            ['username' => 'siswa4', 'role' => 'siswa'],
            ['username' => 'siswa5', 'role' => 'siswa'],
            ['username' => 'siswa6', 'role' => 'siswa'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'username' => $user['username'],
                'password' => $password,
                'role' => $user['role'],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}

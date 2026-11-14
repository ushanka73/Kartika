<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TindakLanjutKeluhanSeeder extends Seeder
{
    public function run(): void
    {
        $admin = DB::table('admins')->value('id_admin');

        $tanggapan = [
            'Diproses' => 'Keluhan sudah diteruskan ke bagian sarana prasarana dan sedang ditangani.',
            'Selesai' => 'Guru mata pelajaran sudah mengadakan sesi tambahan. Keluhan dinyatakan selesai.',
            'Ditolak' => 'Kebersihan kantin menjadi tanggung jawab bersama; keluhan tidak dapat ditindaklanjuti.',
        ];

        // Hanya keluhan yang sudah ditanggapi (bukan "Menunggu") yang punya tindak lanjut.
        $keluhans = DB::table('keluhans')->where('status', '!=', 'Menunggu')->get();

        foreach ($keluhans as $keluhan) {
            DB::table('tindak_lanjut_keluhans')->insert([
                'id_keluhan' => $keluhan->id_keluhan,
                'id_admin' => $admin,
                'tanggapan' => $tanggapan[$keluhan->status],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

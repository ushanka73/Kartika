<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_kelas',
        'id_mapel',
        'id_guru',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'semester',
        'tahun_ajaran',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    public static function hariIni()
    {
        $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hariIni = $namaHari[now('Asia/Jakarta')->dayOfWeek];
        return $hariIni;
    }

    public static function milikUser($user)
    {
        $query = Jadwal::with('mataPelajaran','kelas','guru')
            ->orderBy('jam_mulai');

        if ($user->role === 'guru') {
        $query->where('id_guru', $user->guru->id_guru);
        } elseif ($user->role === 'siswa') {
            $query->where('id_kelas', $user->siswa->id_kelas);
        }

        return $query->get()->groupBy('hari');
    }
}

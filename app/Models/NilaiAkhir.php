<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'id_guru',
        'id_kelas',
        'semester',
        'tahun_ajaran',
        'nilai_akhir',
        'keterangan',
        'tanggal_input',
    ];

    protected $casts = [
        'nilai_akhir'   => 'integer',
        'tanggal_input' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}

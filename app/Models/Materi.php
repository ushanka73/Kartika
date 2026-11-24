<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    const LINK_DRIVE = 'https://drive.google.com/drive/folders/15QnGZVSf9Qci60Nw0w-AlbHDM0K5Z5-V';
    
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'id_kelas',
        'judul',
        'deskripsi',
        'file_path',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public static function milikUser($user)
    {
        $query = Materi::with('mataPelajaran', 'guru', 'kelas')
            ->orderByDesc('tanggal_upload');

        if ($user->role === 'guru') {
            $query->where('id_guru', $user->guru->id_guru);
        } elseif ($user->role === 'siswa') {
            $query->where('id_kelas', $user->siswa->id_kelas);
        }

        return $query->get();
    }
}

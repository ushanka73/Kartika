<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'wali_kelas',
        'tingkat',
        'jurusan',
        'tahun_ajaran',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'wali_kelas', 'id_guru');
    }
}

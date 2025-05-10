<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuatanPelajaran extends Model
{
    use HasFactory;

    protected $table = 'muatan_pelajaran';

    protected $fillable = [
        'nama_muatan_pelajaran',
        'id_guru',
        'id_kelas',
        'is_mulok',
        'kkm',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}

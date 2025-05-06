<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidik extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'peserta_didik';
    protected $primaryKey = 'nisn';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nisn',
        'nama_peserta_didik',
        'nis',
        'id_kelas',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan_sebelumnya',
        'alamat_peserta_didik',
        'nama_orang_tua',
        'alamat_orang_tua',
        'wali_peserta_didik',
        'alamat_wali_peserta_didik'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}

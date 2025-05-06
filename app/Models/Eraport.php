<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eraport extends Model
{
    use HasFactory;

    protected $table = 'e_raport';

    protected $fillable = [
        'nisn',
        'id_kelas',
        'sakit',
        'izin',
        'tanpa_keterangan',
        'catatan',
        'naik_kelas',
        'tinggal_kelas',
        'tahun',
        'semester'
    ];

    public function siswa()
    {
        return $this->belongsTo(PesertaDidik::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function prestasi()
    {
        return $this->hasMany(EraportPrestasi::class, 'e_raport_id');
    }

    public function ekstrakurikuler()
    {
        return $this->hasMany(EraportEkstrakurikuler::class, 'e_raport_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table ='nilai';
    protected $fillable = ['nisn', 'id_muatan_pelajaran','id_kelas', 'tahun', 'semester'];

    public function siswa()
    {
        return $this->belongsTo(PesertaDidik::class, 'nisn', 'nisn');
    }

    public function muatan()
    {
        return $this->belongsTo(MuatanPelajaran::class, 'id_muatan_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function details()
    {
        return $this->hasMany(DetailNilai::class);
    }
}

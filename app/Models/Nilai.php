<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table ='nilai';
    protected $fillable = ['nisn', 'id_muatan_pelajaran','id_kelas', 'tahun', 'semester','guru_id'];

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

    public function rataRata()
    {
        return $this->details->avg('nilai'); // ambil rata-rata dari relasi detail
    }

    public function predikat()
    {
        $rata = $this->rataRata();

        if ($rata < 75) {
            return 'D';
        } elseif ($rata <= 83) {
            return 'C';
        } elseif ($rata <= 92) {
            return 'B';
        } elseif ($rata <= 100) {
            return 'A';
        } else {
            return '-';
        }
    }

    public function capaianKompetensi()
    {
        return $this->details->pluck('capaian_kompetensi')->filter()->unique()->implode(', ');
    }
}

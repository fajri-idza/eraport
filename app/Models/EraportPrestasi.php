<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EraportPrestasi extends Model
{
    use HasFactory;

    protected $table = 'e_raport_prestasi';

    protected $fillable = [
        'e_raport_id', 'nama_prestasi', 'nilai'
    ];

    public function eraport()
    {
        return $this->belongsTo(Eraport::class, 'e_raport_id');
    }
}

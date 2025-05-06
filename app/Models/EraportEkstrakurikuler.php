<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EraportEkstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'e_raport_ekstrakurikuler';

    protected $fillable = [
        'e_raport_id', 'nama_ekstrakurikuler', 'nilai'
    ];

    public function eraport()
    {
        return $this->belongsTo(Eraport::class, 'e_raport_id');
    }
}

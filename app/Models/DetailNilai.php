<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNilai extends Model
{
    use HasFactory;

    protected $table = 'detail_nilai';
    protected $fillable = ['nilai_id', 'materi', 'nilai'];

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
}

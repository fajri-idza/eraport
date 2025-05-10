<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{

    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nama', 'jabatan', 'user_name', 'password',
        'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'hp', 'email', 'alamat', 'type', 'nip'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}

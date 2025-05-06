<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

    protected $table = 'admin'; // pastikan ini nama tabel kamu
    public $incrementing = false;

    protected $primaryKey = 'npsn';

    protected $fillable = [
        'npsn','nama_sekolah','nama_kepala_sekolah','nip_kepala_sekolah','email', 'password',
        'username', 'nama',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('admin')->insert([
            'npsn' => random_int(1000000000, 9999999999), // 10 angka random
            'nama_sekolah' => 'SDN 33 SELUMA',
            'nama_kepala_sekolah' => 'Budi Santoso',
            'nip_kepala_sekolah' => 197812312022121001, // contoh NIP panjang
            'username' => 'admin',
            'password' => bcrypt('admin'), // harus hash password ya
            'nama' => 'Admin',
            'email' => 'admin@admin.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

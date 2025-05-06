<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->unsignedBigInteger('npsn')->primary();
            $table->string('nama_sekolah',30);
            $table->string('nama_kepala_sekolah',30);
            $table->unsignedBigInteger('nip_kepala_sekolah');
            $table->string('username',30);
            $table->string('password');
            $table->string('nama',30);
            $table->string('email')->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};

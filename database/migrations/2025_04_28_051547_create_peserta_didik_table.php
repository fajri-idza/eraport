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
        Schema::create('peserta_didik', function (Blueprint $table) {
            $table->unsignedBigInteger('nisn')->primary();
            $table->string('nama_peserta_didik',30);
            $table->integer('nis');
            $table->unsignedBigInteger('id_kelas');
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',10);
            $table->string('agama',10);
            $table->string('pendidikan_sebelumnya',10);
            $table->string('alamat_peserta_didik',100);
            $table->string('nama_orang_tua',30);
            $table->string('alamat_orang_tua',100);
            $table->string('wali_peserta_didik',30)->nullable();
            $table->string('alamat_wali_peserta_didik',100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik');
    }
};

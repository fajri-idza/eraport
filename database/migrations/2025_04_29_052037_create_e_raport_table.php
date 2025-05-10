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
        Schema::create('e_raport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nisn');
            $table->unsignedBigInteger('id_kelas');
            $table->string('sakit',30);
            $table->string('izin',30);
            $table->string('tanpa_keterangan',30);
            $table->string('catatan',200);
            $table->string('naik_kelas',30);
            $table->string('tinggal_kelas',30);
            $table->year('tahun');
            $table->integer('semester');
            $table->date('tanggal_cetak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_raport');
    }
};

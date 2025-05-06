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
        Schema::create('e_raport_prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('e_raport_id');
            $table->string('nama_prestasi',100);
            $table->string('nilai',50);
            $table->timestamps();

            $table->foreign('e_raport_id')->references('id')->on('e_raport')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_raport_prestasi');
    }
};

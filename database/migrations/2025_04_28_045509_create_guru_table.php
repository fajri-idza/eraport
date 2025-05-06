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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama',30);
            $table->string('jabatan',30);
            $table->string('user_name',30);
            $table->string('password');
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin',15);
            $table->string('hp',15);
            $table->string('email')->unique();
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};

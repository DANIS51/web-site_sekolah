<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('db_profil_sekolah_ekstrakurikuler', function (Blueprint $table) {
            $table->id('id_ekskul');
            $table->string('nama_ekskul', 40);
            $table->string('pembina', 40);
            $table->string('jadwal_latihan', 40);
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->string('gambar', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('db_profil_sekolah_ekstrakurikuler');
    }
};

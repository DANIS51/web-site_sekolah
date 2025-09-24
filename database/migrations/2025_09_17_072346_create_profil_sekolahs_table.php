<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('db_profil_sekolah_profil_sekolah', function (Blueprint $table) {
            $table->id('id_profil');
            $table->string('nama_sekolah', 40);
            $table->string('kepala_sekolah', 40);
            $table->string('foto', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('npsn', 10);
            $table->text('alamat');
            $table->string('kontak', 15);
            $table->text('visi_misi');
            $table->year('tahun_berdiri');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('db_profil_sekolah_profil_sekolah');
    }
};

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
        Schema::create('db_profil_sekolah_berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul',50);
            $table->text('isi');
            $table->date('tanggal' );
            $table->string('gambar',100)->nullable();
            $table->foreignId('id_user')->constrained('db_profil_sekolah_user','id_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_profil_sekolah_berita');
    }
};

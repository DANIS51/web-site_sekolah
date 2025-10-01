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
        Schema::create('db_profil_sekolah_guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('nama_guru', 40);
            $table->string('nip', 15)->unique();
            $table->string('alamat');
            $table->string('mapel', 40);
            $table->string('email')->unique();
            $table->string('telepon', 15)->unique();
            $table->string('foto', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_profil_sekolah_guru');
    }
};

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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('nama', 100);
            $table->string('nip', 20)->unique();
            $table->string('alamat');
            $table->string('mapel', 50);
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
        Schema::dropIfExists('gurus');
    }
};

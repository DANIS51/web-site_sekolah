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
        Schema::create('db_profil_sekolah_user', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('username',30)->unique();
            $table->string('password',255);
            $table->enum('role',['Admin','Operator']);
            $table->string('foto', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_profil_sekolah_user');
    }
};

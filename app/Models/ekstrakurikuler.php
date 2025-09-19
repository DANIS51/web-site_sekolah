<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'nama',
        'jadwal',
        'pelatih',
        'deskripsi',
        'tanggal',
        'gambar',
    ];
}

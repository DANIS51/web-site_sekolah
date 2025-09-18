<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    Use HasFactory;
    protected $primaryKey = 'id_siswa';
    protected $table = 'siswas';

    protected $fillable = [
        'nism',
        'nama_siswa',
        'jenis_kelamin',
        'tahun_masuk',
    ];
}

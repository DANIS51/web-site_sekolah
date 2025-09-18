<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    //
    protected $primaryKey = 'id_galeri';
    protected $table = 'galeris';
    protected $fillable = [
        'judul',
        'keterangan',
        'file',
        'kategori',
        'tanggal',
    ];
}

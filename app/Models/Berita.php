<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_berita';
    protected $table = 'beritas';
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'gambar',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

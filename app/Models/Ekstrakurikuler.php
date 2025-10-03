<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'db_profil_sekolah_ekstrakurikuler';
    protected $primaryKey = 'id_ekskul';

    protected $fillable = [
        'nama_ekskul',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'tanggal',
        'gambar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($ekstrakurikuler) {
            if ($ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar))) {
                unlink(public_path('storage/' . $ekstrakurikuler->gambar));
            }
        });
    }
}

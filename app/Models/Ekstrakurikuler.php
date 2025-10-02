<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
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

    /**
     * Get the full URL for gambar
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset($this->gambar) : null;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ekstrakurikuler) {
            if ($ekstrakurikuler->gambar && file_exists(public_path($ekstrakurikuler->gambar))) {
                unlink(public_path($ekstrakurikuler->gambar));
            }
        });
    }
}

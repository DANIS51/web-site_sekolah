<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $primaryKey = 'id_galeri';
    protected $table = 'db_profil_sekolah_galeri';
    protected $fillable = [
        'judul',
        'keterangan',
        'file',
        'kategori',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the full URL for file
     */
    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($galeri) {
            if ($galeri->file && Storage::exists('public/' . $galeri->file)) {
                Storage::delete('public/' . $galeri->file);
            }
        });
    }
}

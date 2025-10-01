<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_berita';
    protected $table = 'db_profil_sekolah_berita';
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'gambar',
        'id_user',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the full URL for gambar
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($berita) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
        });
    }
}

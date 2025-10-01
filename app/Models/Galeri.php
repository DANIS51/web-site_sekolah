<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
     * Get the MIME type of the file
     */
    public function getMimeTypeAttribute()
    {
        if (!$this->file) {
            return null;
        }

        $fullPath = storage_path('app/public/' . $this->file);
        if (File::exists($fullPath)) {
            return File::mimeType($fullPath);
        }

        // Fallback to extension mapping
        $extension = pathinfo($this->file, PATHINFO_EXTENSION);
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'mp4' => 'video/mp4',
            'avi' => 'video/x-msvideo',
            'mov' => 'video/quicktime',
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
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

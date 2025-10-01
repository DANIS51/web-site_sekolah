<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfilSekolah extends Model
{
    protected $table = 'db_profil_sekolah_profil_sekolah';

    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'foto',
        'logo',
        'npsn',
        'alamat',
        'kontak',
        'visi_misi',
        'tahun_berdiri',
        'deskripsi',
    ];

    protected $casts = [
        'tahun_berdiri' => 'integer',
    ];

    /**
     * Get the full URL for foto
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

    /**
     * Get the full URL for logo
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($profil) {
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
        });
    }
}

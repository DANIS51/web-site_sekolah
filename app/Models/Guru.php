<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'db_profil_sekolah_guru';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama_guru',
        'nip',
        'alamat',
        'mapel',
        'email',
        'telepon',
        'foto',
    ];

    /**
     * Get the full URL for foto
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($guru) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Siswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_siswa';
    protected $table = 'db_profil_sekolah_siswa';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tahun_masuk',
        'alamat',
        'foto',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
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

        static::deleting(function ($siswa) {
            if ($siswa->foto && Storage::exists('public/' . $siswa->foto)) {
                Storage::delete('public/' . $siswa->foto);
            }
        });
    }
}

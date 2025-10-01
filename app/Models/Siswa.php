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
<<<<<<< HEAD
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
=======
            if ($siswa->foto && Storage::exists('public/' . $siswa->foto)) {
                Storage::delete('public/' . $siswa->foto);
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
            }
        });
    }
}

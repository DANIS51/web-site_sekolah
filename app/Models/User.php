<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    protected $primaryKey = 'id_user';
    protected $table = 'db_profil_sekolah_user';

    protected $fillable = [
        'username',
        'password',
        'role',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_user', 'id_user');
    }

    public function identitas()
    {
        return $this->username;
    }

    public function resetPw()
    {
        return $this->username;
    }

    public function NcekAdmin()
    {
        return $this->role === 'Admin';
    }

    public function NcekOperator()
    {
        return $this->role === 'Operator';
    }

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

        static::deleting(function ($user) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
        });
    }

    public function save(array $options = [])
    {
        return parent::save($options);
    }
}

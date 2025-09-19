<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $primaryKey = 'id_user';
    protected $table = 'users';

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
        return $this->role === 'admin';
    }

    public function NcekOperator()
    {
        return $this->role === 'operator';
    }

    
}

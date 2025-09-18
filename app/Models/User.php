<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $primaryKey = 'id_user';
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',

    ];

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
        return $this->role === 'Operator';
    }

    
}

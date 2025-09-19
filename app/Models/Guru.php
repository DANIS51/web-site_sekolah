<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama',
        'nip',
        'alamat',
        'mapel',
        'email',
        'telepon',
        'foto',
    ];
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function guru()
    {
        $gurus = Guru::all();
        return view('admin.guru.index', compact('gurus'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function ekstrakurikulera()
    {
        $ekstrakurikulera = ekstrakurikuler::all();
        return view('admin.ekstrakurikulera.index', compact('ekstrakurikulera'));
    }

    // public function StoreEskul(){
    //     $validasi = $request->validate([
            
    //     ]);
    // }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerPublicController extends Controller
{
    /**
     * Display all ekstrakurikuler (extracurricular activities)
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::orderBy('tanggal', 'desc')->paginate(12);

        return view('public.ekstrakurikuler', compact('ekstrakurikuler'));
    }
}

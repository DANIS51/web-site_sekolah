<?php

// Namespace untuk controller ekstrakurikuler public
namespace App\Http\Controllers;

// Import request dan model ekstrakurikuler
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

// Class EkstrakurikulerPublicController yang mengextends Controller
class EkstrakurikulerPublicController extends Controller
{
    /**
     * Display all ekstrakurikuler (extracurricular activities)
     */
    // Method untuk menampilkan daftar ekstrakurikuler di halaman public
    public function index()
    {
        // Ambil data ekstrakurikuler dengan urutan tanggal terbaru dan pagination 12 per halaman
        $ekstrakurikuler = Ekstrakurikuler::orderBy('tanggal', 'desc')->paginate(12);

        // Return view public ekstrakurikuler dengan data
        return view('public.ekstrakurikuler', compact('ekstrakurikuler'));
    }
}

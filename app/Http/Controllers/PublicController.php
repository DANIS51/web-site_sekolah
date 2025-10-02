<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;

class PublicController extends Controller
{
    /**
     * Display the public homepage
     */
    public function index()
    {
        // Get latest data for homepage overview
        $latestBerita = Berita::with('user')->latest()->take(3)->get();
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalGaleri = Galeri::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $profilSekolah = ProfilSekolah::first();
        $latestEkstrakurikuler = Ekstrakurikuler::latest()->take(3)->get();
        return view('public.index', compact(
            'latestBerita',
            'totalGuru',
            'totalSiswa',
            'totalGaleri',
            'totalEkstrakurikuler',
            'profilSekolah',
            'latestEkstrakurikuler'
        ));
    }

    /**
     * Display all berita (news)
     */
    public function berita()
    {
        $berita = Berita::with('user')->latest()->paginate(12);

        return view('public.berita', compact('berita'));
    }

    /**
     * Display single berita
     */
    public function showBerita($id)
    {
        $berita = Berita::with('user')->findOrFail($id);

        return view('public.show-berita', compact('berita'));
    }

    /**
     * Display all galeri (gallery)
     */
    public function galeri()
    {
        $galeri = Galeri::orderBy('tanggal', 'desc')->paginate(12);

        return view('public.galeri', compact('galeri'));
    }

    /**
     * Display all guru (teachers)
     */
    public function guru()
    {
        $guru = Guru::latest()->paginate(12);

        return view('public.guru', compact('guru'));
    }

    /**
     * Display all siswa (students)
     */
    public function siswa()
    {
        $siswa = Siswa::latest()->paginate(12);

        return view('public.siswa', compact('siswa'));
    }

    /**
     * Display all ekstrakurikuler (extracurricular)
     */
    public function ekstrakurikuler()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->paginate(12);

        return view('public.ekstrakurikuler', compact('ekstrakurikuler'));
    }

    /**
     * Display profil sekolah (school profile)
     */
    public function profilSekolah()
    {
        $profilSekolah = ProfilSekolah::first();

        return view('public.profil-sekolah', compact('profilSekolah'));
    }
}

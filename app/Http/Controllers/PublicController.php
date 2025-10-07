<?php

// Namespace untuk controller public
namespace App\Http\Controllers;

// Import request dan semua model yang digunakan
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;

// Class PublicController yang mengextends Controller
class PublicController extends Controller
{
    /**
     * Display the public homepage
     */
    // Method untuk menampilkan halaman utama public
    public function index()
    {
        // Ambil data terbaru untuk overview halaman utama
        $latestBerita = Berita::with('user')->latest()->take(3)->get();
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalGaleri = Galeri::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $profilSekolah = ProfilSekolah::first();
        $latestEkstrakurikuler = Ekstrakurikuler::latest()->take(3)->get();
        $latestGaleri = Galeri::orderBy('tanggal', 'desc')->take(6)->get();
        // Return view index public dengan data
        return view('public.index', compact(
            'latestBerita',
            'totalGuru',
            'totalSiswa',
            'totalGaleri',
            'totalEkstrakurikuler',
            'profilSekolah',
            'latestEkstrakurikuler',
            'latestGaleri'
        ));
    }

    /**
     * Display all berita (news)
     */
    // Method untuk menampilkan semua berita di halaman public
    public function berita()
    {
        // Ambil berita dengan relasi user, urut terbaru, pagination 12
        $berita = Berita::with('user')->latest()->paginate(12);

        // Return view berita public
        return view('public.berita', compact('berita'));
    }

    /**
     * Display single berita
     */
    // Method untuk menampilkan detail berita tunggal
    public function showBerita($id)
    {
        // Cari berita berdasarkan id dengan relasi user
        $berita = Berita::with('user')->findOrFail($id);

        // Return view show berita
        return view('public.show-berita', compact('berita'));
    }

    /**
     * Display all galeri (gallery)
     */
    // Method untuk menampilkan semua galeri di halaman public
    public function galeri()
    {
        // Ambil galeri urut berdasarkan tanggal terbaru, pagination 12
        $galeri = Galeri::orderBy('tanggal', 'desc')->paginate(12);

        // Return view galeri public
        return view('public.galeri', compact('galeri'));
    }

    /**
     * Display all guru (teachers)
     */
    // Method untuk menampilkan semua guru di halaman public
    public function guru()
    {
        // Ambil guru urut terbaru, pagination 12
        $guru = Guru::latest()->paginate(12);

        // Return view guru public
        return view('public.guru', compact('guru'));
    }

    /**
     * Display all siswa (students)
     */
    // Method untuk siswa public (dikomentari)
    // public function siswa()
    // {
    //     $siswa = Siswa::latest()->paginate(12);

    //     return view('public.siswa', compact('siswa'));
    // }

    /**
     * Display profil sekolah (school profile)
     */
    // Method untuk menampilkan profil sekolah di halaman public
    public function profilSekolah()
    {
        // Ambil data profil sekolah pertama
        $profilSekolah = ProfilSekolah::first();

        // Return view profil sekolah public
        return view('public.profil-sekolah', compact('profilSekolah'));
    }
}

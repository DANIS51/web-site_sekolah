<?php

// Namespace untuk controller operator
namespace App\Http\Controllers\Operator;

// Import controller base, request, model-model, dan facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Auth;

// Class OperatorController yang mengextends Controller
class OperatorController extends Controller
{
    // Method untuk menampilkan dashboard operator
    public function dashboard()
    {
        // Hitung total siswa
        $totalSiswa = Siswa::count();
        // Hitung total berita
        $totalBerita = Berita::count();
        // Hitung total galeri
        $totalGaleri = Galeri::count();
        // Hitung total ekstrakurikuler
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        // Hitung total profil sekolah
        $totalProfilSekolah = ProfilSekolah::count();

        // Return view dashboard dengan data total
        return view('operator.dashboard', compact(
            'totalSiswa',
            'totalBerita',
            'totalGaleri',
            'totalEkstrakurikuler',
            'totalProfilSekolah'
        ));
    }

    // Method untuk menampilkan profil operator
    public function profile()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        // Return view profile dengan data user
        return view('operator.profile', compact('user'));
    }

    // Method untuk update profil operator
    public function updateProfile(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Update data user
        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        // Redirect ke profile dengan pesan sukses
        return redirect()->route('operator.profile')->with('success', 'Profile berhasil diperbarui.');
    }

    // Method untuk menampilkan form edit password operator
    public function editPassword()
    {
        return view('operator.edit-password');
    }

    // Method untuk update password operator
    public function updatePassword(Request $request)
    {
        // Validasi data input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Periksa apakah password saat ini benar
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Update password dengan hash
        $user->update(['password' => bcrypt($request->password)]);

        // Redirect ke profile dengan pesan sukses
        return redirect()->route('operator.profile')->with('success', 'Password berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = Siswa::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $totalProfilSekolah = ProfilSekolah::count();

        return view('operator.dashboard', compact(
            'totalSiswa',
            'totalBerita',
            'totalGaleri',
            'totalEkstrakurikuler',
            'totalProfilSekolah'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('operator.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('operator.profile')->with('success', 'Profile berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('operator.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update(['password' => bcrypt($request->password)]);

        return redirect()->route('operator.profile')->with('success', 'Password berhasil diperbarui.');
    }
}

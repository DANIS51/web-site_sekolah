<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();


        $data = [
            'user' => $user,
            'siswa_count' => Siswa::count(),
            'guru_count' => Guru::count(),
            'berita_count' => Berita::count(),
            'galeri_count' => Galeri::count(),
            'ekstrakurikuler_count' => Ekstrakurikuler::count(),
            'user_count' => User::count(),
        ];

        // Gunakan layout terpadu untuk kedua role
        return view('unified.dashboard', $data);
    }

    public function profile(){
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $validasi = $request->validate([
            'username' => 'nullable|string|max:255|unique:db_profil_sekolah_user,username,'.$user->id_user . ',id_user',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateData = [];

        if ($request->has('username') && !empty($request->username)) {
            $updateData['username'] = $validasi['username'];
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            // Simpan foto baru
            $path = $request->file('foto')->store('profile_photos', 'public');
            $updateData['foto'] = $path;
        }

        if (!empty($updateData)) {
            DB::table('users')->where('id_user', $user->id_user)->update($updateData);
        }

        return redirect()->route('profile')->with('success', 'Profile Berhasil diupdate');
    }
    public function editPassword(){
        $user = Auth::user();
        return view('dashboard.edit-password', compact('user'));
    }

    public function updatePassword(Request $request){
        $user = Auth::user();

        $validasi = $request->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:6|confirmed|different:current_password',
        ],[
            'current_password.current_password' => 'Password yang anda masukkan tidak sesuai dengan password anda saat ini',
            'password.different' => 'Password baru tidak boleh sama dengan password lama',
        ]);

        DB::table('users')
            ->where('id_user', $user->id_user)
            ->update(['password' => bcrypt($validasi['password'])]);

        return redirect()->route('profile')->with('success', 'Password Berhasil diupdate');
    }

}

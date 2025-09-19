<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'ekstrakurikuler_count' => DB::table('ekstrakurikuler')->count(),
            'user_count' => User::count(),
        ];

        if(strtolower($user->role) == 'admin') {
            return view('admin.dashboard', $data);
        } else {
            return view('operator.dashboard', $data);
        }
    }

    public function profile(){
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $validasi = $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id_user . ',id_user',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('username') && !empty($request->username)) {
            $user->username = $validasi['username'];
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            // Simpan foto baru
            $path = $request->file('foto')->store('profile_photos', 'public');
            $user->foto = $path;
        }

        $user->save();
        return redirect()->route('admin.profile')->with('success', 'Profile Berhasil diupdate');
    }
    public function editPassword(){
        $user = Auth::user();

        $validasi = request()->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:6|confirmed|different:current_password',
        ],[
            'current_password.current_password' => 'Password yang anda masukkan tidak sesuai dengan password anda saat ini',
            'password.different' => 'Password baru tidak boleh sama dengan password lama',
        ]);

        $user->password = bcrypt($validasi['password']);
        $user->save();
        return redirect()->route('profile')->with('success', 'Password Berhasil diupdate');
    }

}

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
            'username' => 'required|string|max:255|unique:users,username,'.$user->id_user . ',id_user',
        ]);

        $user->username = $validasi['username'];
        $user->save();
        return redirect()->route('profile')->with('success', 'Username Berhasil diupdate');
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

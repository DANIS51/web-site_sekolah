<?php

// Namespace untuk controller dashboard
namespace App\Http\Controllers;

// Import model yang diperlukan untuk dashboard
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

// Class DashboardController yang mengextends Controller
class DashboardController extends Controller
{
    //
    // Method untuk menampilkan dashboard berdasarkan role user
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Jika role user adalah admin
        if (strtolower($user->role) == 'admin') {
            // Data statistik untuk admin
            $data = [
                'user' => $user,
                'siswa_count' => Siswa::count(),
                'guru_count' => Guru::count(),
                'berita_count' => Berita::count(),
                'galeri_count' => Galeri::count(),
                'ekstrakurikuler_count' => Ekstrakurikuler::count(),
                'user_count' => User::count(),
            ];

            // Return view dashboard admin
            return view('admin.dashboard', $data);
        } else {
            // Data statistik untuk operator
            $data = [
                'user' => $user,
                'totalSiswa' => Siswa::count(),
                'totalBerita' => Berita::count(),
                'totalGaleri' => Galeri::count(),
                'totalEkstrakurikuler' => Ekstrakurikuler::count(),
                'totalProfilSekolah' => \App\Models\ProfilSekolah::count(),
            ];

            // Return view dashboard operator
            return view('operator.dashboard', $data);
        }
    }

    // Method untuk menampilkan halaman profile
    public function profile(){
        // Ambil data user
        $user = Auth::user();
        // Return view profile dengan data user
        return view('dashboard.profile', compact('user'));
    }

    // Method untuk update profile user
    public function updateProfile(Request $request){
        // Ambil data user
        $user = Auth::user();
        // Validasi input untuk update profile
        $validasi = $request->validate([
            'username' => 'nullable|string|max:255|unique:db_profil_sekolah_user,username,'.$user->id_user . ',id_user',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Array untuk data yang akan diupdate
        $updateData = [];

        // Jika username diisi, tambahkan ke updateData
        if ($request->has('username') && !empty($request->username)) {
            $updateData['username'] = $validasi['username'];
        }

        // Jika ada file foto diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            // Simpan foto baru ke storage
            $path = $request->file('foto')->store('profile_photos', 'public');
            $updateData['foto'] = $path;
        }

        // Update data jika ada perubahan
        if (!empty($updateData)) {
            DB::table('db_profil_sekolah_user')->where('id_user', $user->id_user)->update($updateData);
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Profile Berhasil diupdate');
    }

    // Method untuk menampilkan halaman edit password
    public function editPassword(){
        // Ambil data user
        $user = Auth::user();
        // Return view edit password
        return view('dashboard.edit-password', compact('user'));
    }

    // Method untuk update password user
    public function updatePassword(Request $request){
        // Ambil data user
        $user = Auth::user();

        // Validasi input untuk update password
        $validasi = $request->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:6|confirmed|different:current_password',
        ],[
            'current_password.current_password' => 'Password yang anda masukkan tidak sesuai dengan password anda saat ini',
            'password.different' => 'Password baru tidak boleh sama dengan password lama',
        ]);

        // Update password di database dengan hash
        DB::table('db_profil_sekolah_user')
            ->where('id_user', $user->id_user)
            ->update(['password' => bcrypt($validasi['password'])]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Password Berhasil diupdate');
    }

}

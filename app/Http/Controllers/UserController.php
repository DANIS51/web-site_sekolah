<?php

// Namespace untuk controller user
namespace App\Http\Controllers;

// Import controller base, model user, request, dan facade
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

// Class UserController yang mengextends Controller
class UserController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar user dengan pencarian dan pagination
    public function users(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query user
        $query = User::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('username', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $users = $query->orderBy('username')->paginate($perPage)->withQueryString();

        // Return view index users
        return view('admin.users.index', compact('users', 'search'));
    }

    // Method untuk menampilkan form create user
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Method untuk menyimpan user baru
    public function storeUser(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:db_profil_sekolah_user,username',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,operator,user',
        ]);

        // Buat user baru dengan password di-hash
        User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    // Method untuk menampilkan form edit user
    public function editUser($id)
    {
        // Decrypt id user
        $id = Crypt::decrypt($id);
        // Cari user berdasarkan id
        $user = User::findOrFail($id);
        // Return view edit dengan data user
        return view('admin.users.edit', compact('user'));
    }

    // Method untuk update user
    public function updateUser(Request $request, $id)
    {
        // Decrypt id user
        $id = Crypt::decrypt($id);
        // Cari user berdasarkan id
        $user = User::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:db_profil_sekolah_user,username,' . $id . ',id_user',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,operator,user',
        ]);

        // Update username dan role
        $user->update([
            'username' => $validated['username'],
            'role' => $validated['role'],
        ]);

        // Jika password diisi, update password dengan hash
        if ($validated['password']) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    // Method untuk menghapus user
    public function deleteUser($id)
    {
        // Cari user berdasarkan id yang di-decrypt
        $user = User::findOrFail(Crypt::decrypt($id));
        // Hapus user
        $user->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}

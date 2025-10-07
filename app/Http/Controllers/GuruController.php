<?php

// Namespace untuk controller guru
namespace App\Http\Controllers;

// Import controller base, model guru, request, dan facade
use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class GuruController yang mengextends Controller
class GuruController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar guru dengan pencarian dan pagination
    public function guru(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query guru
        $query = Guru::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('nama_guru', 'like', '%' . $search . '%')
                ->orWhere('nip', 'like', '%' . $search . '%')
                ->orWhere('mapel', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $gurus = $query->orderBy('nama_guru')->paginate($perPage)->withQueryString();

        // Return view index dengan data
        return view('admin.guru.index', compact('gurus', 'search'));
    }

    // Method untuk menampilkan form create guru
    public function createGuru()
    {
        return view('admin.guru.create');
    }

    // Method untuk menyimpan guru baru
    public function storeGuru(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:db_profil_sekolah_guru,nip',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:db_profil_sekolah_guru,email',
            'telepon' => 'required|string|max:15|unique:db_profil_sekolah_guru,telepon',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data untuk create
        $data = $validated;

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru_fotos', 'public');
        }

        // Buat guru baru
        Guru::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit guru
    public function editGuru($id)
    {
        // Decrypt id guru
        $id = Crypt::decrypt($id);
        // Cari guru berdasarkan id
        $guru = Guru::findOrFail($id);
        // Return view edit dengan data guru
        return view('admin.guru.edit', compact('guru'));
    }

    // Method untuk update guru
    public function updateGuru(Request $request, $id)
    {
        // Decrypt id guru
        $id = Crypt::decrypt($id);
        // Cari guru berdasarkan id
        $guru = Guru::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:db_profil_sekolah_guru,nip,' . $id . ',id_guru',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:db_profil_sekolah_guru,email,' . $id . ',id_guru',
            'telepon' => 'required|string|max:15|unique:db_profil_sekolah_guru,telepon,' . $id . ',id_guru',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data untuk update
        $data = $validated;

        // Handle foto baru jika diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            if ($guru->foto && Storage::exists('public/' . $guru->foto)) {
                Storage::delete('public/' . $guru->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('guru_fotos', 'public');
        }

        // Update data guru
        $guru->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diupdate.');
    }

    // Method untuk menghapus guru
    public function destroyGuru($id)
    {
        // Decrypt id guru
        $id = Crypt::decrypt($id);
        // Cari guru berdasarkan id
        $guru = Guru::findOrFail($id);
        // Hapus guru
        $guru->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}

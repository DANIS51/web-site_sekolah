<?php

// Namespace untuk controller profil sekolah
namespace App\Http\Controllers;

// Import controller base, model profil sekolah, request, dan storage
use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Class ProfilSekolahController yang mengextends Controller
class ProfilSekolahController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar profil sekolah dengan pencarian dan pagination
    public function index(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query profil sekolah
        $query = ProfilSekolah::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('nama_sekolah', 'like', '%' . $search . '%')
                ->orWhere('kepala_sekolah', 'like', '%' . $search . '%')
                ->orWhere('npsn', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $profils = $query->orderBy('nama_sekolah')->paginate($perPage)->withQueryString();

        // Return view index dengan data
        return view('admin.profil_sekolah.index', compact('profils', 'search'));
    }

    // Method untuk menampilkan form create profil sekolah
    public function create()
    {
        return view('admin.profil_sekolah.create');
    }

    // Method untuk menyimpan profil sekolah baru
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10|unique:db_profil_sekolah_profil_sekolah,npsn',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'visi_misi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
        ]);

        // Data untuk create
        $data = $validated;

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        // Handle upload logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        // Buat profil sekolah baru
        ProfilSekolah::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.profil_sekolah.index')->with('success', 'Profil sekolah berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit profil sekolah
    public function edit($id)
    {
        // Cari profil sekolah berdasarkan id
        $profil = ProfilSekolah::findOrFail($id);
        // Return view edit dengan data profil
        return view('admin.profil_sekolah.edit', compact('profil'));
    }

    // Method untuk update profil sekolah
    public function update(Request $request, $id)
    {
        // Cari profil sekolah berdasarkan id
        $profil = ProfilSekolah::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10|unique:db_profil_sekolah_profil_sekolah,npsn,' . $id . ',id_profil',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'visi_misi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
        ]);

        // Data untuk update
        $data = $validated;

        // Handle upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        // Handle upload logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            // Simpan logo baru
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        // Update data profil sekolah
        $profil->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.profil_sekolah.index')->with('success', 'Profil sekolah berhasil diupdate.');
    }

    // Method untuk menghapus profil sekolah
    public function destroy($id)
    {
        // Cari profil sekolah berdasarkan id
        $profil = ProfilSekolah::findOrFail($id);
        // Hapus profil sekolah
        $profil->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.profil_sekolah.index')->with('success', 'Profil sekolah berhasil dihapus.');
    }
}

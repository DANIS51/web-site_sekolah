<?php

// Namespace untuk controller siswa
namespace App\Http\Controllers;

// Import controller base, model siswa, request, dan facade
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class SiswaController yang mengextends Controller
class SiswaController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin'); // Sekarang menerima admin dan operator
    }

    // Method untuk menampilkan daftar siswa dengan pencarian dan pagination
    public function index(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query siswa
        $query = Siswa::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('nama_siswa', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $siswa = $query->orderBy('nama_siswa')->paginate($perPage)->withQueryString();

        // Return view index siswa
        return view('admin.siswa.siswa', compact('siswa', 'search'));
    }

    // Method untuk menampilkan form create siswa
    public function create()
    {
        return view('admin.siswa.create');
    }

    // Method untuk menyimpan siswa baru
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat siswa baru
        $siswa = Siswa::create($validated);

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
            $siswa->update(['foto' => $fotoPath]);
        }

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit siswa
    public function edit($id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);
        // Return view edit dengan data siswa
        return view('admin.siswa.edit', compact('siswa'));
    }

    // Method untuk update siswa
    public function update(Request $request, $id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);

        // Validasi data input
        $validated = $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn,' . $id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Update data siswa
        $siswa->update($validated);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil diupdate.');
    }

    // Method untuk menghapus siswa
    public function destroy($id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);
        // Hapus siswa
        $siswa->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}

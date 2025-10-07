<?php

// Namespace untuk controller berita
namespace App\Http\Controllers;

// Import class yang diperlukan untuk controller
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

// Class BeritaController yang mengextends Controller
class BeritaController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar berita dengan pencarian dan pagination
    public function berita(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query berita dengan relasi user
        $query = Berita::with('user');

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('isi', 'like', '%' . $search . '%');
        }

        // Paginate hasil query dan return view
        $beritas = $query->orderBy('tanggal', 'desc')->paginate($perPage)->withQueryString();

        return view('admin.berita.index', compact('beritas', 'search'));
    }

    // Method untuk menampilkan form create berita
    public function createBerita()
    {
        return view('admin.berita.create');
    }

    // Method untuk menyimpan berita baru
    public function storeBerita(Request $request){
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar jika ada
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('berita', 'public');
        }

        // Buat berita baru
        Berita::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
            'id_user' => Auth::id(),
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit berita
    public function editBerita($id)
    {
        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);
        // Return view edit dengan data berita
        return view('admin.berita.edit', compact('berita'));
    }

    // Method untuk update berita
    public function updateBerita(Request $request, $id)
    {
        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        // Handle gambar baru jika diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Update data berita
        $berita->update($validated);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Method untuk menghapus berita
    public function destroyBerita($id)
    {
        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);
        // Hapus berita
        $berita->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}

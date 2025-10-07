<?php

// Namespace untuk controller galeri
namespace App\Http\Controllers;

// Import model dan facade yang diperlukan
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class GaleriController yang mengextends Controller
class GaleriController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar galeri dengan pencarian dan pagination
    public function galeri(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query galeri
        $query = Galeri::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%')
                ->orWhere('kategori', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $galeris = $query->orderBy('tanggal', 'desc')->paginate($perPage)->withQueryString();

        // Return view index dengan data
        return view('admin.galeri.index', compact('galeris', 'search'));
    }

    // Method untuk menampilkan form create galeri
    public function createGaleri()
    {
        return view('admin.galeri.create');
    }

    // Method untuk menyimpan galeri baru
    public function storeGaleri(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        // Simpan file ke storage
        $filePath = $request->file('file')->store('galeri', 'public');

        // Buat galeri baru
        Galeri::create([
            'judul' => $validated['judul'],
            'keterangan' => $validated['keterangan'],
            'file' => $filePath,
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }
    

    // Method untuk menampilkan form edit galeri
    public function editGaleri($id)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($id);
        // Cari galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);
        // Return view edit dengan data galeri
        return view('admin.galeri.edit', compact('galeri'));
    }

    // Method untuk update galeri
    public function updateGaleri(Request $request, $id)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($id);
        // Cari galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        // Handle file baru jika diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('galeri', 'public');
            $galeri->file = $filePath;
        }

        // Update data galeri
        $galeri->update([
            'judul' => $validated['judul'],
            'keterangan' => $validated['keterangan'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'file' => $galeri->file,
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    // Method untuk menghapus galeri
    public function destroyGaleri($id)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($id);
        // Cari galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);

        // Hapus file jika ada
        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        // Hapus galeri
        $galeri->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}

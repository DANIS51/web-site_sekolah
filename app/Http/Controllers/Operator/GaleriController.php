<?php

// Namespace untuk controller operator galeri
namespace App\Http\Controllers\Operator;

// Import controller base, request, model galeri, dan facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class GaleriController yang mengextends Controller
class GaleriController extends Controller
{
    // Constructor untuk menambahkan middleware operator
    public function __construct()
    {
        $this->middleware('operator');
    }

    // Method untuk menampilkan daftar galeri operator dengan pencarian dan pagination
    public function index(Request $request)
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

        // Return view index operator galeri
        return view('operator.galeri.index', compact('galeris', 'search'));
    }

    // Method untuk menampilkan form create galeri operator
    public function create()
    {
        return view('operator.galeri.create');
    }

    // Method untuk menyimpan galeri baru oleh operator
    public function store(Request $request)
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
        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit galeri operator
    public function edit($galeri)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($galeri);
        // Cari galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);
        // Return view edit dengan data galeri
        return view('operator.galeri.edit', compact('galeri'));
    }

    // Method untuk update galeri oleh operator
    public function update(Request $request, $galeri)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($galeri);
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

        // Handle upload file baru jika ada
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
        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    // Method untuk menghapus galeri oleh operator
    public function destroy($galeri)
    {
        // Decrypt id galeri
        $id = Crypt::decrypt($galeri);
        // Cari galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);

        // Hapus file jika ada
        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        // Hapus galeri
        $galeri->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}

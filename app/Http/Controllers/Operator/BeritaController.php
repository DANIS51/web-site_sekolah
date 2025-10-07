<?php

// Namespace untuk controller operator berita
namespace App\Http\Controllers\Operator;

// Import controller base, request, model berita, dan facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class BeritaController yang mengextends Controller
class BeritaController extends Controller
{
    // Method untuk menampilkan daftar berita operator
    public function index()
    {
        // Ambil berita dengan relasi user
        $berita = Berita::with('user')->get();
        // Return view index operator berita
        return view('operator.berita.index', compact('berita'));
    }

    // Method untuk menampilkan form create berita operator
    public function create()
    {
        return view('operator.berita.create');
    }

    // Method untuk menyimpan berita baru oleh operator
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
        ]);

        // Ambil data yang diperlukan
        $data = $request->only(['judul', 'isi', 'tanggal']);

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita_gambars', 'public');
        }

        // Set id_user dari user yang login
        $data['id_user'] = auth()->user()->id_user;

        // Buat berita baru
        Berita::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit berita operator
    public function edit($id)
    {
        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);
        // Return view edit dengan data berita
        return view('operator.berita.edit', compact('berita'));
    }

    // Method untuk update berita oleh operator
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
        ]);

        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);
        // Ambil data yang diperlukan
        $data = $request->only(['judul', 'isi', 'tanggal']);

        // Handle upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('berita_gambars', 'public');
        }

        // Update data berita
        $berita->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Method untuk menghapus berita oleh operator
    public function destroy($id)
    {
        // Decrypt id berita
        $id = Crypt::decrypt($id);
        // Cari berita berdasarkan id
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        // Hapus berita
        $berita->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}

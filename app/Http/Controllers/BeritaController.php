<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function berita()
    {
        $beritas = Berita::with('user')->get();
        return view('admin.berita.index', compact('beritas'));
    }
    public function createBerita()
    {
        return view('admin.berita.create');
    }
    public function storeBerita(Request $request){
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function updateBerita(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);

        $berita->update([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $request->hasFile('gambar') ? $request->file('gambar')->store('berita', 'public') : $berita->gambar,

        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil dihapus.');
    }
}

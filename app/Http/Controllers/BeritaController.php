<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Support\Facades\Request;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function berita()
    {
        $beritas = Berita::all();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create(Request $request){
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|text',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filePath = $request->file('gambar')->store('berita', 'public');

        Berita::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);

        return redirect()->route('admin.berita')->with('success', 'Berita berhasil ditambahkan.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function galeri()
    {
        $galeris = Galeri::all();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function createGaleri()
    {
        return view('admin.galeri.create');
    }

    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:2048',
            'kategori' => 'required|in:foto,video',
            'tanggal' => 'required|date',
        ]);

        $filePath = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'judul' => $validated['judul'],
            'keterangan' => $validated['keterangan'],
            'file' => $filePath,
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil ditambahkan.');
    }
}

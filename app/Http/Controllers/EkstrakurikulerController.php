<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function ekstrakurikulera()
    {
        $ekstrakurikulera = ekstrakurikuler::all();
        return view('admin.ekstrakurikulera.index', compact('ekstrakurikulera'));
    }

    public function createEkstrakurikulera(){
        return view('admin.ekstrakurikulera.create');
    }

    public function StoreEskul(Request $request){
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'jadwal' => 'required|string|max:100',
            'pelatih' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('ekstrakurikulera', 'public');
        }
        ekstrakurikuler::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'jadwal' => $validated['jadwal'],
            'pelatih' => $validated['pelatih'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);
        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }
}

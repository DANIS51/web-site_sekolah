<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function ekstrakurikulera(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Ekstrakurikuler::query();

        if ($search) {
            $query->where('nama_ekskul', 'like', '%' . $search . '%')
                ->orWhere('pembina', 'like', '%' . $search . '%')
                ->orWhere('jadwal_latihan', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $ekstrakurikulera = $query->orderBy('nama_ekskul')->paginate($perPage)->withQueryString();

        return view('admin.ekstrakurikulera.index', compact('ekstrakurikulera', 'search'));
    }

    public function createEkstrakurikulera(){
        return view('admin.ekstrakurikulera.create');
    }

    public function StoreEskul(Request $request){
        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:100',
            'pembina' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('ekstrakurikulera', 'public');
        }
        Ekstrakurikuler::create([
            'nama_ekskul' => $validated['nama_ekskul'],
            'deskripsi' => $validated['deskripsi'],
            'jadwal_latihan' => $validated['jadwal_latihan'],
            'pembina' => $validated['pembina'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);
        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function editEkstrakurikulera($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikulera.edit', compact('ekstrakurikuler'));
    }

    public function updateEkstrakurikulera(Request $request, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:100',
            'pembina' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($ekstrakurikuler->gambar && Storage::exists('public/' . $ekstrakurikuler->gambar)) {
                Storage::delete('public/' . $ekstrakurikuler->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikulera', 'public');
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    public function destroyEkstrakurikulera($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        // Hapus gambar jika ada
        if ($ekstrakurikuler->gambar && Storage::exists('public/' . $ekstrakurikuler->gambar)) {
            Storage::delete('public/' . $ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

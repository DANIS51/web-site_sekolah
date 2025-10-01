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

<<<<<<< HEAD
    public function ekstrakurikuler(Request $request)
=======
    public function ekstrakurikulera(Request $request)
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
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

<<<<<<< HEAD
        $ekstrakurikuler = $query->orderBy('nama_ekskul')->paginate($perPage)->withQueryString();

        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler', 'search'));
    }

    public function createEkstrakurikuler(){
        return view('admin.ekstrakurikuler.create');
    }

    public function storeEkstrakurikuler(Request $request){
=======
        $ekstrakurikulera = $query->orderBy('nama_ekskul')->paginate($perPage)->withQueryString();

        return view('admin.ekstrakurikulera.index', compact('ekstrakurikulera', 'search'));
    }

    public function createEkstrakurikulera(){
        return view('admin.ekstrakurikulera.create');
    }

    public function StoreEskul(Request $request){
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
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
<<<<<<< HEAD
            $filePath = $request->file('gambar')->store('ekstrakurikuler', 'public');
=======
            $filePath = $request->file('gambar')->store('ekstrakurikulera', 'public');
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
        }
        Ekstrakurikuler::create([
            'nama_ekskul' => $validated['nama_ekskul'],
            'deskripsi' => $validated['deskripsi'],
            'jadwal_latihan' => $validated['jadwal_latihan'],
            'pembina' => $validated['pembina'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);
<<<<<<< HEAD
        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function editEkstrakurikuler($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function updateEkstrakurikuler(Request $request, $id)
=======
        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function editEkstrakurikulera($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikulera.edit', compact('ekstrakurikuler'));
    }

    public function updateEkstrakurikulera(Request $request, $id)
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
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
<<<<<<< HEAD
            if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
=======
            if ($ekstrakurikuler->gambar && Storage::exists('public/' . $ekstrakurikuler->gambar)) {
                Storage::delete('public/' . $ekstrakurikuler->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikulera', 'public');
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
        }

        $ekstrakurikuler->update($data);

<<<<<<< HEAD
        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    public function destroyEkstrakurikuler($id)
=======
        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    public function destroyEkstrakurikulera($id)
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        // Hapus gambar jika ada
<<<<<<< HEAD
        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
=======
        if ($ekstrakurikuler->gambar && Storage::exists('public/' . $ekstrakurikuler->gambar)) {
            Storage::delete('public/' . $ekstrakurikuler->gambar);
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
        }

        $ekstrakurikuler->delete();

<<<<<<< HEAD
        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Ekstrakurikuler berhasil dihapus.');
=======
        return redirect()->route('admin.ekstrakurikulera')->with('success', 'Ekstrakurikuler berhasil dihapus.');
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
    }
}

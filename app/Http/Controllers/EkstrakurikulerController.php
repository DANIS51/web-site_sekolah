<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function ekstrakurikuler(Request $request)
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

        $ekstrakurikuler = $query->orderBy('nama_ekskul')->paginate($perPage)->withQueryString();

        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler', 'search'));
    }

    public function createEkstrakurikuler()
    {
        return view('admin.ekstrakurikuler.create');
    }

    public function storeEkstrakurikuler(Request $request)
    {
        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create([
            'nama_ekskul' => $validated['nama_ekskul'],
            'deskripsi' => $validated['deskripsi'],
            'jadwal_latihan' => $validated['jadwal_latihan'],
            'pembina' => $validated['pembina'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function editEkstrakurikuler($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function updateEkstrakurikuler(Request $request, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    public function destroyEkstrakurikuler($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

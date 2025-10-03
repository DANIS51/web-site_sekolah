<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Ekstrakurikuler::query();

        if ($search) {
            $query->where('nama_ekskul', 'like', '%' . $search . '%')
                ->orWhere('jadwal_latihan', 'like', '%' . $search . '%')
                ->orWhere('pembina', 'like', '%' . $search . '%');
        }

        $ekstrakurikuler = $query->orderBy('nama_ekskul', 'asc')->paginate($perPage)->withQueryString();

        return view('operator.ekstrakurikuler.index', compact('ekstrakurikuler', 'search'));
    }

    public function create()
    {
        return view('operator.ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'jadwal_latihan' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('operator.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'jadwal_latihan' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = Crypt::decrypt($id);
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

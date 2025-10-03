<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('operator');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Galeri::query();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%')
                ->orWhere('kategori', 'like', '%' . $search . '%');
        }

        $galeris = $query->orderBy('tanggal', 'desc')->paginate($perPage)->withQueryString();

        return view('operator.galeri.index', compact('galeris', 'search'));
    }

    public function create()
    {
        return view('operator.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
            'kategori' => 'required|in:Foto,Video',
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

        return redirect()->route('operator.galeri')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit($galeri)
    {
        $id = Crypt::decrypt($galeri);
        $galeri = Galeri::findOrFail($id);
        return view('operator.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $galeri)
    {
        $id = Crypt::decrypt($galeri);
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('file')) {
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }
            $filePath = $request->file('file')->store('galeri', 'public');
            $galeri->file = $filePath;
        }

        $galeri->update([
            'judul' => $validated['judul'],
            'keterangan' => $validated['keterangan'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'file' => $galeri->file,
        ]);

        return redirect()->route('operator.galeri')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($galeri)
    {
        $id = Crypt::decrypt($galeri);
        $galeri = Galeri::findOrFail($id);

        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('operator.galeri')->with('success', 'Galeri berhasil dihapus.');
    }
}

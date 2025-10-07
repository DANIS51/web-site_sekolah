<?php

// Namespace untuk controller ekstrakurikuler
namespace App\Http\Controllers;

// Import model dan facade yang diperlukan
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Class EkstrakurikulerController yang mengextends Controller
class EkstrakurikulerController extends Controller
{
    // Constructor untuk menambahkan middleware admin
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Method untuk menampilkan daftar ekstrakurikuler dengan pencarian dan pagination
    public function ekstrakurikuler(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query ekstrakurikuler
        $query = Ekstrakurikuler::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('nama_ekskul', 'like', '%' . $search . '%')
                ->orWhere('pembina', 'like', '%' . $search . '%')
                ->orWhere('jadwal_latihan', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $ekstrakurikuler = $query->orderBy('nama_ekskul')->paginate($perPage)->withQueryString();

        // Return view index dengan data
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler', 'search'));
    }

    // Method untuk menampilkan form create ekstrakurikuler
    public function createEkstrakurikuler()
    {
        return view('admin.ekstrakurikuler.create');
    }

    // Method untuk menyimpan ekstrakurikuler baru
    public function storeEkstrakurikuler(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar jika ada
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        // Buat ekstrakurikuler baru
        Ekstrakurikuler::create([
            'nama_ekskul' => $validated['nama_ekskul'],
            'deskripsi' => $validated['deskripsi'],
            'jadwal_latihan' => $validated['jadwal_latihan'],
            'pembina' => $validated['pembina'],
            'tanggal' => $validated['tanggal'],
            'gambar' => $filePath,
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit ekstrakurikuler
    public function editEkstrakurikuler($id)
    {
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        // Return view edit dengan data ekstrakurikuler
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    // Method untuk update ekstrakurikuler
    public function updateEkstrakurikuler(Request $request, $id)
    {
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'jadwal_latihan' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data untuk update
        $data = $validated;

        // Handle gambar baru jika diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        // Update data ekstrakurikuler
        $ekstrakurikuler->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    // Method untuk menghapus ekstrakurikuler
    public function destroyEkstrakurikuler($id)
    {
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        // Hapus gambar jika ada
        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        // Hapus ekstrakurikuler
        $ekstrakurikuler->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

<?php

// Namespace untuk controller operator ekstrakurikuler
namespace App\Http\Controllers\Operator;

// Import controller base, request, model ekstrakurikuler, dan facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class EkstrakurikulerController yang mengextends Controller
class EkstrakurikulerController extends Controller
{
    // Method untuk menampilkan daftar ekstrakurikuler operator dengan pencarian dan pagination
    public function index(Request $request)
    {
        // Ambil input pencarian dan jumlah per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // Query ekstrakurikuler
        $query = Ekstrakurikuler::query();

        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('nama_ekskul', 'like', '%' . $search . '%')
                ->orWhere('jadwal_latihan', 'like', '%' . $search . '%')
                ->orWhere('pembina', 'like', '%' . $search . '%');
        }

        // Paginate hasil query
        $ekstrakurikuler = $query->orderBy('nama_ekskul', 'asc')->paginate($perPage)->withQueryString();

        // Return view index operator ekstrakurikuler
        return view('operator.ekstrakurikuler.index', compact('ekstrakurikuler', 'search'));
    }

    // Method untuk menampilkan form create ekstrakurikuler operator
    public function create()
    {
        return view('operator.ekstrakurikuler.create');
    }

    // Method untuk menyimpan ekstrakurikuler baru oleh operator
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'jadwal_latihan' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil semua data request
        $data = $request->all();

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        // Buat ekstrakurikuler baru
        Ekstrakurikuler::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit ekstrakurikuler operator
    public function edit($id)
    {
        // Decrypt id ekstrakurikuler
        $id = Crypt::decrypt($id);
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        // Return view edit dengan data ekstrakurikuler
        return view('operator.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    // Method untuk update ekstrakurikuler oleh operator
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'jadwal_latihan' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Decrypt id ekstrakurikuler
        $id = Crypt::decrypt($id);
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        // Ambil semua data request
        $data = $request->all();

        // Handle upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        // Update data ekstrakurikuler
        $ekstrakurikuler->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    // Method untuk menghapus ekstrakurikuler oleh operator
    public function destroy($id)
    {
        // Decrypt id ekstrakurikuler
        $id = Crypt::decrypt($id);
        // Cari ekstrakurikuler berdasarkan id
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);

        // Hapus gambar jika ada
        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        // Hapus ekstrakurikuler
        $ekstrakurikuler->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

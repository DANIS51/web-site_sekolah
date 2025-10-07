<?php

// Namespace untuk controller operator siswa
namespace App\Http\Controllers\Operator;

// Import controller base, request, model siswa, dan facade
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

// Class SiswaController yang mengextends Controller
class SiswaController extends Controller
{
    // Method untuk menampilkan daftar siswa operator
    public function index()
    {
        // Ambil semua data siswa
        $siswa = Siswa::all();
        // Return view index operator siswa
        return view('operator.siswa.index', compact('siswa'));
    }

    // Method untuk menampilkan form create siswa operator
    public function create()
    {
        return view('operator.siswa.create');
    }

    // Method untuk menyimpan siswa baru oleh operator
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil semua data request
        $data = $request->all();

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('siswa_fotos', 'public');
        }

        // Buat siswa baru
        Siswa::create($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Method untuk menampilkan form edit siswa operator
    public function edit($id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);
        // Return view edit dengan data siswa
        return view('operator.siswa.edit', compact('siswa'));
    }

    // Method untuk update siswa oleh operator
    public function update(Request $request, $id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Validasi data input
        $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn,' . $id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);
        // Ambil semua data request
        $data = $request->all();

        // Handle upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('siswa_fotos', 'public');
        }

        // Update data siswa
        $siswa->update($data);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    // Method untuk menghapus siswa oleh operator
    public function destroy($id_siswa)
    {
        // Decrypt id siswa
        $id_siswa = Crypt::decrypt($id_siswa);
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id_siswa);

        // Hapus foto jika ada
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        // Hapus siswa
        $siswa->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

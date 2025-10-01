<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Sekarang menerima admin dan operator
    }


    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Siswa::query();

        if ($search) {
            $query->where('nama_siswa', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%');
        }

        $siswa = $query->orderBy('nama_siswa')->paginate($perPage)->withQueryString();

        return view('admin.siswa.siswa', compact('siswa', 'search'));
    }


    public function create()
    {
        return view('admin.siswa.create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $siswa = Siswa::create($validated);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
            $siswa->update(['foto' => $fotoPath]);
        }

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    public function edit($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $siswa = Siswa::findOrFail($id_siswa);
        return view('admin.siswa.edit', compact('siswa'));
    }


    public function update(Request $request, $id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $siswa = Siswa::findOrFail($id_siswa);

        $validated = $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn,' . $id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
            $validated['foto'] = $fotoPath;
        }

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil diupdate.');
    }


    public function destroy($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $siswa = Siswa::findOrFail($id_siswa);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}

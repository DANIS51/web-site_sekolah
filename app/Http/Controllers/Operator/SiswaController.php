<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('operator.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('operator.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('siswa_fotos', 'public');
        }

        Siswa::create($data);

        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $siswa = Siswa::findOrFail($id_siswa);
        return view('operator.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $request->validate([
            'nisn' => 'required|string|max:10|unique:db_profil_sekolah_siswa,nisn,' . $id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $siswa = Siswa::findOrFail($id_siswa);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('siswa_fotos', 'public');
        }

        $siswa->update($data);

        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $siswa = Siswa::findOrFail($id_siswa);

        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

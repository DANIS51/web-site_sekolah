<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        $siswa = Siswa::orderBy('nama_siswa', 'asc')->get();
        return view('admin.siswa.siswa', compact('siswa'));
    }


    public function create()
    {
        return view('admin.siswa.create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nism' => 'required|string|max:10|unique:siswas,nism',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
        ]);

        Siswa::create($validated);

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }


    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nism' => 'required|string|max:10|unique:siswas,nism,' . $id . ',id_siswa',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|digits:4',
        ]);

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil diupdate.');
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}

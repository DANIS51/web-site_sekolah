<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function guru(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Guru::query();

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('nip', 'like', '%' . $search . '%')
                ->orWhere('mapel', 'like', '%' . $search . '%');
        }

        $gurus = $query->orderBy('nama')->paginate($perPage)->withQueryString();

        return view('admin.guru.index', compact('gurus', 'search'));
    }
    public function createGuru()
    {
        return view('admin.guru.create');
    }
    public function storeGuru(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:gurus,nip',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:gurus,email',
            'telepon' => 'required|string|max:15|unique:gurus,telepon',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru_fotos', 'public');
        }

        Guru::create($data);

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function editGuru($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function updateGuru(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:gurus,nip,' . $id . ',id_guru',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:gurus,email,' . $id . ',id_guru',
            'telepon' => 'required|string|max:15|unique:gurus,telepon,' . $id . ',id_guru',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru_fotos', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroyGuru($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil dihapus.');
    }
}

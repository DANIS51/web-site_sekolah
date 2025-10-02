<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

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
            $query->where('nama_guru', 'like', '%' . $search . '%')
                ->orWhere('nip', 'like', '%' . $search . '%')
                ->orWhere('mapel', 'like', '%' . $search . '%');
        }

        $gurus = $query->orderBy('nama_guru')->paginate($perPage)->withQueryString();

        return view('admin.guru.index', compact('gurus', 'search'));
    }
    public function createGuru()
    {
        return view('admin.guru.create');
    }
    public function storeGuru(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:db_profil_sekolah_guru,nip',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:db_profil_sekolah_guru,email',
            'telepon' => 'required|string|max:15|unique:db_profil_sekolah_guru,telepon',
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
        $id = Crypt::decrypt($id);
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function updateGuru(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:db_profil_sekolah_guru,nip,' . $id . ',id_guru',
            'alamat' => 'required|string',
            'mapel' => 'required|string|max:50',
            'email' => 'required|email|unique:db_profil_sekolah_guru,email,' . $id . ',id_guru',
            'telepon' => 'required|string|max:15|unique:db_profil_sekolah_guru,telepon,' . $id . ',id_guru',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
 
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
        }
            if ($guru->foto && Storage::exists('public/' . $guru->foto)) {
                Storage::delete('public/' . $guru->foto);
 
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('guru_fotos', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroyGuru($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil dihapus.');
    }
}

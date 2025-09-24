<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profilSekolah = ProfilSekolah::all();
        return view('operator.profil_sekolah.index', compact('profilSekolah'));
    }

    public function create()
    {
        return view('operator.profil_sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        ProfilSekolah::create($data);

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $profilSekolah = ProfilSekolah::findOrFail($id);
        return view('operator.profil_sekolah.edit', compact('profilSekolah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilSekolah = ProfilSekolah::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($profilSekolah->logo) {
                Storage::disk('public')->delete($profilSekolah->logo);
            }
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        if ($request->hasFile('foto')) {
            if ($profilSekolah->foto) {
                Storage::disk('public')->delete($profilSekolah->foto);
            }
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        $profilSekolah->update($data);

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profilSekolah = ProfilSekolah::findOrFail($id);

        if ($profilSekolah->logo) {
            Storage::disk('public')->delete($profilSekolah->logo);
        }

        if ($profilSekolah->foto) {
            Storage::disk('public')->delete($profilSekolah->foto);
        }

        $profilSekolah->delete();

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil dihapus.');
    }
}

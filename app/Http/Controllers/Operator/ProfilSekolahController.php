<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('operator');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = ProfilSekolah::query();

        if ($search) {
            $query->where('nama_sekolah', 'like', '%' . $search . '%')
                ->orWhere('kepala_sekolah', 'like', '%' . $search . '%')
                ->orWhere('npsn', 'like', '%' . $search . '%');
        }

        $profils = $query->orderBy('nama_sekolah')->paginate($perPage)->withQueryString();

        return view('operator.profil_sekolah.index', compact('profils', 'search'));
    }

    public function create()
    {
        return view('operator.profil_sekolah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10|unique:db_profil_sekolah_profil_sekolah,npsn',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'visi_misi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
        ]);

        $data = $validated;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        ProfilSekolah::create($data);

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $profil = ProfilSekolah::findOrFail($id);
        return view('operator.profil_sekolah.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = ProfilSekolah::findOrFail($id);

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10|unique:db_profil_sekolah_profil_sekolah,npsn,' . $id . ',id_profil',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'visi_misi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
        ]);

        $data = $validated;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($profil->foto && Storage::exists('public/' . $profil->foto)) {
                Storage::delete('public/' . $profil->foto);
            }
            // Store new foto
            $data['foto'] = $request->file('foto')->store('profil_sekolah_fotos', 'public');
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profil->logo && Storage::exists('public/' . $profil->logo)) {
                Storage::delete('public/' . $profil->logo);
            }
            // Store new logo
            $data['logo'] = $request->file('logo')->store('profil_sekolah_logos', 'public');
        }

        $profil->update($data);

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $profil = ProfilSekolah::findOrFail($id);
        $profil->delete();

        return redirect()->route('operator.profil_sekolah.index')->with('success', 'Profil sekolah berhasil dihapus.');
    }
}

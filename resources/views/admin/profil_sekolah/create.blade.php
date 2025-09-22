@extends('layouts.admin')

@section('title', 'Tambah Profil Sekolah')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Profil Sekolah</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profil_sekolah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                                id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}" required>
                            @error('nama_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kepala_sekolah" class="form-label">Kepala Sekolah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                id="kepala_sekolah" name="kepala_sekolah" value="{{ old('kepala_sekolah') }}" required>
                            @error('kepala_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="npsn" class="form-label">NPSN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('npsn') is-invalid @enderror"
                                id="npsn" name="npsn" value="{{ old('npsn') }}" required>
                            @error('npsn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun_berdiri" class="form-label">Tahun Berdiri <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}"
                                min="1900" max="{{ date('Y') }}" required>
                            @error('tahun_berdiri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Sekolah</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                        id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="visi_misi" class="form-label">Visi & Misi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('visi_misi') is-invalid @enderror"
                        id="visi_misi" name="visi_misi" rows="4" required>{{ old('visi_misi') }}</textarea>
                    @error('visi_misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                        id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Sekolah</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror"
                        id="foto" name="foto" accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.profil_sekolah.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

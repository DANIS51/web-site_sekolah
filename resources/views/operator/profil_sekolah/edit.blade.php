@extends('layouts.operator')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Profil Sekolah</h2>
                <a href="{{ route('operator.profil_sekolah.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Profil
                </a>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Profil Sekolah</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('operator.profil_sekolah.update', $profilSekolah->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Profil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul', $profilSekolah->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Profil <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('konten') is-invalid @enderror"
                                      id="konten" name="konten" rows="10" required>{{ old('konten', $profilSekolah->konten) }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tulis informasi profil sekolah dengan lengkap</div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Profil</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar</div>
                            @if($profilSekolah->gambar)
                                <div class="mt-2">
                                    <label class="form-label">Gambar Saat Ini:</label><br>
                                    <img src="{{ asset('storage/' . $profilSekolah->gambar) }}" alt="Gambar Profil" width="200" height="150" class="rounded">
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('operator.profil_sekolah.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

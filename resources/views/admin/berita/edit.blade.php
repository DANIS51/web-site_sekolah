@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Berita</h2>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Berita
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
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Berita</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.berita.update', Crypt::encrypt($berita->id_berita)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                           id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', $berita->tanggal) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi') is-invalid @enderror"
                                      id="isi" name="isi" rows="8" required>{{ old('isi', $berita->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Berita</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar</div>
                            @if($berita->gambar)
                                <div class="mt-2">
                                    <label class="form-label">Gambar Saat Ini:</label>
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Update Berita
                            </button>
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
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

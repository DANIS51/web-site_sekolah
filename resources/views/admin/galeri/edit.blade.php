@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Galeri</h2>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Galeri
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
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Galeri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.galeri.update', Crypt::encrypt($galeri->id_galeri)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Galeri <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                           id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required maxlength="50">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori') is-invalid @enderror"
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Foto" {{ old('kategori', $galeri->kategori) == 'Foto' ? 'selected' : '' }}>Foto</option>
                                        <option value="Video" {{ old('kategori', $galeri->kategori) == 'Video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Media</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                           id="file" name="file" accept="image/*,video/*">
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: JPG, PNG, JPEG, GIF, MP4, AVI. Maksimal 200MB. Biarkan kosong jika tidak ingin mengubah file</div>
                                    @if($galeri->file)
                                        <div class="mt-2">
                                            <label class="form-label">File Saat Ini:</label>
                                            <div class="border rounded p-2 bg-light">
                                                @if($galeri->kategori === 'foto')
                                                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="File saat ini" class="img-thumbnail" style="max-width: 150px;">
                                                @elseif($galeri->kategori === 'video')
                                                    <video width="150" height="100" controls class="rounded">
                                                        <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                                        Preview tidak tersedia
                                                    </video>
                                                @endif
                                                <p class="mb-0 mt-2"><small class="text-muted">{{ basename($galeri->file) }}</small></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Upload <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', $galeri->tanggal) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                      id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan', $galeri->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Update Galeri
                            </button>
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
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

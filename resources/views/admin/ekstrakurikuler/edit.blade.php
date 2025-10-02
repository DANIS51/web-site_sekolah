@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Ekstrakurikuler</h2>
                <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Ekstrakurikuler
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
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Ekstrakurikuler</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id_ekskul) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror"
                                           id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
                                    @error('nama_ekskul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pembina" class="form-label">Nama Pembina <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('pembina') is-invalid @enderror"
                                           id="pembina" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina) }}" required>
                                    @error('pembina')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jadwal_latihan" class="form-label">Jadwal Latihan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jadwal_latihan') is-invalid @enderror"
                                           id="jadwal_latihan" name="jadwal_latihan" value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required placeholder="Contoh: Senin & Rabu, 15:00-17:00">
                                    @error('jadwal_latihan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', $ekstrakurikuler->tanggal) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Ekstrakurikuler <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Ekstrakurikuler</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar</div>
                            @if($ekstrakurikuler->gambar)
                                <div class="mt-2">
                                    <label class="form-label">Gambar Saat Ini:</label>
                                    <div class="border rounded p-2 bg-light">
                                        <img src="{{ asset($ekstrakurikuler->gambar) }}?t={{ time() }}" alt="Gambar Ekskul" class="img-thumbnail" style="max-width: 200px;">
                                        <p class="mb-0 mt-2"><small class="text-muted">{{ basename($ekstrakurikuler->gambar) }}</small></p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Update Ekstrakurikuler
                            </button>
                            <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-secondary">
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

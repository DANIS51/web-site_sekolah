@extends('layouts.operator')

@section('title', 'Tambah Ekstrakurikuler Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Tambah Ekstrakurikuler Baru</h2>
                <a href="{{ route('operator.ekstrakurikuler.index') }}" class="btn btn-secondary btn-sm">
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
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Ekstrakurikuler</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('operator.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror"
                                   id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul') }}" required>
                            @error('nama_ekskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jadwal_latihan" class="form-label">Jadwal Latihan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jadwal_latihan') is-invalid @enderror"
                                           id="jadwal_latihan" name="jadwal_latihan" value="{{ old('jadwal_latihan') }}" required placeholder="Contoh: Senin & Rabu, 15:00-17:00">
                                    @error('jadwal_latihan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pembina" class="form-label">Pembina <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('pembina') is-invalid @enderror"
                                           id="pembina" name="pembina" value="{{ old('pembina') }}" required>
                                    @error('pembina')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                   id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Jelaskan tentang kegiatan ekstrakurikuler ini</div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Ekstrakurikuler</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Simpan Ekstrakurikuler
                            </button>
                            <a href="{{ route('operator.ekstrakurikuler.index') }}" class="btn btn-secondary">
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

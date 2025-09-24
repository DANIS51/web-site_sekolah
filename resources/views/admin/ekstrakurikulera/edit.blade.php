@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Ekstrakurikuler</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.ekstrakurikulera.update', $ekstrakurikuler->id_ekskul) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_ekskul" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror" id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
                @error('nama_ekskul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pelatih" class="form-label">Pelatih</label>
                <input type="text" class="form-control @error('pelatih') is-invalid @enderror" id="pelatih" name="pelatih" value="{{ old('pelatih', $ekstrakurikuler->pelatih) }}" required>
                @error('pelatih')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jadwal" class="form-label">Jadwal</label>
                <input type="text" class="form-control @error('jadwal') is-invalid @enderror" id="jadwal" name="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}" required>
                @error('jadwal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $ekstrakurikuler->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                @if($ekstrakurikuler->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="Gambar Ekskul" width="150">
                    </div>
                @endif
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Ekstrakurikuler</button>
            <a href="{{ route('admin.ekstrakurikulera') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Guru')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Guru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Guru</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required>
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $guru->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mapel" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control @error('mapel') is-invalid @enderror" id="mapel" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required>
                @error('mapel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $guru->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $guru->telepon) }}" required>
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($guru->foto)
                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="mt-2" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.guru') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

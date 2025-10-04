@extends('layouts.admin')

@section('title', 'Edit Profil Guru')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Profil Guru</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.guru.update', Crypt::encrypt($guru->id_guru)) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru"
                                            class="img-fluid img-thumbnail mb-3"
                                            style="max-width: 200px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                            style="width: 200px; height: 200px; max-width: 100%;">
                                            <i class="bi bi-person-circle" style="font-size: 100px; color: #6c757d;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3 row align-items-center">
                                        <label for="nama_guru" class="col-sm-4 col-form-label">Nama Guru</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror"
                                                id="nama_guru" name="nama_guru"
                                                value="{{ old('nama_guru', $guru->nama_guru) }}" required>
                                            @error('nama_guru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                                id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required>
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                                name="alamat" rows="3"
                                                required>{{ old('alamat', $guru->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('mapel') is-invalid @enderror"
                                                id="mapel" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required>
                                            @error('mapel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $guru->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="telepon" class="col-sm-4 col-form-label">Telepon</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                                id="telepon" name="telepon" value="{{ old('telepon', $guru->telepon) }}"
                                                required>
                                            @error('telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" accept="image/*">
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                                            <a href="{{ route('admin.guru.index') }}"
                                                class="btn btn-secondary ms-2">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
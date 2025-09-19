@extends('layouts.admin')

@section('title', 'Edit Siswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Siswa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nism" class="form-label">NISM</label>
                    <input type="text" class="form-control" id="nism" name="nism" value="{{ old('nism', $siswa->nism) }}" required maxlength="10">
                    @error('nism')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required maxlength="40">
                    @error('nama_siswa')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                    <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}" required min="1900" max="2100">
                    @error('tahun_masuk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

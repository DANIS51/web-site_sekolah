@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Galeri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $galeri->judul }}" required maxlength="50">
                    @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="foto" {{ $galeri->kategori == 'foto' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ $galeri->kategori == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                    @error('kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" class="form-control" id="file" name="file" accept="image/*,video/*">
                    @if($galeri->file)
                        <small class="form-text text-muted">File saat ini: {{ basename($galeri->file) }}</small>
                    @endif
                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $galeri->tanggal }}" required>
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $galeri->keterangan }}</textarea>
                @error('keterangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.galeri') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection

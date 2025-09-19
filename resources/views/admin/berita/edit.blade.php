@extends('layouts.admin')
@section('title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}">
                    @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ old('tanggal', $berita->tanggal) }}">
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea class="form-control" name="isi" id="isi" rows="5">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="100" height="60" class="img-thumbnail mt-2">
                    @endif
                    @error('gambar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.berita') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

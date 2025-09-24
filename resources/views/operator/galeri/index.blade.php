@extends('layouts.operator')

@section('title', 'Kelola Galeri')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Galeri</h2>
                <a href="{{ route('operator.galeri.create') }}" class="btn btn-primary">
                    <i class="bi bi-images me-2"></i>Tambah Gambar Baru
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Galeri</h6>
                </div>
                <div class="card-body">
                    @if($galeri->count() > 0)
                        <div class="row">
                            @foreach($galeri as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($item->judul, 30) }}</h6>
                                            @if($item->deskripsi)
                                                <p class="card-text text-muted small">{{ Str::limit($item->deskripsi, 50) }}</p>
                                            @endif
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('operator.galeri.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('operator.galeri.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-images fs-1 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada gambar di galeri</h5>
                            <p class="text-muted">Tambahkan gambar pertama untuk memulai galeri sekolah</p>
                            <a href="{{ route('operator.galeri.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Gambar Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

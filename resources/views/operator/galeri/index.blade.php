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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Preview</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galeri as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ Str::limit($item->judul, 30) }}</td>
                                        <td><span class="badge bg-primary">{{ ucfirst($item->kategori) }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($item->kategori === 'Foto')
                                                <img src="{{ $item->fileUrl }}" alt="{{ $item->judul }}" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                            @elseif($item->kategori === 'Video')
                                                <video width="80" height="60" controls class="rounded">
                                                    <source src="{{ $item->fileUrl }}" type="video/mp4">
                                                    Preview tidak tersedia
                                                </video>
                                            @else
                                                <span class="text-muted">Tidak ada preview</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('operator.galeri.edit', $item->id_galeri) }}" class="btn btn-warning btn-sm  me-2">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                                <form action="{{ route('operator.galeri.destroy', $item->id_galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="py-4">
                                                <i class="bi bi-images fs-1 text-muted"></i>
                                                <p class="text-muted mt-2">Belum ada data galeri</p>
                                                <a href="{{ route('operator.galeri.create') }}" class="btn btn-primary mt-2">
                                                    <i class="bi bi-plus-circle me-2"></i>Tambah Galeri Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

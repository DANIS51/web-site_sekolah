@extends('layouts.admin')

@section('title', 'Data Galeri')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data Galeri</h5>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Galeri
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <form method="GET" action="{{ route('admin.galeri') }}" class="d-flex justify-content-end">
                    <div class="input-group input-group-sm w-auto">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari...">
                        <button type="submit" class="btn btn-outline-secondary">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="galeri-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galeris as $index => $galeri)
                        <tr>
                            <td>{{ $galeris->firstItem() + $index }}</td>
                            <td>{{ $galeri->judul }}</td>
                            <td>{{ ucfirst($galeri->kategori) }}</td>
                            <td>{{ $galeri->tanggal }}</td>
                            <td>
                                @if($galeri->kategori === 'foto')
                                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" style="max-width: 100px; max-height: 100px;">
                                @elseif($galeri->kategori === 'video')
                                    <video width="150" height="100" controls>
                                        <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <div>Menampilkan {{ $galeris->firstItem() }} sampai {{ $galeris->lastItem() }} dari {{ $galeris->total() }} entri</div>
            {{ $galeris->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Data Galeri')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Galeri</h5>
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ route('admin.galeri.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari galeri...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Galeri
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="galeri-table">
                    <thead>
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
                        @foreach($galeris as $index => $galeri)
                            <tr>
                                <td>{{ $galeris->firstItem() + $index }}</td>
                                <td>{{ Str::limit($galeri->judul, 30) }}</td>
                                <td><span class="badge bg-primary">{{ ucfirst($galeri->kategori) }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d F Y') }}</td>
                                <td>
                                    @if($galeri->kategori === 'foto')
                                        <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                    @elseif($galeri->kategori === 'video')
                                        <video width="80" height="60" controls class="rounded">
                                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                            Preview tidak tersedia
                                        </video>
                                    @else
                                        <span class="text-muted">Tidak ada preview</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.galeri.edit', Crypt::encrypt($galeri->id_galeri)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', Crypt::encrypt($galeri->id_galeri)) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

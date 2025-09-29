@extends('layouts.admin')

@section('title', 'Kelola Data Galeri')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Data Galeri</h2>
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Galeri Baru
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
                    <div class="row mb-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('admin.galeri') }}" class="d-flex justify-content-end">
                                <div class="input-group input-group-sm w-auto">
                                    <span class="input-group-text">Cari:</span>
                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Cari galeri...">
                                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                                </div>
                                @if(request('per_page'))
                                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
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
                                @forelse($galeris as $index => $galeri)
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
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
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
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div>Menampilkan {{ $galeris->firstItem() }} sampai {{ $galeris->lastItem() }} dari {{ $galeris->total() }} entri</div>
                        {{ $galeris->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

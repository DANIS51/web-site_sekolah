@extends('layouts.admin')

@section('title', 'Kelola Data Berita')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Data Berita</h2>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Berita Baru
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('admin.berita') }}" class="d-flex justify-content-end">
                                <div class="input-group input-group-sm w-auto">
                                    <span class="input-group-text">Cari:</span>
                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Cari berita...">
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
                                    <th>Tanggal</th>
                                    <th>Gambar</th>
                                    <th>Penulis</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritas as $index => $berita)
                                    <tr>
                                        <td>{{ $beritas->firstItem() + $index }}</td>
                                        <td>{{ Str::limit($berita->judul, 50) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($berita->gambar)
                                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $berita->user ? $berita->user->username : 'Unknown' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($berita->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="bi bi-newspaper fs-1 text-muted"></i>
                                                <p class="text-muted mt-2">Belum ada data berita</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div>Menampilkan {{ $beritas->firstItem() }} sampai {{ $beritas->lastItem() }} dari {{ $beritas->total() }} entri</div>
                        {{ $beritas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

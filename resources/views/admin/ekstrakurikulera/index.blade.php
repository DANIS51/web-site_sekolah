@extends('layouts.admin')

@section('title', 'Kelola Data Ekstrakurikuler')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Data Ekstrakurikuler</h2>
                <a href="{{ route('admin.ekstrakurikulera.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Ekstrakurikuler Baru
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Ekstrakurikuler</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('admin.ekstrakurikulera') }}" class="d-flex justify-content-end">
                                <div class="input-group input-group-sm w-auto">
                                    <span class="input-group-text">Cari:</span>
                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Cari ekstrakurikuler...">
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
                                    <th>Nama Ekskul</th>
                                    <th>Pembina</th>
                                    <th>Jadwal Latihan</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ekstrakurikulera as $index => $ekskul)
                                    <tr>
                                        <td>{{ $ekstrakurikulera->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $ekskul->nama_ekskul }}</strong>
                                        </td>
                                        <td>{{ $ekskul->pelatih }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $ekskul->jadwal }}</span>
                                        </td>
                                        <td>{{ Str::limit($ekskul->deskripsi, 50) }}</td>
                                        <td>
                                            @if ($ekskul->gambar)
                                                <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="Gambar Ekskul" class="rounded" style="max-width: 80px; max-height: 60px;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.ekstrakurikulera.edit', $ekskul->id_ekskul) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.ekstrakurikulera.destroy', $ekskul->id_ekskul) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">
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
                                                <i class="bi bi-trophy fs-1 text-muted"></i>
                                                <p class="text-muted mt-2">Belum ada data ekstrakurikuler</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div>Menampilkan {{ $ekstrakurikulera->firstItem() }} sampai {{ $ekstrakurikulera->lastItem() }} dari {{ $ekstrakurikulera->total() }} entri</div>
                        {{ $ekstrakurikulera->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

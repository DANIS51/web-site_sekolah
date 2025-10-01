@extends('layouts.admin')

@section('title', 'Data Ekstrakurikuler')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Ekstrakurikuler</h5>
            <a href="{{ route('admin.ekstrakurikulera.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Ekstrakurikuler
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="search col-12">
                    <form method="GET" action="{{ route('admin.ekstrakurikulera') }}" class="d-flex justify-content-end">
                        <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">Cari:</span>
                            <input type="text" class="form-control" name="search" value="{{ $search }}"
                                placeholder="Cari ekstrakurikuler...">
                            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        </div>
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="ekstrakurikuler-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ekskul</th>
                            <th>Pembina</th>
                            <th>Jadwal Latihan</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ekstrakurikulera as $index => $ekskul)
                            <tr>
                                <td>{{ $ekstrakurikulera->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $ekskul->nama_ekskul }}</strong>
                                </td>
                                <td>{{ $ekskul->pembina }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $ekskul->jadwal_latihan }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($ekskul->tanggal)->format('d F Y') }}</td>
                                <td>{{ Str::limit($ekskul->deskripsi, 50) }}</td>
                                <td>
                                    @if ($ekskul->gambar)
                                        <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="Gambar Ekskul" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.ekstrakurikulera.edit', $ekskul->id_ekskul) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.ekstrakurikulera.destroy', $ekskul->id_ekskul) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">
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

@extends('layouts.operator')

@section('title', 'Kelola Ekstrakurikuler')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Kelola Ekstrakurikuler</h2>
                    <a href="{{ route('operator.ekstrakurikulera.create') }}" class="btn btn-primary">
                        <i class="bi bi-trophy me-2"></i>Tambah Ekstrakurikuler Baru
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Jadwal Latihan</th>
                                        <th>Pembina</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ekstrakurikuler as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_ekskul}}</td>
                                            <td>{{ $item->jadwal_latihan }}</td>
                                            <td>{{ $item->pembina }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                            <td>{{ Str::limit(strip_tags($item->deskripsi), 50) }}</td>
                                            <td>
                                                @if($item->gambar)
                                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Ekstrakurikuler" class="img-fluid rounded" style="max-width: 60px; max-height: 60px;">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('operator.ekstrakurikulera.edit', $item->id_ekskul) }}" class="btn btn-warning btn-sm me-2">
                                                        <i class="bi bi-pencil-square me-2"></i> Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('operator.ekstrakurikulera.destroy', $item->id_ekskul) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">
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
                                            <td colspan="7" class="text-center">Belum ada data ekstrakurikuler</td>
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
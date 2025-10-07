{{-- Perluas template layout operator --}}
@extends('layouts.operator')

{{-- Atur judul halaman untuk data ekstrakurikuler --}}
@section('title', 'Data Ekstrakurikuler')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Periksa apakah ada pesan sukses dari session --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card untuk menampilkan data ekstrakurikuler --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Ekstrakurikuler</h5>
            <div class="d-flex align-items-center">
                {{-- Form untuk pencarian ekstrakurikuler --}}
                <form method="GET" action="{{ route('operator.ekstrakurikuler.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari ekstrakurikuler...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        {{-- Hidden input untuk per_page jika ada --}}
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                {{-- Tombol untuk menambah ekstrakurikuler baru --}}
                <a href="{{ route('operator.ekstrakurikuler.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Ekstrakurikuler
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel untuk menampilkan daftar ekstrakurikuler --}}
                <table class="table table-bordered table-striped" id="ekstrakurikuler-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ekskul</th>
                            <th>Jadwal Latihan</th>
                            <th>Pembina</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop untuk menampilkan setiap data ekstrakurikuler --}}
                        @foreach($ekstrakurikuler as $index => $ekskul)
                            <tr>
                                <td>{{ $ekstrakurikuler->firstItem() + $index }}</td>
                                <td>{{ $ekskul->nama_ekskul }}</td>
                                <td>{{ $ekskul->jadwal_latihan }}</td>
                                <td>{{ $ekskul->pembina }}</td>
                                <td>{{ $ekskul->tanggal ? \Carbon\Carbon::parse($ekskul->tanggal)->format('d F Y') : '-' }}</td>
                                <td>
                                    {{-- Tampilkan gambar ekstrakurikuler jika ada --}}
                                    @if($ekskul->gambar)
                                        <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}"
                                            class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tombol untuk edit ekstrakurikuler --}}
                                    <a href="{{ route('operator.ekstrakurikuler.edit', Crypt::encrypt($ekskul->id_ekstrakurikuler)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Form untuk menghapus ekstrakurikuler --}}
                                    <form
                                        action="{{ route('operator.ekstrakurikuler.destroy', Crypt::encrypt($ekskul->id_ekstrakurikuler)) }}"
                                        method="POST" class="d-inline">
                                        {{-- Token CSRF untuk keamanan --}}
                                        @csrf
                                        {{-- Method untuk delete --}}
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
                {{-- Link pagination --}}
                {{ $ekstrakurikuler->links() }}
            </div>
        </div>
    </div>
@endsection

{{-- Perluas template layout admin --}}
@extends('layouts.admin')

{{-- Atur judul halaman untuk data galeri --}}
@section('title', 'Data Galeri')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Periksa apakah ada pesan sukses dari session --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card untuk menampilkan data galeri --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Galeri</h5>
            <div class="d-flex align-items-center">
                {{-- Form untuk pencarian galeri --}}
                <form method="GET" action="{{ route('admin.galeri.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari galeri...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                {{-- Tombol untuk menambah galeri baru --}}
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Galerix
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel untuk menampilkan daftar galeri --}}
                <table class="table table-bordered table-striped" id="galeri-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop untuk menampilkan setiap data galeri --}}
                        @foreach($galeris as $index => $galeri)
                            <tr>
                                <td>{{ $galeris->firstItem() + $index }}</td>
                                <td>{{ $galeri->judul }}</td>
                                <td>{{ Str::limit($galeri->keterangan, 50) }}</td>
                                <td>{{ $galeri->kategori }}</td>
                                <td>{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d F Y') }}</td>
                                <td>
                                    {{-- Tampilkan file galeri berdasarkan kategori --}}
                                    @if($galeri->kategori == 'Foto')
                                        <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                    @elseif($galeri->kategori == 'Video')
                                        <video width="80" height="60" controls>
                                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tombol untuk edit galeri --}}
                                    <a href="{{ route('admin.galeri.edit', Crypt::encrypt($galeri->id_galeri)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Form untuk menghapus galeri --}}
                                    <form action="{{ route('admin.galeri.destroy', Crypt::encrypt($galeri->id_galeri)) }}"
                                        method="POST" class="d-inline">
                                        {{-- Token CSRF untuk keamanan --}}
                                        @csrf
                                        {{-- Method untuk delete --}}
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

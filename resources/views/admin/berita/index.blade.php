{{-- Perluas template layout admin --}}
@extends('layouts.admin')

{{-- Atur judul halaman untuk data berita --}}
@section('title', 'Data Berita')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Periksa apakah ada pesan sukses dari session --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card untuk menampilkan data berita --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Berita</h5>
            <div class="d-flex align-items-center">
                {{-- Form untuk pencarian berita --}}
                <form method="GET" action="{{ route('admin.berita.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari berita...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                {{-- Tombol untuk menambah berita baru --}}
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Berita
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel untuk menampilkan daftar berita --}}
                <table class="table table-bordered table-striped" id="berita-table">
                    <thead>
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
                        {{-- Loop untuk menampilkan setiap data berita --}}
                        @foreach($beritas as $index => $berita)
                            <tr>
                                <td>{{ $beritas->firstItem() + $index }}</td>
                                <td>{{ Str::limit($berita->judul, 50) }}</td>
                                <td>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</td>
                                <td>
                                    {{-- Tampilkan gambar berita jika ada --}}
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $berita->user ? $berita->user->username : 'Unknown' }}</td>
                                <td>{{ \Carbon\Carbon::parse($berita->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    {{-- Tombol untuk edit berita --}}
                                    <a href="{{ route('admin.berita.edit', Crypt::encrypt($berita->id_berita)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Form untuk menghapus berita --}}
                                    <form action="{{ route('admin.berita.destroy', Crypt::encrypt($berita->id_berita)) }}"
                                        method="POST" class="d-inline">
                                        {{-- Token CSRF untuk keamanan --}}
                                        @csrf
                                        {{-- Method untuk delete --}}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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

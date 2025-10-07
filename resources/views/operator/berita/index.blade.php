{{-- Perluas template layout operator --}}
@extends('layouts.operator')

{{-- Atur judul halaman untuk kelola berita --}}
@section('title', 'Kelola Berita')

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
                <form method="GET" action="{{ route('operator.berita.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari berita...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        {{-- Hidden input untuk per_page jika ada --}}
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                {{-- Tombol untuk menambah berita baru --}}
                <a href="{{ route('operator.berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Berita
                </a>
            </div>
        </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- Tabel untuk menampilkan daftar berita --}}
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Konten</th>
                                    <th>Gambar</th>
                                    <th>Penulis</th>
                                    <th>Tanggal Publikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop untuk menampilkan setiap data berita --}}
                                @forelse($berita as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ Str::limit($item->judul, 50) }}</td>
                                        <td>{{ Str::limit(strip_tags($item->isi), 100) }}</td>
                                        <td>
                                            {{-- Tampilkan gambar berita jika ada --}}
                                            @if($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Berita" class="img-fluid rounded" style="max-width: 80px; max-height: 60px;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->user ? $item->user->username : 'Unknown' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                {{-- Tombol untuk edit berita --}}
                                                <a href="{{ route('operator.berita.edit', Crypt::encrypt($item->id_berita)) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                                {{-- Form untuk menghapus berita --}}
                                                <form action="{{ route('operator.berita.destroy', Crypt::encrypt($item->id_berita)) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    {{-- Token CSRF untuk keamanan --}}
                                                    @csrf
                                                    {{-- Method untuk delete --}}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                {{-- Jika tidak ada data berita --}}
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data berita</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

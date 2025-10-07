{{-- Perluas template layout admin --}}
@extends('layouts.admin')

{{-- Atur judul halaman untuk data profil sekolah --}}
@section('title', 'Data Profil Sekolah')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Periksa apakah ada pesan sukses dari session --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card untuk menampilkan data profil sekolah --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Profil Sekolah</h5>
            <div class="d-flex align-items-center">
                {{-- Form untuk pencarian profil sekolah --}}
                <form method="GET" action="{{ route('admin.profil_sekolah.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari nama sekolah, kepala sekolah, atau NPSN...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        {{-- Hidden input untuk per_page jika ada --}}
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                {{-- Tombol untuk menambah profil sekolah baru --}}
                <a href="{{ route('admin.profil_sekolah.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Profil Sekolah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel untuk menampilkan daftar profil sekolah --}}
                <table class="table table-bordered table-striped" id="profil-sekolah-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Nama Sekolah</th>
                            <th>Kepala Sekolah</th>
                            <th>NPSN</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop untuk menampilkan setiap data profil sekolah --}}
                        @foreach($profils as $index => $profil)
                            <tr>
                                <td>{{ $profils->firstItem() + $index }}</td>
                                <td>
                                    {{-- Tampilkan logo sekolah jika ada --}}
                                    @if($profil->logo)
                                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" class="img-fluid rounded" style="max-width: 60px; max-height: 60px;">
                                    @else
                                        <span class="text-muted">Tidak ada logo</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $profil->nama_sekolah }}</strong>
                                </td>
                                <td>{{ $profil->kepala_sekolah }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $profil->npsn }}</span>
                                </td>
                                <td>{{ $profil->kontak }}</td>
                                <td>
                                    {{-- Tombol untuk edit profil sekolah --}}
                                    <a href="{{ route('admin.profil_sekolah.edit', $profil->id_profil) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Form untuk menghapus profil sekolah --}}
                                    <form action="{{ route('admin.profil_sekolah.destroy', $profil->id_profil) }}"
                                        method="POST" class="d-inline">
                                        {{-- Token CSRF untuk keamanan --}}
                                        @csrf
                                        {{-- Method untuk delete --}}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus profil sekolah ini?')">
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

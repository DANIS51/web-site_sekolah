{{-- Perluas template layout admin --}}
@extends('layouts.admin')

{{-- Atur judul halaman untuk dashboard admin --}}
@section('title', 'Dashboard Admin')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Kontainer utama dengan fluid --}}
    <div class="container-fluid">
        {{-- Baris untuk header dashboard --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-4">Dashboard Admin</h2>
                <p class="text-muted">Selamat datang di sistem manajemen sekolah. Kelola data siswa, guru, berita, galeri,
                    ekstrakurikuler, dan user.</p>
            </div>
        </div>

        {{-- Baris untuk kartu statistik --}}
        <!-- Statistics Cards -->
        <div class="row mb-4">
            {{-- Card untuk total siswa --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fs-2 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card untuk total guru --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-badge fs-2 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card untuk total berita --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Berita</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berita_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-newspaper fs-2 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card untuk total galeri --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Galeri</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $galeri_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-images fs-2 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card untuk ekstrakurikuler --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Ekstrakurikuler</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ekstrakurikuler_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-trophy fs-2 text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card untuk total user --}}
            <div class="col-xl-2 col-lg-3 col-md-6 col-12 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Total User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-circle fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris untuk aksi cepat --}}
        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Tombol tambah siswa --}}
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm btn-block">
                                    <i class="bi bi-person-plus me-2"></i>Tambah Siswa
                                </a>
                            </div>
                            {{-- Tombol tambah guru --}}
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.guru.create') }}" class="btn btn-success btn-sm btn-block">
                                    <i class="bi bi-person-badge me-2"></i>Tambah Guru
                                </a>
                            </div>
                            {{-- Tombol tambah berita --}}
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.berita.create') }}" class="btn btn-info btn-sm btn-block">
                                    <i class="bi bi-plus-circle me-2"></i>Tambah Berita
                                </a>
                            </div>
                            {{-- Tombol tambah galeri --}}
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.galeri.create') }}" class="btn btn-warning btn-sm btn-block">
                                    <i class="bi bi-images me-2"></i>Tambah Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris untuk menu navigasi dan informasi sistem --}}
        <!-- Menu Navigasi -->
        <div class="row">
            {{-- Card menu navigasi --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Menu Navigasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            {{-- Link ke kelola siswa --}}
                            <a href="{{ route('admin.siswa.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-people me-2"></i> Kelola Data Siswa
                            </a>
                            {{-- Link ke kelola guru --}}
                            <a href="{{ route('admin.guru.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-person-badge me-2"></i> Kelola Data Guru
                            </a>
                            {{-- Link ke kelola berita --}}
                            <a href="{{ route('admin.berita.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-newspaper me-2"></i> Kelola Berita
                            </a>
                            {{-- Link ke kelola galeri --}}
                            <a href="{{ route('admin.galeri.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-images me-2"></i> Kelola Galeri
                            </a>
                            {{-- Link ke kelola ekstrakurikuler --}}
                            <a href="{{ route('admin.ekstrakurikuler.index') }}"
                                class="list-group-item list-group-item-action">
                                <i class="bi bi-trophy me-2"></i> Kelola Ekstrakurikuler
                            </a>
                            {{-- Link ke kelola user --}}
                            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                                <i class="bi bi-person-circle me-2"></i> Kelola User
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card informasi sistem --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Role:</strong> Admin
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal:</strong> {{ date('d F Y') }}
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                        <hr>
                        <p class="text-muted small">
                            Sebagai admin, Anda memiliki akses penuh untuk mengelola semua data sistem sekolah.
                            Pastikan untuk selalu memverifikasi data sebelum menyimpan perubahan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

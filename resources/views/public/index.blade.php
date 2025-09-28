@extends('layouts.public')

@section('title', 'Beranda - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Selamat Datang di Website Sekolah</h1>
            <p class="hero-subtitle">Platform informasi terpadu untuk siswa, guru, berita, dan kegiatan sekolah</p>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stats-counter">
                        <div class="stats-number">{{ $totalGuru }}</div>
                        <div class="stats-label">Guru</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stats-counter">
                        <div class="stats-number">{{ $totalSiswa }}</div>
                        <div class="stats-label">Siswa</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stats-counter">
                        <div class="stats-number">{{ $totalGaleri }}</div>
                        <div class="stats-label">Galeri</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stats-counter">
                        <div class="stats-number">{{ $totalEkstrakurikuler }}</div>
                        <div class="stats-label">Ekstrakurikuler</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Profile Section -->
    @if($profilSekolah)
        <section class="py-5">
            <div class="container">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="fas fa-school me-2"></i>
                        Profil Sekolah
                    </h2>
                    <div class="row">
                        <div class="col-md-6">
                            @if($profilSekolah->logo_url)
                                <img src="{{ $profilSekolah->logo_url }}" alt="Logo Sekolah" class="img-fluid mb-3"
                                    style="max-height: 150px;">
                            @endif
                            <h3>{{ $profilSekolah->nama_sekolah }}</h3>
                            <p><strong>NPSN:</strong> {{ $profilSekolah->npsn }}</p>
                            <p><strong>Kepala Sekolah:</strong> {{ $profilSekolah->kepala_sekolah }}</p>
                            <p><strong>Tahun Berdiri:</strong> {{ $profilSekolah->tahun_berdiri }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Alamat</h4>
                            <p>{{ $profilSekolah->alamat }}</p>
                            <h4>Kontak</h4>
                            <p>{{ $profilSekolah->kontak }}</p>
                            @if($profilSekolah->deskripsi)
                                <h4>Deskripsi</h4>
                                <p>{{ Str::limit($profilSekolah->deskripsi, 200) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('public.profil-sekolah') }}" class="btn btn-custom">
                            Lihat Profil Lengkap <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Latest News Section -->
    @if($latestBerita->count() > 0)
        <section class="py-5" style="background-color: var(--light-bg);">
            <div class="container">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="fas fa-newspaper me-2"></i>
                        Berita Terbaru
                    </h2>
                    <div class="row">
                        @foreach($latestBerita as $beritaItem)
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    @if($beritaItem->gambar)
                                        <img src="{{ asset('storage/' . $beritaItem->gambar) }}" alt="{{ $beritaItem->judul }}"
                                            class="news-image img-fluid">
                                    @endif
                                    <div class="news-content">
                                        <h5 class="news-title">{{ Str::limit($beritaItem->judul, 50) }}</h5>
                                        <p class="news-meta">
                                            <i class="fas fa-user me-1"></i> {{ $beritaItem->user->name }} |
                                            <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                        </p>
                                        <p>{{ Str::limit(strip_tags($beritaItem->isi), 100) }}</p>
                                        <a href="{{ route('public.berita.show', $beritaItem->id) }}" class="btn btn-custom btn-sm">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('public.berita') }}" class="btn btn-custom">
                            Lihat Semua Berita <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Quick Access Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-card">
                <h2 class="section-title">
                    <i class="fas fa-th-large me-2"></i>
                    Akses Cepat
                </h2>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.guru') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #6f42c1, #e83e8c); color: white; border-radius: 10px;">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                <div>Guru</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.siswa') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #28a745, #20c997); color: white; border-radius: 10px;">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <div>Siswa</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.galeri') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #17a2b8, #6f42c1); color: white; border-radius: 10px;">
                                <i class="fas fa-images fa-2x mb-2"></i>
                                <div>Galeri</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.ekstrakurikuler') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #ffc107, #fd7e14); color: white; border-radius: 10px;">
                                <i class="fas fa-trophy fa-2x mb-2"></i>
                                <div>Ekstrakurikuler</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.berita') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #dc3545, #e83e8c); color: white; border-radius: 10px;">
                                <i class="fas fa-newspaper fa-2x mb-2"></i>
                                <div>Berita</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <a href="{{ route('public.profil-sekolah') }}" class="text-decoration-none">
                            <div class="text-center p-3"
                                style="background: linear-gradient(135deg, #6c757d, #495057); color: white; border-radius: 10px;">
                                <i class="fas fa-info-circle fa-2x mb-2"></i>
                                <div>Profil</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
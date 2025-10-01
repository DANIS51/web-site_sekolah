@extends('layouts.public')

@section('title', 'Beranda - Website Sekolah')

@section('content')
    <!-- Hero Section -->
<<<<<<< HEAD
    <section class="hero-section d-flex flex-column justify-content-center align-items-center text-center">
        <div class="container" >
            <h1 class="hero-title">Selamat Datang di Website Sekolah</h1>
            <p class="hero-subtitle">Informasi terpadu untuk siswa, guru, berita, dan kegiatan sekolah</p>
            <a href="{{ route('public.berita') }}" class="btn-hero">Lihat Berita Terbaru</a>
=======
    <section class="hero-section text-center text-white d-flex align-items-center"
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/storage/kelas.jpg'); background-size: cover; background-position: center; min-height: 70vh;">
        <div class="container">
            <h1 class="fw-bold mb-3">Selamat Datang di Website Sekolah</h1>
            <p class="lead">Informasi terpadu untuk siswa, guru, berita, dan kegiatan sekolah</p>
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-4">
<<<<<<< HEAD
                    <div class="stats-card stats-card-guru h-100">
                        <i class="fas fa-chalkboard-teacher stats-icon"></i>
                        <h2 class="stats-number">{{ $totalGuru }}</h2>
                        <p class="stats-label">Guru</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="stats-card stats-card-siswa h-100">
                        <i class="fas fa-users stats-icon"></i>
                        <h2 class="stats-number">{{ $totalSiswa }}</h2>
                        <p class="stats-label">Siswa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="stats-card stats-card-galeri h-100">
                        <i class="fas fa-images stats-icon"></i>
                        <h2 class="stats-number">{{ $totalGaleri }}</h2>
                        <p class="stats-label">Galeri</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="stats-card stats-card-ekskul h-100">
                        <i class="fas fa-trophy stats-icon"></i>
                        <h2 class="stats-number">{{ $totalEkstrakurikuler }}</h2>
                        <p class="stats-label">Ekstrakurikuler</p>
=======
                    <div class="p-4 rounded shadow-sm bg-white h-100">
                        <h2 class="fw-bold text-primary">{{ $totalGuru }}</h2>
                        <p class="mb-0">Guru</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white h-100">
                        <h2 class="fw-bold text-primary">{{ $totalSiswa }}</h2>
                        <p class="mb-0">Siswa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white h-100">
                        <h2 class="fw-bold text-primary">{{ $totalGaleri }}</h2>
                        <p class="mb-0">Galeri</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white h-100">
                        <h2 class="fw-bold text-primary">{{ $totalEkstrakurikuler }}</h2>
                        <p class="mb-0">Ekstrakurikuler</p>
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah -->
    @if($profilSekolah)
        <section class="py-5 bg-light">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
<<<<<<< HEAD
                <div class="modern-card p-4">
                    <h2 class="section-title text-primary mb-4"><i class="fas fa-school me-2"></i> Profil Sekolah</h2>
=======
                <div class="p-4 rounded shadow-sm bg-white">
                    <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-school me-2"></i> Profil Sekolah</h2>
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-3">
                            @if($profilSekolah->logo_url)
                                <img src="{{ $profilSekolah->logo_url }}" alt="Logo Sekolah" class="img-fluid mb-3"
                                    style="max-height:120px;">
                            @endif
                            <h5 class="fw-bold">{{ $profilSekolah->nama_sekolah }}</h5>
                            <p class="mb-1"><strong>NPSN:</strong> {{ $profilSekolah->npsn }}</p>
                            <p class="mb-1"><strong>Kepala:</strong> {{ $profilSekolah->kepala_sekolah }}</p>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Alamat:</strong> {{ $profilSekolah->alamat }}</p>
                            <p><strong>Kontak:</strong> {{ $profilSekolah->kontak }}</p>
                            @if($profilSekolah->deskripsi)
                                <p>{{ Str::limit($profilSekolah->deskripsi, 180) }}</p>
                            @endif
                            <a href="{{ route('public.profil-sekolah') }}" class="btn btn-primary mt-2">
                                Lihat Profil Lengkap <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Berita Terbaru -->
    @if($latestBerita->count() > 0)
        <section class="py-5">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
<<<<<<< HEAD
                <div class="section-header">
                    <h2 class="section-title text-primary"><i class="fas fa-newspaper me-2"></i> Berita Terbaru</h2>
                </div>
                <div class="row">
                    @foreach($latestBerita as $beritaItem)
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="modern-card shadow-sm h-100 w-100 d-flex flex-column">
=======
                <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-newspaper me-2"></i> Berita Terbaru</h2>
                <div class="row">
                    @foreach($latestBerita as $beritaItem)
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card shadow-sm h-100 w-100">
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                                @if($beritaItem->gambar)
                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}" class="card-img-top"
                                        alt="{{ $beritaItem->judul }}">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ Str::limit($beritaItem->judul, 50) }}</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-user me-1"></i> {{ $beritaItem->user->name }} |
                                        <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                    </p>
                                    <p class="flex-grow-1">{{ Str::limit(strip_tags($beritaItem->isi), 80) }}</p>
                                    <a href="{{ route('public.berita.show', $beritaItem->id_berita) }}"
                                        class="btn btn-outline-primary btn-sm mt-auto">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('public.berita') }}" class="btn btn-primary">Lihat Semua Berita</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Ekstrakurikuler Terbaru -->
    @if($latestEkstrakurikuler->count() > 0)
        <section class="py-5 bg-light">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
<<<<<<< HEAD
                <div class="section-header">
                    <h2 class="section-title text-primary"><i class="fas fa-trophy me-2"></i> Ekstrakurikuler Terbaru</h2>
                </div>
                <div class="row">
                    @foreach($latestEkstrakurikuler as $ekskul)
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="modern-card w-100 h-100 d-flex flex-column text-center p-3 rounded">
                                @if($ekskul->gambar)
                                    <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center mb-3" style="height: 200px; background: var(--danger-color); border-radius: 10px;">
=======
                <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-trophy me-2"></i> Ekstrakurikuler Terbaru</h2>
                <div class="row">
                    @foreach($latestEkstrakurikuler as $ekskul)
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="ekstra-card shadow-sm w-100 h-100 d-flex flex-column text-center p-3 rounded">
                                @if($ekskul->gambar)
                                    <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center mb-3" style="height: 200px; background: linear-gradient(135deg, #dc2626, #b91c1c); border-radius: 10px;">
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                                        <i class="fas fa-trophy fa-3x text-white"></i>
                                    </div>
                                @endif
                                <h5 class="fw-bold flex-grow-1">{{ $ekskul->nama_ekskul }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('public.ekstrakurikuler') }}" class="btn btn-primary">Lihat Semua Ekstrakurikuler</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Akses Cepat -->
    <section class="py-5" style="background: var(--light-bg);">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
<<<<<<< HEAD
            <h2 class="section-title text-primary text-center mb-4"><i class="fas fa-th-large me-2"></i> Akses Cepat</h2>
            <div class="row text-center g-3">
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.guru') }}" class="quick-access-card w-100">
                        <i class="fas fa-chalkboard-teacher quick-access-icon"></i>
                        <div class="quick-access-title">Guru</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.siswa') }}" class="quick-access-card w-100" style="background: var(--success-color);">
                        <i class="fas fa-users quick-access-icon"></i>
                        <div class="quick-access-title">Siswa</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.galeri') }}" class="quick-access-card w-100" style="background: var(--info-color);">
                        <i class="fas fa-images quick-access-icon"></i>
                        <div class="quick-access-title">Galeri</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.ekstrakurikuler') }}" class="quick-access-card w-100" style="background: var(--warning-color);">
                        <i class="fas fa-trophy quick-access-icon"></i>
                        <div class="quick-access-title">Ekstrakurikuler</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.berita') }}" class="quick-access-card w-100" style="background: var(--secondary-color);">
                        <i class="fas fa-newspaper quick-access-icon"></i>
                        <div class="quick-access-title">Berita</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.profil-sekolah') }}" class="quick-access-card w-100" style="background: var(--dark-text);">
                        <i class="fas fa-info-circle quick-access-icon"></i>
                        <div class="quick-access-title">Profil</div>
=======
            <h2 class="text-center fw-bold mb-4" style="color: var(--primary-color);"><i class="fas fa-th-large me-2"></i>
                Akses Cepat</h2>
            <div class="row text-center">
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.guru') }}" class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--primary-color); color: white;">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                        <div>Guru</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.siswa') }}" class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--success-color); color: white;">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <div>Siswa</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.galeri') }}" class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--info-color); color: white;">
                        <i class="fas fa-images fa-2x mb-2"></i>
                        <div>Galeri</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.ekstrakurikuler') }}"
                        class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--warning-color); color: white;">
                        <i class="fas fa-trophy fa-2x mb-2"></i>
                        <div>Ekstrakurikuler</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.berita') }}" class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--secondary-color); color: white;">
                        <i class="fas fa-newspaper fa-2x mb-2"></i>
                        <div>Berita</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3 d-flex">
                    <a href="{{ route('public.profil-sekolah') }}"
                        class="d-block p-3 rounded shadow-sm text-decoration-none w-100 h-100"
                        style="background: var(--dark-text); color: white;">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <div>Profil</div>
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

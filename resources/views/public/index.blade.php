@extends('layouts.public')

@section('title', 'Beranda - Website Sekolah')

@section('content')
    <style>
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero-section text-center text-white d-flex align-items-center" 
        style="background: url('{{ asset('storage/sma2.webp') }}') no-repeat center; background-size: cover; min-height: 90vh; position: relative; margin-bottom: 30px; padding: 120px 20px;">
        <!-- Overlay -->
 
        <div class="container position-relative z-1" data-aos="zoom-in" data-aos-duration="1200">
            <h1 class="fw-bold display-4 display-md-5 mb-3">Selamat Datang di Website Sekolah Sman 2 Tasikmalaya</h1>
            <p class="lead fs-5 fs-md-6 mb-4">Informasi terpadu untuk siswa, guru, berita, dan kegiatan sekolah</p>
            <a href="{{ route('public.berita') }}" class="btn btn-warning btn-lg shadow">
                <i class="fas fa-newspaper me-2"></i> Lihat Berita Terbaru
            </a>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-2">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary mb-2"></i>
                        <h2 class="fw-bold">{{ $totalGuru }}</h2>
                        <p class="mb-0">Guru</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                        <i class="fas fa-users fa-2x text-success mb-2"></i>
                        <h2 class="fw-bold">{{ $totalSiswa }}</h2>
                        <p class="mb-0">Siswa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                        <i class="fas fa-images fa-2x text-info mb-2"></i>
                        <h2 class="fw-bold">{{ $totalGaleri }}</h2>
                        <p class="mb-0">Galeri</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                        <i class="fas fa-trophy fa-2x text-warning mb-2"></i>
                        <h2 class="fw-bold">{{ $totalEkstrakurikuler }}</h2>
                        <p class="mb-0">Ekstrakurikuler</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah -->
    @if($profilSekolah)
        <section class="py-2">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <h2 class="section-title text-primary mb-4"><i class="fas fa-school me-2"></i> Profil Sekolah</h2>
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-3" data-aos="fade-right" data-aos-delay="200">
                            @if($profilSekolah->logo_url)
                                <img src="{{ $profilSekolah->logo_url }}" alt="Logo Sekolah"
                                    class="img-fluid mb-3" style="max-height:120px;">
                            @endif
                            <h5 class="fw-bold">{{ $profilSekolah->nama_sekolah }}</h5>
                            <p class="mb-1"><strong>NPSN:</strong> {{ $profilSekolah->npsn }}</p>
                            <p class="mb-1"><strong>Kepala:</strong> {{ $profilSekolah->kepala_sekolah }}</p>
                        </div>
                        <div class="col-md-8" data-aos="fade-left" data-aos-delay="300">
                            <p><strong>Alamat:</strong> {{ $profilSekolah->alamat }}</p>
                            <p><strong>Kontak:</strong> {{ $profilSekolah->kontak }}</p>
                            @if($profilSekolah->deskripsi)
                                <p>{{ Str::limit($profilSekolah->deskripsi, 180) }}</p>
                            @endif
                            <a href="{{ route('public.profil-sekolah') }}" class="btn btn-warning mt-2">
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
        <section class="py-2">
            <div class="container">
                <h2 class="section-title text-primary mb-4" data-aos="fade-up"><i class="fas fa-newspaper me-2"></i> Berita Terbaru</h2>
                <div class="row">
                    @foreach($latestBerita as $index => $beritaItem)
                        <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                            <div class="card shadow-sm border-0 rounded-4 h-100 w-100 overflow-hidden">
                                @if($beritaItem->gambar)
                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}"
                                        class="card-img-top" alt="{{ $beritaItem->judul }}"
                                        style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold">{{ Str::limit($beritaItem->judul, 50) }}</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-user me-1"></i> {{ $beritaItem->user->name }} |
                                        <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                    </p>
                                    <p class="flex-grow-1">{{ Str::limit(strip_tags($beritaItem->isi), 80) }}</p>
                                    <a href="{{ route('public.berita.show', $beritaItem->id_berita) }}"
                                        class="btn btn-outline-warning btn-sm mt-auto">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3" data-aos="zoom-in">
                    <a href="{{ route('public.berita') }}" class="btn btn-warning">Lihat Semua Berita</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Ekstrakurikuler Terbaru -->
    @if($latestEkstrakurikuler->count() > 0)
        <section class="py-2">
            <div class="container">
                <h2 class="section-title text-primary mb-4" data-aos="fade-up"><i class="fas fa-trophy me-2"></i> Ekstrakurikuler Terbaru</h2>
                <div class="row">
                    @foreach($latestEkstrakurikuler as $index => $ekskul)
                        <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                            <div class="card shadow-sm border-0 rounded-4 w-100 h-100 text-center p-3">
                                @if($ekskul->gambar)
                                    <img src="{{ asset('storage/' . $ekskul->gambar) }}"
                                        alt="{{ $ekskul->nama_ekskul }}"
                                        class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center mb-3"
                                        style="height: 200px; background: #f5f5f5; border-radius: 10px;">
                                        <i class="fas fa-trophy fa-3x text-warning"></i>
                                    </div>
                                @endif
                                <h5 class="fw-bold">{{ $ekskul->nama_ekskul }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3" data-aos="zoom-in">
                    <a href="{{ route('public.ekstrakurikuler') }}" class="btn btn-warning">Lihat Semua Ekstrakurikuler</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Galeri Terbaru -->
    @if($latestGaleri->count() > 0)
        <section class="py-2">
            <div class="container">
                <h2 class="section-title text-primary mb-4" data-aos="fade-up"><i class="fas fa-images me-2"></i> Galeri Terbaru</h2>
                <div class="row">
                    @foreach($latestGaleri as $index => $galeri)
                        <div class="col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                            <div class="card shadow-sm border-0 rounded-4 h-100 w-100 overflow-hidden">
                                @if($galeri->file)
                                    @if(str_starts_with($galeri->mime_type, 'video/'))
                                        <video class="card-img-top" style="height: 200px; object-fit: cover;" controls>
                                            <source src="{{ asset('storage/' . $galeri->file) }}" type="{{ $galeri->mime_type }}">
                                            Browser tidak mendukung video.
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/' . $galeri->file) }}"
                                            class="card-img-top" alt="{{ $galeri->judul }}"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold">{{ Str::limit($galeri->judul, 50) }}</h5>
                                    @if($galeri->keterangan)
                                        <p class="flex-grow-1">{{ Str::limit(strip_tags($galeri->keterangan), 80) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3" data-aos="zoom-in">
                    <a href="{{ route('public.galeri') }}" class="btn btn-warning">Lihat Semua Galeri</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Akses Cepat -->
    <section class="py-2">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title text-primary text-center mb-4"><i class="fas fa-th-large me-2"></i> Akses Cepat</h2>
            <div class="row g-3 text-center">
                @php $aksesCepat = [
                    ['route' => 'public.guru', 'icon' => 'chalkboard-teacher', 'label' => 'Guru', 'color' => 'text-primary'],
                    ['route' => 'public.siswa', 'icon' => 'users', 'label' => 'Siswa', 'color' => 'text-success'],
                    ['route' => 'public.galeri', 'icon' => 'images', 'label' => 'Galeri', 'color' => 'text-info'],
                    ['route' => 'public.ekstrakurikuler', 'icon' => 'trophy', 'label' => 'Ekskul', 'color' => 'text-warning'],
                    ['route' => 'public.berita', 'icon' => 'newspaper', 'label' => 'Berita', 'color' => 'text-secondary'],
                    ['route' => 'public.profil-sekolah', 'icon' => 'info-circle', 'label' => 'Profil', 'color' => 'text-dark'],
                ]; @endphp
                @foreach($aksesCepat as $i => $menu)
                    <div class="col-6 col-md-2" data-aos="zoom-in" data-aos-delay="{{ $i * 150 }}">
                        <a href="{{ route($menu['route']) }}" class="card h-100 shadow-sm border-0 rounded-4 text-decoration-none text-dark">
                            <div class="card-body">
                                <i class="fas fa-{{ $menu['icon'] }} fa-2x mb-2 {{ $menu['color'] }}"></i>
                                <div class="fw-bold">{{ $menu['label'] }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

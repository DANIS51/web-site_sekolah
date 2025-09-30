@extends('layouts.public')

@section('title', 'Beranda - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center text-white d-flex align-items-center"
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/storage/smp.png'); background-size: cover; background-position: center; min-height: 70vh;">
        <div class="container">
            <h1 class="fw-bold mb-3">Selamat Datang di Website Sekolah</h1>
            <p class="lead">Informasi terpadu untuk siswa, guru, berita, dan kegiatan sekolah</p>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white">
                        <h2 class="fw-bold text-primary">{{ $totalGuru }}</h2>
                        <p class="mb-0">Guru</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white">
                        <h2 class="fw-bold text-primary">{{ $totalSiswa }}</h2>
                        <p class="mb-0">Siswa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white">
                        <h2 class="fw-bold text-primary">{{ $totalGaleri }}</h2>
                        <p class="mb-0">Galeri</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="p-4 rounded shadow-sm bg-white">
                        <h2 class="fw-bold text-primary">{{ $totalEkstrakurikuler }}</h2>
                        <p class="mb-0">Ekstrakurikuler</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah -->
    @if($profilSekolah)
        <section class="py-5 bg-light">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <div class="p-4 rounded shadow-sm bg-white">
                    <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-school me-2"></i> Profil Sekolah</h2>
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
                <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-newspaper me-2"></i> Berita Terbaru</h2>
                <div class="row">
                    @foreach($latestBerita as $beritaItem)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($beritaItem->gambar)
                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}" class="card-img-top"
                                        alt="{{ $beritaItem->judul }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($beritaItem->judul, 50) }}</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-user me-1"></i> {{ $beritaItem->user->name }} |
                                        <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                    </p>
                                    <p>{{ Str::limit(strip_tags($beritaItem->isi), 80) }}</p>
                                    <a href="{{ route('public.berita.show', $beritaItem->id_berita) }}"
                                        class="btn btn-outline-primary btn-sm">
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

    @if($latestEkstrakurikuler->count() > 0)
        <section class="py-5 bg-light">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-center text-primary fw-bold mb-4"><i class="fas fa-trophy me-2"></i> Ekstrakurikuler Terbaru
                </h2>
                <div class="row justify-content-center">
                    @foreach($latestEkstrakurikuler as $ekskul)
                        <div class="col-md-4 mb-4 d-flex justify-content-center">
                            <div class="ekstra-card ">
                                @if($ekskul->gambar)
                                    <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama_ekskul }}" class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #dc2626, #b91c1c); border-radius: 10px;">
                                        <i class="fas fa-trophy fa-3x text-white"></i>
                                    </div>
                                @endif
                                <h5 class="mt-3 fw-bold">{{ $ekskul->nama_ekskul }}</h5>
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
            <h2 class="text-center fw-bold mb-4" style="color: var(--primary-color);"><i class="fas fa-th-large me-2"></i>
                Akses Cepat</h2>
            <div class="row text-center">
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.guru') }}" class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--primary-color); color: white;">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                        <div>Guru</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.siswa') }}" class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--success-color); color: white;">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <div>Siswa</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.galeri') }}" class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--info-color); color: white;">
                        <i class="fas fa-images fa-2x mb-2"></i>
                        <div>Galeri</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.ekstrakurikuler') }}"
                        class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--warning-color); color: white;">
                        <i class="fas fa-trophy fa-2x mb-2"></i>
                        <div>Ekstrakurikuler</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.berita') }}" class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--secondary-color); color: white;">
                        <i class="fas fa-newspaper fa-2x mb-2"></i>
                        <div>Berita</div>
                    </a>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <a href="{{ route('public.profil-sekolah', Crypt::encrypt($beritaItem->id)) }}"
                        class="d-block p-3 rounded shadow-sm text-decoration-none"
                        style="background: var(--dark-text); color: white;">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <div>Profil</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
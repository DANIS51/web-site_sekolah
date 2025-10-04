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
 
        <!-- Sambutan Kepala Sekolah -->
       <section class="py-5 bg-light">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="row g-0 align-items-center">
                <!-- Foto Kepala Sekolah -->
                <div class="col-md-4 bg-opacity-10 text-center p-4" data-aos="fade-right" data-aos-delay="200">
                    <img src="{{ asset('storage/kepalasekolah.webp') }}" 
                         alt="Foto Kepala Sekolah" 
                         class="img-fluid rounded-circle shadow-sm mb-3" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                    <h5 class="fw-bold mt-2 text-black mb-0">Kepala Sekolah</h5>
                    <p class="text-muted small mb-0">SMA Negeri 2  Tasikmalaya </p>
                </div>

                <!-- Isi Sambutan -->
                <div class="col-md-8 p-5" data-aos="fade-left" data-aos-delay="300">
                    <h2 class="fw-bold text-black mb-4 border-bottom pb-2">
                        Sambutan Kepala Sekolah
                    </h2>
                    <p class="lh-lg" style="text-align: justify;">
                        Sebagai institusi pendidikan unggulan di Tasikmalaya, SMA Negeri 2 Tasikmalaya berkomitmen untuk terus berkembang dan beradaptasi dengan kemajuan teknologi informasi. Dengan dukungan tenaga pendidik yang profesional dan fasilitas yang memadai, kami siap memberikan layanan pendidikan yang berkualitas dan relevan dengan kebutuhan zaman.
                    </p>
                    <p class="lh-lg" style="text-align: justify;">
                        Melalui website ini, kami berharap dapat memberikan informasi yang cepat, akurat, dan transparan kepada seluruh siswa, orang tua, dan masyarakat luas. Kami juga terbuka terhadap masukan dan saran demi peningkatan mutu layanan pendidikan di SMA Negeri 2 Tasikmalaya. <strong>Bersama Kita Membangun Generasi Emas yang Berkarakter dan Berprestasi.</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Berita Terbaru -->
    @if($latestBerita->count() > 0)
        <section class="py-2">
            <div class="container">
                <h2 class="section-title text-black mb-4" style="font-size: 40px; font-size: ;"  data-aos="fade-up"> Berita Terbaru</h2>
                @php $chunks = $latestBerita->chunk(3); @endphp
                <div id="berita-carousel" class="carousel slide" data-bs-ride="carousel" data-aos="fade-up">
                    <ol class="carousel-indicators">
                        @foreach($chunks as $index => $chunk)
                            <li data-bs-target="#berita-carousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($chunks as $index => $chunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach($chunk as $beritaItem)
                                        <div class="col-md-4 mb-4 d-flex">
                                            <div class="card shadow-sm border-0 rounded-4 h-100 w-100 overflow-hidden">
                                                @if($beritaItem->gambar)
                                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}"
                                                        class="card-img-top" alt="{{ $beritaItem->judul }}"
                                                        style="height: 250px; object-fit: cover;">
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
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#berita-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#berita-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
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
                <h2 class="section-title text-black mb-4" data-aos="fade-up"></i> Ekstrakurikuler Terbaru</h2>
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
                                        style="height: 300px; background: #f5f5f5; border-radius: 10px;">
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
                <h2 class="section-title text-black mb-4" data-aos="fade-up"> Galeri Terbaru</h2>
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
            <h2 class="section-title text-black text-center mb-4"><i class="fas fa-th-large me-2"></i> Akses Cepat</h2>
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

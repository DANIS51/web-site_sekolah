@extends('layouts.public')

@section('title', 'Galeri - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="hero-title">
                <i class="fas fa-images me-2"></i>
                Galeri Sekolah
            </h1>
            <p class="hero-subtitle">Kumpulan foto dan dokumentasi kegiatan sekolah</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($galeri->count() > 0)
                <div class="row">
                    @foreach($galeri as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="news-card">
                            @if($item->kategori == 'Foto')
                                <img src="{{ $item->fileUrl }}" alt="{{ $item->judul }}" class="news-image">
                            @else
                                <video class="news-image" controls>
                                    <source src="{{ $item->fileUrl }}" type="video/mp4">
                                    Browser tidak mendukung video.
                                </video>
                            @endif
                            <div class="news-content">
                                <h5 class="news-title">{{ $item->judul }}</h5>
                                <p class="news-meta">
                                    <span class="badge bg-primary me-1">{{ ucfirst($item->kategori) }}</span>
                                    {{ $item->tanggal->format('d M Y') }}
                                </p>
                                <p>{{ Str::limit(strip_tags($item->keterangan), 150) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $galeri->links() }}
                </div>
            @else
                <div class="section-card text-center">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h4>Belum ada foto galeri</h4>
                    <p class="text-muted">Foto galeri akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

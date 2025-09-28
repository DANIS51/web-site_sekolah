@extends('layouts.public')

@section('title', 'Galeri - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                <i class="fas fa-images me-2"></i>
                Galeri Sekolah
            </h1>
            <p class="hero-subtitle">Kumpulan foto dan dokumentasi kegiatan sekolah</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5">
        <div class="container">
            @if($galeri->count() > 0)
                <div class="row">
                    @foreach($galeri as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="gallery-item">
                            @if($item->kategori == 'Foto')
                                <img src="{{ $item->fileUrl }}" alt="{{ $item->judul }}" class="gallery-image img-fluid">
                            @else
                                <video class="gallery-image img-fluid" controls>
                                    <source src="{{ $item->fileUrl }}" type="video/mp4">
                                    Browser tidak mendukung video.
                                </video>
                            @endif
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h6 class="text-white">{{ $item->judul }}</h6>
                                    <p class="text-white-50">
                                        <span class="badge bg-primary me-1">{{ ucfirst($item->kategori) }}</span>
                                        {{ $item->tanggal->format('d M Y') }}
                                    </p>
                                </div>
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

    <style>
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            display: flex;
            align-items: flex-end;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 20px;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-info h6 {
            margin: 0;
            font-size: 1rem;
        }

        .gallery-info p {
            margin: 0;
            font-size: 0.8rem;
        }
    </style>
@endsection

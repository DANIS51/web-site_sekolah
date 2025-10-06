@extends('layouts.public')

@section('title', 'Galeri - Website Sekolah')

@section('content')
    <style>
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center position-relative" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                   url('{{ asset('storage/galeri.jpg') }}') no-repeat center;
                   background-size: cover;
                   padding: 120px 20px;
                   margin-top:0;">
        <div class="container position-relative text-white">
            <div class="hero-content px-4 py-4 rounded shadow-lg d-inline-block" style="background: rgba(0,0,0,0.3);">
                <h1 class="fw-bold display-4 display-md-5 text-shadow">
                    <i class="fas fa-images me-2 text-primary"></i> Galeri Sekolah
                </h1>
                <p class="lead mb-0 text-shadow fs-5 fs-md-6">Kumpulan foto dan dokumentasi kegiatan sekolah</p>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($galeri->count() > 0)
                <div class="row g-4">
                    @foreach($galeri as $item)
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card shadow-sm border-0 h-100 w-100 gallery-card">
                                @if($item->kategori == 'Foto')
                                    <img src="{{ $item->fileUrl }}" alt="{{ $item->judul }}" class="card-img-top rounded-top"
                                        style="height: 220px; object-fit: cover;">
                                @else
                                    <video class="card-img-top rounded-top" style="height: 220px; object-fit: cover;" controls>
                                        <source src="{{ $item->fileUrl }}" type="{{ $item->mime_type }}">
                                        Browser tidak mendukung video.
                                    </video>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-primary">{{ $item->judul }}</h5>
                                    <p class="mb-2">
                                        <span class="badge bg-primary">{{ ucfirst($item->kategori) }}</span>
                                        <small class="text-muted ms-2">
                                            <i class="fas fa-calendar me-1"></i> {{ $item->tanggal->format('d M Y') }}
                                        </small>
                                    </p>
                                    <p class="card-text flex-grow-1">
                                        {{ Str::limit(strip_tags($item->keterangan), 100) }}
                                    </p>
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
                <div class="card shadow-sm border-0 text-center p-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h4>Belum ada foto atau video galeri</h4>
                    <p class="text-muted">Dokumentasi kegiatan sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .text-shadow {
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .gallery-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush
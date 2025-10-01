@extends('layouts.public')

@section('title', 'Galeri - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center position-relative" 
        style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('storage/galeri-hero.jpg') }}') no-repeat center; background-size: cover; height: 400px;">
        <div class="container text-center text-white">
            <div class="hero-content px-3 px-md-5 py-4 rounded" 
                 style="background: rgba(0,0,0,0.35); display: inline-block;">
                <h1 class="fw-bold display-5 text-shadow"><i class="fas fa-images me-2"></i> Galeri Sekolah</h1>
                <p class="lead mb-0 text-shadow">Kumpulan foto dan dokumentasi kegiatan sekolah</p>
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
                            <div class="card shadow-sm border-0 h-100 w-100">
                                @if($item->kategori == 'Foto')
                                    <img src="{{ $item->fileUrl }}" 
                                         alt="{{ $item->judul }}" 
                                         class="card-img-top rounded-top" 
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
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->keterangan), 100) }}</p>
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

@extends('layouts.public')

@section('title', 'Berita - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background: url('{{ asset('storage/ber.jpeg') }}') no-repeat center; background-size: cover; padding: 200px;">
        <div class="container text-white">
            <h1 class="hero-title">
                <i class="fas fa-newspaper me-2"></i>
                Berita Sekolah
            </h1>
            <p class="hero-subtitle">Kumpulan berita dan informasi terbaru dari sekolah</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($berita->count() > 0)
                <div class="row">
                    @foreach($berita as $beritaItem)
                        <div class="col-lg-4 col-md-6 mb-4 d-flex">
                            <div class="news-card shadow-sm rounded h-100 w-100 d-flex flex-column">
                                @if($beritaItem->gambar)
                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}" 
                                         alt="{{ $beritaItem->judul }}" 
                                         class="news-image rounded-top" 
                                         style="height:200px; object-fit:cover; width:100%;">
                                @endif
                                <div class="news-content p-3 d-flex flex-column flex-grow-1">
                                    <h5 class="news-title fw-bold">{{ Str::limit($beritaItem->judul, 60) }}</h5>
                                    <p class="news-meta small text-muted mb-2">
                                        <i class="fas fa-user me-1"></i> {{ $beritaItem->user->username }} |
                                        <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                    </p>
                                    <p class="flex-grow-1">{{ Str::limit(strip_tags($beritaItem->isi), 120) }}</p>
                                    <a href="{{ route('public.berita.show', $beritaItem->id_berita) }}" 
                                       class="btn btn-outline-primary btn-sm mt-auto align-self-start">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $berita->links() }}
                </div>
            @else
                <div class="section-card text-center p-5 shadow-sm rounded bg-light">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4>Belum ada berita</h4>
                    <p class="text-muted">Berita sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

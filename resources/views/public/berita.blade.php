@extends('layouts.public')

@section('title', 'Berita - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                <i class="fas fa-newspaper me-2"></i>
                Berita Sekolah
            </h1>
            <p class="hero-subtitle">Kumpulan berita dan informasi terbaru dari sekolah</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5">
        <div class="container">
            @if($berita->count() > 0)
                <div class="row">
                    @foreach($berita as $beritaItem)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="news-card">
                            @if($beritaItem->gambar)
                                <img src="{{ asset('storage/' . $beritaItem->gambar) }}" alt="{{ $beritaItem->judul }}" class="news-image">
                            @endif
                            <div class="news-content">
                                <h5 class="news-title">{{ $beritaItem->judul }}</h5>
                                <p class="news-meta">
                                    <i class="fas fa-user me-1"></i> {{ $beritaItem->user->name }} |
                                    <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                </p>
                                <p>{{ Str::limit(strip_tags($beritaItem->isi), 150) }}</p>
                                <a href="{{ route('public.berita.show', $beritaItem->id) }}" class="btn btn-custom btn-sm">
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
                <div class="section-card text-center">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4>Belum ada berita</h4>
                    <p class="text-muted">Berita sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

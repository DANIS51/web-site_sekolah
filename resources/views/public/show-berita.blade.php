@extends('layouts.public')

@section('title', $berita->judul . ' - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">{{ $berita->judul }}</h1>
            <p class="hero-subtitle">
                <i class="fas fa-user me-1"></i> {{ $berita->user->name }} |
                <i class="fas fa-calendar me-1"></i> {{ $berita->created_at->format('d F Y') }}
            </p>
        </div>
    </section>

    <!-- News Detail Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-card">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid mb-4 rounded">
                @endif

                <div class="news-content">
                    <div class="mb-4">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-user me-2"></i>Penulis</h6>
                            <p>{{ $berita->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-calendar me-2"></i>Tanggal</h6>
                            <p>{{ $berita->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('public.berita') }}" class="btn btn-custom">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Berita
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

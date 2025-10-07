{{-- Perluas template layout publik --}}
@extends('layouts.public')

{{-- Atur judul halaman untuk berita --}}
@section('title', 'Berita - Website Sekolah')

{{-- Bagian konten utama halaman --}}
@section('content')
    <style>
        /* Gaya inline untuk mengubah background dan warna teks body */
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Bagian hero untuk halaman berita -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white" style="background: url('{{ asset('storage/berita.jpg') }}') no-repeat center;
                        background-size: cover;
                        min-height: 300px;
                        position: relative; padding: 120px 20px;">
        <!-- Overlay untuk efek gelap pada background -->
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="container position-relative">
            <h1 class="hero-title fw-bold display-4 display-md-5 mb-3">
                <i class="fas fa-newspaper me-2 text-primary"></i> Berita Sekolah
            </h1>
            <p class="hero-subtitle lead fs-5 fs-md-6">Kumpulan berita dan informasi terbaru dari sekolah</p>
        </div>
    </section>

    {{-- Bagian daftar berita --}}
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            {{-- Periksa apakah ada data berita --}}
            @if($berita->count() > 0)
                <div class="row">
                    {{-- Loop untuk menampilkan setiap berita --}}
                    @foreach($berita as $beritaItem)
                        {{-- Card untuk setiap berita --}}
                        <div class="col-lg-4 col-md-6 mb-4 d-flex">
                            <div class="card news-card shadow-sm border-0 rounded-4 h-100 w-100 d-flex flex-column">
                                {{-- Tampilkan gambar berita jika ada --}}
                                @if($beritaItem->gambar)
                                    <img src="{{ asset('storage/' . $beritaItem->gambar) }}" alt="{{ $beritaItem->judul }}"
                                        class="card-img-top rounded-top-4" style="height:200px; object-fit:cover; width:100%;">
                                @endif
                                <div class="card-body d-flex flex-column flex-grow-1">
                                    <h5 class="card-title fw-bold">{{ Str::limit($beritaItem->judul, 60) }}</h5>
                                    <p class="card-subtitle small text-muted mb-2">
                                        <i class="fas fa-user me-1"></i> {{ $beritaItem->user->username }} |
                                        <i class="fas fa-calendar me-1"></i> {{ $beritaItem->created_at->format('d M Y') }}
                                    </p>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($beritaItem->isi), 120) }}</p>
                                    <a href="{{ route('public.berita.show', $beritaItem->id_berita) }}"
                                        class="btn btn-outline-primary btn-sm mt-auto align-self-start">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bagian pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $berita->links() }}
                </div>
            @else
                {{-- Pesan jika tidak ada berita --}}
                <div class="section-card text-center p-5 shadow-sm rounded bg-light">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4>Belum ada berita</h4>
                    <p class="text-muted">Berita sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

{{-- Push gaya tambahan ke stack styles --}}
@push('styles')
    <style>
        /* Gaya untuk hero section */
        .hero-section {
            padding: 120px 0;
        }

        /* Efek hover untuk card berita */
        .news-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk judul card */
        .card-title {
            font-size: 1.1rem;
            line-height: 1.4;
        }
    </style>
@endpush

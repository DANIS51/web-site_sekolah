@extends('layouts.public')

@section('title', 'Ekstrakurikuler - Website Sekolah')

@section('content')
    <style>
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center position-relative" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                   url('{{ asset('storage/eskuls.jpg') }}') no-repeat center;
                   background-size: cover;
                   min-height: 60vh; padding: 40px 20px;">
        <div class="container position-relative text-white">
            <h1 class="fw-bold display-4 display-md-5 mb-3 text-shadow">
                <i class="fas fa-users me-2 text-primary"></i> Ekstrakurikuler
            </h1>
            <p class="lead text-shadow fs-5 fs-md-6">Berbagai kegiatan seru dan bermanfaat bagi siswa</p>
        </div>
    </section>

    <!-- Ekstrakurikuler Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($ekstrakurikuler->count() > 0)
                <div class="row g-4">
                    @foreach($ekstrakurikuler as $item)
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card shadow-sm border-0 h-100 w-100 ekstrakurikuler-card">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_ekskul }}"
                                        class="card-img-top rounded-top" style="height:220px; object-fit:cover;">
                                @else
                                    <img src="{{ asset('default-ekstrakurikuler.jpg') }}" alt="No Image"
                                        class="card-img-top rounded-top" style="height:220px; object-fit:cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-primary">{{ $item->nama_ekskul }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->deskripsi), 120) }}</p>
                                    <ul class="list-unstyled small text-muted mb-3">
                                        <li><i class="fas fa-user-tie me-1"></i> Pembina: {{ $item->pembina }}</li>
                                        <li><i class="fas fa-calendar-alt me-1"></i> Jadwal: {{ $item->jadwal_latihan }}</li>
                                        <li><i class="fas fa-clock me-1"></i> Tanggal:
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $ekstrakurikuler->links() }}
                </div>
            @else
                <div class="card shadow-sm border-0 text-center p-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4>Belum ada ekstrakurikuler</h4>
                    <p class="text-muted">Kegiatan ekstrakurikuler akan segera ditambahkan.</p>
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

        .ekstrakurikuler-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }

        .ekstrakurikuler-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.2rem;
        }
    </style>
@endpush
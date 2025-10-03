@extends('layouts.public')

@section('title', 'Guru - Website Sekolah')

@section('content')
    <style>
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white"
             style="background:url('{{ asset('storage/guru.jpg') }}') no-repeat center;
                    background-size: cover;
                    min-height: 300px;
                    position: relative; padding: 200px;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="container position-relative">
            <h1 class="hero-title fw-bold display-5 mb-3">
                <i class="fas fa-chalkboard-teacher me-2 text-warning"></i> Data Guru
            </h1>
            <p class="hero-subtitle lead">Daftar tenaga pendidik dan kependidikan di sekolah</p>
        </div>
    </section>

    <!-- Teachers Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($guru->count() > 0)
                <div class="row">
                    @foreach($guru as $guruItem)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                            <div class="card person-card text-center shadow-sm border-0 rounded-4 h-100 w-100">
                                <div class="card-body p-4 d-flex flex-column align-items-center">
                                    @if($guruItem->foto)
                                        <img src="{{ asset('storage/' . $guruItem->foto) }}" 
                                             alt="{{ $guruItem->nama_guru }}" 
                                             class="person-image rounded-circle shadow-sm mb-3"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <div class="person-placeholder d-flex align-items-center justify-content-center rounded-circle shadow-sm mb-3"
                                             style="width: 120px; height: 120px; background: linear-gradient(135deg,#0d6efd,#0dcaf0);">
                                            <i class="fas fa-user fa-2x text-white"></i>
                                        </div>
                                    @endif
                                    <h5 class="card-title fw-semibold mb-1" style="font-size: 16px;">{{ $guruItem->nama_guru }}</h5>
                                    @if($guruItem->mapel)
                                        <p class="card-text text-muted small mb-0">{{ $guruItem->mapel }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $guru->links() }}
                </div>
            @else
                <div class="section-card text-center p-5 shadow-sm rounded bg-light">
                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                    <h4>Belum ada data guru</h4>
                    <p class="text-muted">Data guru akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero-section {
        padding: 120px 0;
    }
    .person-card {
        transition: all 0.3s ease-in-out;
    }
    .person-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

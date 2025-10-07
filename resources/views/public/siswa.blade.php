{{-- Perluas template layout publik --}}
@extends('layouts.public')

{{-- Atur judul halaman untuk data guru --}}
@section('title', 'Siswa - Website Sekolah')

{{-- Bagian konten utama halaman --}}
@section('content')
    <style>
        /* Gaya inline untuk mengubah background dan warna teks body */
        body {
            background: white !important;
            color: black !important;
        }
    </style>
    <!-- Bagian hero untuk halaman guru -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white"
             style="background:url('{{ asset('storage/guru.jpg') }}') no-repeat center;
                    background-size: cover;
                    min-height: 300px;
                    position: relative; padding: 120px 20px;">
        <!-- Overlay untuk efek gelap pada background -->
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="container position-relative">
            <h1 class="hero-title fw-bold display-4 display-md-5 mb-3">
                <i class="fas fa-chalkboard-teacher me-2 text-primary"></i> Data Siswa
            </h1>
            <p class="hero-subtitle lead fs-5 fs-md-6">Daftar Siswa di sekolah</p>
        </div>
    </section>

    {{-- Bagian daftar siswa --}}
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            {{-- Periksa apakah ada data siswa --}}
            @if($siswa->count() > 0)
                <div class="row">
                    {{-- Loop untuk menampilkan setiap siswa --}}
                    @foreach($siswa as $siswaItem)
                        {{-- Card untuk setiap guru --}}
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                            <div class="card person-card text-center shadow-sm border-0 rounded-4 h-100 w-100">
                                <div class="card-body p-4 d-flex flex-column align-items-center">
                                    {{-- Tampilkan foto guru jika ada --}}
                                    @if($siswaItem->foto)
                                        <img src="{{ asset('storage/' . $siswaItem->foto) }}"
                                             alt="{{ $siswaItem->nama_siswa }}"
                                             class="person-image rounded-circle shadow-sm mb-3"
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        {{-- Placeholder jika tidak ada foto --}}
                                        <div class="person-placeholder d-flex align-items-center justify-content-center rounded-circle shadow-sm mb-3"
                                             style="width: 120px; height: 120px; background: linear-gradient(135deg,#0d6efd,#0dcaf0);">
                                            <i class="fas fa-user fa-2x text-white"></i>
                                        </div>
                                    @endif
                                    <h5 class="card-title fw-semibold mb-1" style="font-size: 16px;">{{ $siswaItem->nama_siswa }}</h5>
                                    {{-- Tampilkan mata pelajaran jika ada --}}
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bagian pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $siswa->links() }}
                </div>
            @else
                {{-- Pesan jika tidak ada data guru --}}
                <div class="section-card text-center p-5 shadow-sm rounded bg-light">
                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                    <h4>Belum ada data guru</h4>
                    <p class="text-muted">Data guru akan segera ditambahkan.</p>
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
    /* Gaya untuk card guru */
    .person-card {
        transition: all 0.3s ease-in-out;
    }
    /* Efek hover untuk card guru */
    .person-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

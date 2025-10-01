<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website Sekolah')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/public-theme.css') }}" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('public.index') }}">
                <i class="fas fa-school me-2"></i>Website Sekolah
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.index') ? 'active' : '' }}" href="{{ route('public.index') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.berita*') ? 'active' : '' }}" href="{{ route('public.berita') }}">
                            <i class="fas fa-newspaper me-1"></i>Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.guru') ? 'active' : '' }}" href="{{ route('public.guru') }}">
                            <i class="fas fa-chalkboard-teacher me-1"></i>Guru
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.galeri') ? 'active' : '' }}" href="{{ route('public.galeri') }}">
                            <i class="fas fa-images me-1"></i>Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.ekstrakurikuler') ? 'active' : '' }}" href="{{ route('public.ekstrakurikuler') }}">
                            <i class="fas fa-trophy me-1"></i>Ekstrakurikuler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }}" href="{{ route('public.profil-sekolah') }}">
                            <i class="fas fa-info-circle me-1"></i>Profil Sekolah
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-school me-2"></i>Website Sekolah
                    </h5>
                    <p class="mb-3">Informasi terpadu untuk siswa, guru, dan masyarakat. Menyediakan berita terkini, profil sekolah, dan informasi akademik.</p>
                    <div class="d-flex">
                        <a href="#" class="text-white me-3" title="Facebook">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="#" class="text-white me-3" title="Instagram">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="#" class="text-white me-3" title="Twitter">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="#" class="text-white" title="YouTube">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('public.index') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-home me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.berita') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-newspaper me-1"></i>Berita
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.guru') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-chalkboard-teacher me-1"></i>Guru
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.galeri') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-images me-1"></i>Galeri
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.ekstrakurikuler') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-trophy me-1"></i>Ekstrakurikuler
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('public.profil-sekolah') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-info-circle me-1"></i>Profil Sekolah
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <small>Jl. Pendidikan No. 123<br>Kota Sekolah, Indonesia</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <small>(021) 123-4567</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <small>info@sekolah.sch.id</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock me-2"></i>
                            <small>Senin - Jumat: 07:00 - 15:00</small>
                        </li>
                    </ul>
                </div>

                <!-- School Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Tentang Sekolah</h5>
                    <p class="mb-2"><strong>SMP Negeri 1</strong></p>
                    <p class="small mb-2">NPSN: 12345678</p>
                    <p class="small mb-0">Terakreditasi A</p>
                    <div class="mt-3">
                        <small class="text-white-50">Didukung oleh:</small><br>
                        <span class="badge bg-primary me-1">Laravel</span>
                        <span class="badge bg-info">Bootstrap</span>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

            <!-- Copyright -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 small">&copy; {{ date('Y') }} Website Sekolah. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-white-50">
                        Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk pendidikan
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
=======
@extends('layouts.public')

@section('title', 'Profil Sekolah - Website Sekolah')

@section('content')
<section class="py-5 bg-light">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        @if($profilSekolah)
        <div class="row justify-content-center">
            <!-- Card utama -->
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Kolom kiri: Logo & Foto -->
                        <div class="col-md-5 bg-primary bg-opacity-10 text-center p-4 d-flex flex-column align-items-center justify-content-center">
                            @if($profilSekolah->logo_url)
                                <img src="{{ $profilSekolah->logo_url }}" 
                                     alt="Logo {{ $profilSekolah->nama_sekolah }}" 
                                     class="img-fluid mb-3 rounded-circle border border-2 p-1" 
                                     style="max-height: 150px; object-fit: contain;">
                            @endif
                            @if($profilSekolah->foto_url)
                                <img src="{{ $profilSekolah->foto_url }}" 
                                     alt="Foto {{ $profilSekolah->nama_sekolah }}" 
                                     class="img-fluid rounded shadow-sm w-100 mt-3" 
                                     style="max-height: 250px; object-fit: cover;">
                            @endif
                        </div>

                        <!-- Kolom kanan: Informasi Umum -->
                        <div class="col-md-7 p-4">
                            <h2 class="text-primary fw-bold mb-3">{{ $profilSekolah->nama_sekolah }}</h2>
                            <hr>
                            <h5 class="text-secondary mb-3"><i class="fas fa-id-card me-2"></i> Informasi Umum</h5>
                            <table class="table table-sm table-borderless mb-3">
                                <tr>
                                    <td class="fw-semibold">NPSN</td>
                                    <td>: {{ $profilSekolah->npsn }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Kepala Sekolah</td>
                                    <td>: {{ $profilSekolah->kepala_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Tahun Berdiri</td>
                                    <td>: {{ $profilSekolah->tahun_berdiri }}</td>
                                </tr>
                            </table>

                            <h5 class="text-secondary mt-3"><i class="fas fa-map-marker-alt me-2"></i> Alamat</h5>
                            <p class="mb-2">{{ $profilSekolah->alamat }}</p>

                            <h5 class="text-secondary mt-3"><i class="fas fa-phone me-2"></i> Kontak</h5>
                            <p>{{ $profilSekolah->kontak }}</p>
                        </div>
                    </div>

                    <!-- Deskripsi full width -->
                    @if($profilSekolah->deskripsi)
                    <div class="p-4 border-top">
                        <h5 class="text-secondary"><i class="fas fa-info-circle me-2"></i> Deskripsi</h5>
                        <div class="card bg-white border-light shadow-sm rounded p-3">
                            {$profilSekolah->deskripsi}
                        </div>
                    </div>
                    @endif

                    <!-- Visi & Misi full width -->
                    @if($profilSekolah->visi_misi)
                    <div class="p-4 border-top">
                        <h5 class="text-secondary"><i class="fas fa-eye me-2"></i> Visi & Misi</h5>
                        <div class="card bg-primary bg-opacity-10 border-0 shadow-sm rounded p-3">
                            {$profilSekolah->visi_misi}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
            <div class="card shadow-sm border-0 text-center p-5">
                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                <h4>Profil sekolah belum tersedia</h4>
                <p class="text-muted">Informasi profil sekolah akan segera ditambahkan.</p>
            </div>
        @endif
    </div>
</section>

 
@endsection
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b

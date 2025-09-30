<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi Sekolah - Menampilkan informasi siswa, guru, berita, galeri, dan ekstrakurikuler">
    <title>@yield('title', 'Website Sekolah')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50; /* Elegant dark blue-gray */
            --secondary-color: #7f8c8d; /* Muted gray */
            --success-color: #27ae60; /* Soft green */
            --info-color: #3498db; /* Light blue */
            --warning-color: #f39c12; /* Warm orange */
            --light-bg: #ecf0f1; /* Light gray background */
            --dark-text: #2c3e50; /* Dark text */
            --accent-color: #e74c3c; /* Red accent for highlights */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-text);
        }

        .navbar-custom {
            background: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #f8f9fa !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .hero-section {
            background: var(--primary-color);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-5px);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            margin: 10px auto;
            border-radius: 2px;
        }

        .stats-counter {
            text-align: center;
            padding: 20px;
            background: var(--info-color);
            color: white;
            border-radius: 10px;
            margin: 10px;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .news-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .news-card:hover {
            transform: translateY(-3px);
        }

        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 20px;
        }

        .news-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .news-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .gallery-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.05);
        }

        .person-card {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .person-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid var(--primary-color);
        }

        .person-name {
            font-weight: bold;
            color: var(--primary-color);
        }

        .footer {
            background: var(--dark-text);
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }

        .footer a {
            color: var(--warning-color);
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        .btn-custom {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .section-card {
                padding: 20px;
            }

            .stats-counter {
                margin: 5px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .hero-section {
                padding: 40px 0;
            }

            .news-card, .gallery-item {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-card {
                padding: 15px;
                margin-bottom: 20px;
            }

            .stats-counter {
                padding: 15px;
                margin: 3px;
            }

            .stats-number {
                font-size: 1.5rem;
            }

            .btn-custom {
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            .footer {
                padding: 30px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('public.index') }}">
                <img src="{{ asset('storage/smp.png') }}" alt="Logo Sekolah" style="height: 40px; width: auto;" class="me-2">
                
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.index') }}">
                            <i class="me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.berita') }}">
                            <i class=" me-1"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.galeri') }}">
                            <i class="me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.guru') }}">
                            <i class=" me-1"></i> Guru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.siswa') }}">
                            <i class="me-1"></i> Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.ekstrakurikuler') }}">
                            <i class=" me-1"></i> Ekstrakurikuler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.profil-sekolah') }}">
                            <i class=" me-1"></i> Profil Sekolah
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Admin Login
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
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Informasi Sekolah -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">{{ $profilSekolah ? $profilSekolah->nama_sekolah : 'SMPN 2 Sukaratu' }}</h5>
                    <p class="mb-2">{{ $profilSekolah ? Str::limit($profilSekolah->deskripsi, 150) : 'Platform informasi sekolah yang menyediakan data terbaru tentang siswa, guru, berita, dan kegiatan sekolah.' }}</p>
                    @if($profilSekolah && $profilSekolah->visi_misi)
                        <p class="mb-2"><strong>Visi:</strong> {{ Str::limit($profilSekolah->visi_misi, 100) }}</p>
                    @endif
                    <div class="mt-3">
                        <h6>Ikuti Kami:</h6>
                        <a href="#" class="text-warning me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-warning me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-warning me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-warning"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">Menu Navigasi</h5>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('public.index') }}" class="d-block mb-2">Beranda</a>
                            <a href="{{ route('public.berita') }}" class="d-block mb-2">Berita</a>
                            <a href="{{ route('public.galeri') }}" class="d-block mb-2">Galeri</a>
                            <a href="{{ route('public.guru') }}" class="d-block mb-2">Guru</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('public.siswa') }}" class="d-block mb-2">Siswa</a>
                            <a href="{{ route('public.ekstrakurikuler') }}" class="d-block mb-2">Ekstrakurikuler</a>
                            <a href="{{ route('public.profil-sekolah') }}" class="d-block mb-2">Profil Sekolah</a>
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <h5 class="mb-3">Kontak Kami</h5>
                    @if($profilSekolah)
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>{{ $profilSekolah->alamat }}</p>
                        <p class="mb-2"><i class="fas fa-phone me-2"></i>{{ $profilSekolah->kontak }}</p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i>info@{{ strtolower(str_replace(' ', '', $profilSekolah->nama_sekolah)) }}.sch.id</p>
                        <p class="mb-2"><i class="fas fa-id-card me-2"></i>NPSN: {{ $profilSekolah->npsn }}</p>
                    @else
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. Sukaratu No. 123, Tasikmalaya</p>
                        <p class="mb-2"><i class="fas fa-phone me-2"></i>(0265) 123456</p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i>info@smpn2sukaratu.sch.id</p>
                        <p class="mb-2"><i class="fas fa-id-card me-2"></i>NPSN: 20212345</p>
                    @endif
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $profilSekolah ? $profilSekolah->nama_sekolah : 'SMPN 2 Sukaratu' }}. Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk pendidikan.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

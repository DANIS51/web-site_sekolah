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
            --primary-color: #1e3a8a;
            --secondary-color: #000000;
            --success-color: #1f2937;
            --info-color: #1e40af;
            --warning-color: #3b82f6;
            --light-bg: #f8f9fa;
            --dark-text: #343a40;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-text);
        }

        .navbar-custom {
            background: #1e3a8a;
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
            background: #1e3a8a;
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
            background: #1e40af;
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
            background: #1e3a8a;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #1e40af;
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
            <a class="navbar-brand" href="{{ route('public.index') }}">
                <i class="me-2"></i>
                Website Sekolah
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
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <h5>Smpn 2 Sukaratu</h5>
                    <p>Platform informasi sekolah yang menyediakan data terbaru tentang siswa, guru, berita, dan kegiatan sekolah.</p>
                </div>
                <div class="col-md-6">
                    <h5>Menu Navigasi</h5>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('public.index') }}">Beranda</a><br>
                            <a href="{{ route('public.berita') }}">Berita</a><br>
                            <a href="{{ route('public.galeri') }}">Galeri</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('public.guru') }}">Guru</a><br>
                            <a href="{{ route('public.siswa') }}">Siswa</a><br>
                            <a href="{{ route('public.profil-sekolah') }}">Profil Sekolah</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <p>&copy; {{ date('Y') }} Website Sekolah. Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk pendidikan.</p>
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

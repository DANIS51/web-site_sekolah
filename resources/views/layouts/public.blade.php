<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Website Sekolah')</title>

  <!-- Bootstrap -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: white;
      color: black;
    }

    /* Navbar */
    .navbar-custom {
      background: linear-gradient(135deg, #0f172a, #1e293b);
      padding: 10px 0;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 700;
      font-size: 1.2rem;
    }

    .navbar-nav .nav-link {
      color: #f1f5f9 !important;
      font-weight: 500;
      margin: 0 8px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #ffdd57 !important;
    }

    /* Footer */
    footer {
      background: linear-gradient(135deg, #0f172a, #1e293b);
      font-size: 0.9rem;
    }

    footer h5 {
      font-weight: 600;
      color: #fff;
    }

    footer a {
      transition: 0.3s;
    }

    footer a:hover {
      color: #ffdd57 !important;
    }

    footer .fab {
      transition: transform 0.3s;
    }

    footer .fab:hover {
      transform: scale(1.2);
      color: #ffdd57 !important;
    }

    /* Copyright */
    footer .text-white-50 {
      font-size: 0.8rem;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('public.index') }}">
        <img src="{{ asset('storage/logo-sekolah/sma2.png') }}" alt="Logo Sekolah" style="height: 40px;">
      </a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.index') ? 'active' : '' }}"
              href="{{ route('public.index') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.berita*') ? 'active' : '' }}"
              href="{{ route('public.berita') }}"><i class="fas fa-newspaper me-1"></i>Berita</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.guru') ? 'active' : '' }}"
              href="{{ route('public.guru') }}"><i class="fas fa-chalkboard-teacher me-1"></i>Guru</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.galeri') ? 'active' : '' }}"
              href="{{ route('public.galeri') }}"><i class="fas fa-images me-1"></i>Galeri</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.ekstrakurikuler') ? 'active' : '' }}"
              href="{{ route('public.ekstrakurikuler') }}"><i class="fas fa-trophy me-1"></i>Ekstrakurikuler</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.profil-sekolah') ? 'active' : '' }}"
              href="{{ route('public.profil-sekolah') }}"><i class="fas fa-info-circle me-1"></i>Profil</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main -->
  <main style="margin-top: 60px;">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="text-white py-5 mt-5">
    <div class="container">
      <div class="row">
        <!-- About -->
        <div class="col-lg-4 col-md-6 mb-4">
          <h5><img src="{{ asset('storage/logo-sekolah/sma2.png') }}" alt="Logo Sekolah" style="height: 50px;"
              class="me-2">Website Sekolah</h5>
          <p class="text-white-50">Portal informasi sekolah, berita terbaru, profil guru, galeri, dan ekstrakurikuler.
          </p>
          <div class="d-flex">
            <a href="https://www.instagram.com/sman2tasikmalaya/" class="text-white me-3"><i
                class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@smandatas" class="text-white me-3"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.youtube.com/@sman2tasikmalaya" class="text-white"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Links -->
        <div class="col-lg-2 col-md-6 mb-4">
          <h5>Link Cepat</h5>
          <ul class="list-unstyled">
            <li><a href="{{ route('public.index') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
            <li><a href="{{ route('public.berita') }}" class="text-white-50 text-decoration-none">Berita</a></li>
            <li><a href="{{ route('public.guru') }}" class="text-white-50 text-decoration-none">Guru</a></li>
            <li><a href="{{ route('public.galeri') }}" class="text-white-50 text-decoration-none">Galeri</a></li>
            <li><a href="{{ route('public.ekstrakurikuler') }}"
                class="text-white-50 text-decoration-none">Ekstrakurikuler</a></li>
            <li><a href="{{ route('public.profil-sekolah') }}" class="text-white-50 text-decoration-none">Profil</a>
            </li>
          </ul>
        </div>

        <!-- Contact -->
        <div class="col-lg-3 col-md-6 mb-4">
          <h5>Kontak</h5>
          <ul class="list-unstyled text-white-50">
            <li><i class="fas fa-map-marker-alt me-2"></i>JL. R.E. MARTADINATA NO.261, Panyingkiran, Kec. Indihiang,
              Kota Tasikmalaya, Jawa Barat, 46151</li>
            <li><i class="fas fa-phone me-2"></i>(0265) 331331</li>
            <li><i class="fas fa-envelope me-2"></i>info@smandatas.sch.id</li>
          </ul>
        </div>

        <!-- Info -->
        <div class="col-lg-3 col-md-6 mb-4">
          <h5>Tentang</h5>
          <p class="mb-1"><strong>SMP Negeri 1</strong></p>
          <p class="small mb-1">NPSN: 12345678</p>
          <p class="small">Terakreditasi A</p>
          <div class="mt-2">
            <small class="text-white-50">Didukung oleh:</small><br>
            <span class="badge bg-primary">Laravel</span>
            <span class="badge bg-info">Bootstrap</span>
          </div>
        </div>
      </div>

      <hr style="border-color: rgba(255,255,255,0.1);">

      <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0 small">&copy; {{ date('Y') }} Website Sekolah. All rights reserved.</p>
        <small class="text-white-50">Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk pendidikan</small>
      </div>
    </div>
  </footer>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
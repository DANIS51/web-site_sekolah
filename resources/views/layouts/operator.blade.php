<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Operator - Sistem Sekolah')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
        }
        .content.expanded {
            margin-left: 0;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.85);
            padding: 12px 20px;
            border-radius: 0;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,.15);
            color: #fff;
        }
        /* Toggle button styles */
        #sidebarToggleLabel {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
            background-color: #0d6efd;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        #sidebarToggle:checked ~ .sidebar {
            transform: translateX(0);
        }
        #sidebarToggle:checked + #sidebarToggleLabel {
            display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .content {
                margin-left: 0;
                padding: 15px;
            }
            #sidebarToggleLabel {
                display: block;
                min-height: 44px;
                min-width: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .sidebar .nav-link {
                padding: 10px 15px;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 10px;
            }
            .sidebar .nav-link {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
            #sidebarToggleLabel {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <label for="sidebarToggle" id="sidebarToggleLabel" aria-label="Toggle Sidebar">☰</label>
    <input type="checkbox" id="sidebarToggle" style="display: none;">

    <div class="sidebar bg-primary text-white">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-mortarboard fs-4 me-2"></i>
                    <h5 class="mb-0">Sistem Sekolah</h5>
                </div>
                <button class="btn btn-link text-white d-md-none p-0" onclick="document.getElementById('sidebarToggle').checked = false;" aria-label="Close Sidebar">
                    <i class="bi bi-x-lg fs-4"></i>
                </button>
            </div>
            <hr class="my-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.dashboard')) active @endif" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.siswa*')) active @endif" href="{{ route('operator.siswa.index') }}">
                        <i class="bi bi-person me-2"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.berita*')) active @endif" href="{{ route('operator.berita.index') }}">
                        <i class="bi bi-newspaper me-2"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.galeri*')) active @endif" href="{{ route('operator.galeri.index') }}">
                        <i class="bi bi-images me-2"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.ekstrakurikulera*')) active @endif" href="{{ route('operator.ekstrakurikulera.index') }}">
                        <i class="bi bi-trophy me-2"></i> Ekstrakurikuler
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.profil_sekolah*')) active @endif" href="{{ route('operator.profil_sekolah.index') }}">
                        <i class="bi bi-building me-2"></i> Profil Sekolah
                    </a>
                </li>
            </ul>
            <hr class="my-3">
            <div class="mt-3">
                <a href="{{ route('operator.profile') }}" class="nav-link text-white d-flex align-items-center mb-2">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link text-white d-flex align-items-center border-0 bg-transparent p-0" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

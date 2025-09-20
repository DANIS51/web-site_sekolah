<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Sistem Sekolah')</title>
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
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
            #sidebarToggleLabel {
                display: block;
            }
        }
    </style>
</head>
<body>
    <input type="checkbox" id="sidebarToggle" style="display: none;">
    <label for="sidebarToggle" id="sidebarToggleLabel">☰</label>

    <div class="sidebar bg-primary text-white">
        <div class="p-3">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-mortarboard fs-4 me-2"></i>
                <h5 class="mb-0">Sistem Sekolah</h5>
            </div>
            <hr class="my-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.users*')) active @endif" href="{{ route('admin.users') }}">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.siswa*')) active @endif" href="{{ route('admin.siswa.index') }}">
                        <i class="bi bi-person me-2"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.guru') }}">
                        <i class="bi bi-person-badge me-2"></i> Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.berita') }}">
                        <i class="bi bi-newspaper me-2"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.galeri') }}">
                        <i class="bi bi-images me-2"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.ekstrakurikulera') }}">
                        <i class="bi bi-trophy me-2"></i> Ekstrakurikulera
                    </a>
                </li>
            </ul>
            <hr class="my-3">
            <div class="mt-3">
                <a href="{{ route('admin.profile') }}" class="nav-link text-white d-flex align-items-center mb-2">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link text-white d-flex align-items-center border-0 bg-transparent p-0">
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Sistem Sekolah')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }
        .content.expanded {
            margin-left: 0;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
        /* Toggle button styles */
        #sidebarToggleLabel {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1050;
            background-color: #0d6efd;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
            user-select: none;
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
            /* Checkbox hack: jika dicentang, tampilkan sidebar */
            #sidebarToggle:checked ~ .sidebar {
                transform: translateX(0);
            }
            #sidebarToggle:checked ~ .content {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>
    <input type="checkbox" id="sidebarToggle" style="display: none;">
    <label for="sidebarToggle" id="sidebarToggleLabel">☰</label>
    <div class="sidebar bg-primary text-white">
        <div class="p-3">
            <h5>Sistem Sekolah - Admin</h5>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.users*')) active @endif" href="{{ route('admin.users') }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.siswa*')) active @endif" href="{{ route('admin.siswa.index') }}">
                        <i class="bi bi-person"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.guru') }}">
                        <i class="bi bi-person-badge"></i> Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.berita') }}">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.galeri') }}">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.ekstrakurikulera') }}">
                        <i class="bi bi-trophy"></i> Ekstrakurikulera
                    </a>
                </li>
            </ul>
            <hr>
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

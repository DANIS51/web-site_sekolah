<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Sistem Sekolah')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary-color: #2c3e50;
            /* Elegant dark blue-gray */
            --secondary-color: #7f8c8d;
            /* Muted gray */
            --success-color: #27ae60;
            /* Soft green */
            --info-color: #3498db;
            /* Light blue */
            --warning-color: #f39c12;
            /* Warm orange */
            --light-bg: #ecf0f1;
            /* Light gray background */
            --dark-text: #2c3e50;
            /* Dark text */
            --accent-color: #e74c3c;
            /* Red accent for highlights */
        }

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
            color: rgba(255, 255, 255, .85);
            padding: 12px 20px;
            border-radius: 0;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, .15);
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #sidebarToggle:checked~.sidebar {
            transform: translateX(0);
        }

        #sidebarToggle:checked+#sidebarToggleLabel {
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

        .card-header {
            background-color: white;
            border: none;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 14px;
        }

        .card-header .btn-primary:hover {
            background: linear-gradient(135deg, #3757d6, #19389e);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f1f3f7;
        }

        .table thead th {
            font-size: 16px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            border: none;
            padding: 12px;
            text-align: center;
        }

        .table tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            background-color: #f9fbff
        }

        .table td {
            padding: 12px;
            vertical-align: middle;
            border-top: none;
        }

        .btn-danger {
            background-color: #e74a3b;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .table td {
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search .form-control {
            width: 100%;
            max-width: 400px;
            height: 45px !important;
        }

        @media (max-width: 576px) {
            .search .form-control {
                max-width: 100%;
                height: 40px !important;
            }
        }
    </style>
</head>

<body>
    <input type="checkbox" id="sidebarToggle" style="display: none;">
    <label for="sidebarToggle" id="sidebarToggleLabel" aria-label="Toggle Sidebar">☰</label>

    <div class="sidebar" style="background: var(--primary-color); color: white;">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/smk.gif') }}" alt="Logo Sekolah"
                        style="height: 40px; width: auto;" class="me-2">
                    <h5 class="mb-0">Sistem Sekolah</h5>
                </div>
                <button class="btn btn-link text-white d-md-none p-0"
                    onclick="document.getElementById('sidebarToggle').checked = false;" aria-label="Close Sidebar">
                    <i class="bi bi-x-lg fs-4"></i>
                </button>
            </div>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.3);">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif"
                        href="{{ route('admin.dashboard') }}" style="color: white;">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.users*')) active @endif"
                        href="{{ route('admin.users.index') }}" style="color: white;">
                        <i class="bi bi-person-badge me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.guru*')) active @endif"
                        href="{{ route('admin.guru.index') }}" style="color: white;">
                        <i class="bi bi-person-square me-2"></i> Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.siswa*')) active @endif"
                        href="{{ route('admin.siswa.index') }}" style="color: white;">
                        <i class="bi bi-person me-2"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.berita*')) active @endif"
                        href="{{ route('admin.berita.index') }}" style="color: white;">
                        <i class="bi bi-newspaper me-2"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.galeri*')) active @endif"
                        href="{{ route('admin.galeri.index') }}" style="color: white;">
                        <i class="bi bi-images me-2"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.ekstrakurikuler*')) active @endif"
                        href="{{ route('admin.ekstrakurikuler.index') }}" style="color: white;">
                        <i class="bi bi-trophy me-2"></i> Ekstrakurikuler
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.profil_sekolah*')) active @endif"
                        href="{{ route('admin.profil_sekolah.index') }}" style="color: white;">
                        <i class="bi bi-building me-2"></i> Profil Sekolah
                    </a>
                </li>
            </ul>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.3);">
            <div class="mt-3">
                <a href="{{ route('admin.profile') }}" class="nav-link d-flex align-items-center mb-2"
                    style="color: white;">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link d-flex align-items-center border-0 bg-transparent p-0"
                        style="color: white;" onclick="return confirm('Apakah Anda yakin ingin logout?')">
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
<!-- DOCTYPE dan tag html untuk layout operator -->
<!DOCTYPE html>
<html lang="id">

<!-- Bagian head -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Operator - Sistem Sekolah')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Variabel root untuk tema operator */
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

        /* Gaya sidebar */
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

        /* Sidebar hidden */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        /* Gaya content */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
        }

        /* Content expanded */
        .content.expanded {
            margin-left: 0;
        }

        /* Nav link di sidebar */
        .sidebar .nav-link {
            color: rgba(255, 255, 255, .85);
            padding: 12px 20px;
            border-radius: 0;
        }

        /* Hover nav link */
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
        }

        /* Active nav link */
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, .15);
            color: #fff;
        }

        /* Gaya toggle button */
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

        /* Checked toggle */
        #sidebarToggle:checked~.sidebar {
            transform: translateX(0);
        }

        /* Toggle label checked */
        #sidebarToggle:checked+#sidebarToggleLabel {
            display: none;
        }

        /* Media query untuk mobile */
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

        /* Media query untuk small screen */
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

        /* Card header */
        .card-header {
            background-color: white;
            border: none;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 14px;
        }

        /* Hover btn primary di card header */
        .card-header .btn-primary:hover {
            background: linear-gradient(135deg, #3757d6, #19389e);
        }

        /* Table */
        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-bottom: 0;
        }

        /* Table thead */
        .table thead {
            background-color: #f1f3f7;
        }

        /* Table th */
        .table thead th {
            font-size: 16px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            border: none;
            padding: 12px;
            text-align: center;
        }

        /* Table tbody tr */
        .table tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        /* Hover table tr */
        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            background-color: #f9fbff
        }

        /* Table td */
        .table td {
            padding: 12px;
            vertical-align: middle;
            border-top: none;
        }

        /* Btn danger */
        .btn-danger {
            background-color: #e74a3b;
            border: none;
        }

        /* Hover btn danger */
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Table td center */
        .table td {
            text-align: center;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Search form control */
        .search .form-control {
            width: 100%;
            max-width: 400px;
            height: 45px !important;
        }

        /* Media query for small screen search */
        @media (max-width: 576px) {
            .search .form-control {
                max-width: 100%;
                height: 40px !important;
            }
        }
    </style>
</head>

<!-- Bagian body -->
<body>
    <!-- Label toggle -->
    <label for="sidebarToggle" id="sidebarToggleLabel" aria-label="Toggle Sidebar">☰</label>
    <!-- Input toggle -->
    <input type="checkbox" id="sidebarToggle" style="display: none;">

    <!-- Sidebar -->
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
                {{-- Menu dashboard operator --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.dashboard')) active @endif"
                        href="{{ route('dashboard') }}" style="color: white;">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                {{-- Menu siswa --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.siswa*')) active @endif"
                        href="{{ route('operator.siswa.index') }}" style="color: white;">
                        <i class="bi bi-person me-2"></i> Siswa
                    </a>
                </li>
                {{-- Menu berita --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.berita*')) active @endif"
                        href="{{ route('operator.berita.index') }}" style="color: white;">
                        <i class="bi bi-newspaper me-2"></i> Berita
                    </a>
                </li>
                {{-- Menu galeri --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.galeri*')) active @endif"
                        href="{{ route('operator.galeri.index') }}" style="color: white;">
                        <i class="bi bi-images me-2"></i> Galeri
                    </a>
                </li>
                {{-- Menu ekstrakurikuler --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.ekstrakurikuler*')) active @endif"
                        href="{{ route('operator.ekstrakurikuler.index') }}" style="color: white;">
                        <i class="bi bi-trophy me-2"></i> Ekstrakurikuler
                    </a>
                </li>
                {{-- Menu profil sekolah --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('operator.profil_sekolah*')) active @endif"
                        href="{{ route('operator.profil_sekolah.index') }}" style="color: white;">
                        <i class="bi bi-building me-2"></i> Profil Sekolah
                    </a>
                </li>
            </ul>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.3);">
            <div class="mt-3">
                {{-- Link profile --}}
                <a href="{{ route('operator.profile') }}" class="nav-link d-flex align-items-center mb-2"
                    style="color: white;">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
                <!-- Form logout -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    {{-- CSRF token --}}
                    @csrf
                    <button type="submit" class="nav-link d-flex align-items-center border-0 bg-transparent p-0"
                        style="color: white;" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Content area -->
    <div class="content">
        {{-- Yield content --}}
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

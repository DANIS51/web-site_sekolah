<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator - Sistem Sekolah</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Sekolah - Operator</a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('profile') }}" class="btn btn-outline-light me-2">Profile</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Selamat Datang, {{ $user->username }}!</h1>
                <p class="lead">Dashboard Operator Sistem Sekolah</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Siswa</h5>
                        <h2>{{ $siswa_count }}</h2>
                        <a href="#" class="btn btn-light btn-sm">Kelola Siswa</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Guru</h5>
                        <h2>{{ $guru_count }}</h2>
                        <a href="#" class="btn btn-light btn-sm">Kelola Guru</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Berita</h5>
                        <h2>{{ $berita_count }}</h2>
                        <a href="#" class="btn btn-light btn-sm">Kelola Berita</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Menu Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-primary btn-lg w-100 mb-2">Tambah Siswa</a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success btn-lg w-100 mb-2">Tambah Guru</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-info btn-lg w-100 mb-2">Tambah Berita</a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-secondary btn-lg w-100 mb-2">Pengaturan Sistem</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

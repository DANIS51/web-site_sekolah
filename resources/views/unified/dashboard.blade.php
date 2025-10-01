@extends('layouts.unified')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Selamat Datang, {{ $user->username }}!</h1>
                <p class="lead">
                    @if(strtolower($user->role) == 'admin')
                        Dashboard Admin Sistem Sekolah
                    @else
                        Dashboard Operator Sistem Sekolah
                    @endif
                </p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Siswa</h5>
                        <h2>{{ $siswa_count }}</h2>
                        <a href="{{ $user->role == 'admin' ? route('admin.siswa.index') : route('operator.siswa.index') }}" class="btn btn-light btn-sm">Kelola Siswa</a>
                    </div>
                </div>
            </div>
            @if(strtolower($user->role) == 'admin')
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Guru</h5>
                        <h2>{{ $guru_count }}</h2>
                        <a href="{{ route('admin.guru') }}" class="btn btn-light btn-sm">Kelola Guru</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Berita</h5>
                        <h2>{{ $berita_count }}</h2>
                        <a href="{{ $user->role == 'admin' ? route('admin.berita') : route('operator.berita.index') }}" class="btn btn-light btn-sm">Kelola Berita</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Galeri</h5>
                        <h2>{{ $galeri_count }}</h2>
                        <a href="{{ $user->role == 'admin' ? route('admin.galeri') : route('operator.galeri.index') }}" class="btn btn-light btn-sm">Kelola Galeri</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Ekstrakurikuler</h5>
                        <h2>{{ $ekstrakurikuler_count }}</h2>
<<<<<<< HEAD
                        <a href="{{ $user->role == 'admin' ? route('admin.ekstrakurikuler') : route('operator.ekstrakurikuler.index') }}" class="btn btn-light btn-sm">Kelola Ekstrakurikuler</a>
=======
                        <a href="{{ $user->role == 'admin' ? route('admin.ekstrakurikulera') : route('operator.ekstrakurikulera.index') }}" class="btn btn-light btn-sm">Kelola Ekstrakurikuler</a>
>>>>>>> 6e03421ce05939a6724c87998d21c302ff69da1b
                    </div>
                </div>
            </div>
            @if(strtolower($user->role) == 'admin')
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        <h2>{{ $user_count }}</h2>
                        <a href="{{ route('admin.users') }}" class="btn btn-light btn-sm">Kelola User</a>
                    </div>
                </div>
            </div>
            @endif
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
                                <a href="{{ $user->role == 'admin' ? route('admin.siswa.create') : route('operator.siswa.create') }}" class="btn btn-primary btn-lg w-100 mb-2">Tambah Siswa</a>
                            </div>
                            @if(strtolower($user->role) == 'admin')
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success btn-lg w-100 mb-2">Tambah Guru</a>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ $user->role == 'admin' ? '#' : route('operator.berita.create') }}" class="btn btn-info btn-lg w-100 mb-2">Tambah Berita</a>
                            </div>
                            @if(strtolower($user->role) == 'admin')
                            <div class="col-md-6">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-secondary btn-lg w-100 mb-2">Tambah User</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

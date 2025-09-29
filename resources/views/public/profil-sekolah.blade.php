@extends('layouts.public')

@section('title', 'Profil Sekolah - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="hero-title">
                <i class="fas fa-info-circle me-2"></i>
                Profil Sekolah
            </h1>
            <p class="hero-subtitle">Informasi lengkap tentang sekolah</p>
        </div>
    </section>

    <!-- School Profile Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($profilSekolah)
                <div class="section-card">
                    <div class="row">
                        <div class="col-md-6">
                            @if($profilSekolah->logo_url)
                                <img src="{{ $profilSekolah->logo_url }}" alt="Logo {{ $profilSekolah->nama_sekolah }}" class="img-fluid mb-3" style="max-height: 200px;">
                            @endif
                            @if($profilSekolah->foto_url)
                                <img src="{{ $profilSekolah->foto_url }}" alt="Foto {{ $profilSekolah->nama_sekolah }}" class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-primary">{{ $profilSekolah->nama_sekolah }}</h2>
                            <div class="mb-3">
                                <h5><i class="fas fa-id-card me-2"></i>Informasi Umum</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>NPSN:</strong></td>
                                        <td>{{ $profilSekolah->npsn }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kepala Sekolah:</strong></td>
                                        <td>{{ $profilSekolah->kepala_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tahun Berdiri:</strong></td>
                                        <td>{{ $profilSekolah->tahun_berdiri }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mb-3">
                                <h5><i class="fas fa-map-marker-alt me-2"></i>Alamat</h5>
                                <p>{{ $profilSekolah->alamat }}</p>
                            </div>

                            <div class="mb-3">
                                <h5><i class="fas fa-phone me-2"></i>Kontak</h5>
                                <p>{{ $profilSekolah->kontak }}</p>
                            </div>
                        </div>
                    </div>

                    @if($profilSekolah->deskripsi)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5><i class="fas fa-info-circle me-2"></i>Deskripsi</h5>
                            <div class="alert alert-light">
                                {!! nl2br(e($profilSekolah->deskripsi)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profilSekolah->visi_misi)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5><i class="fas fa-eye me-2"></i>Visi & Misi</h5>
                            <div class="alert alert-primary">
                                {!! nl2br(e($profilSekolah->visi_misi)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            @else
                <div class="section-card text-center">
                    <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                    <h4>Profil sekolah belum tersedia</h4>
                    <p class="text-muted">Informasi profil sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

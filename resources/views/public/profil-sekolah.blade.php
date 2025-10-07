{{-- Perluas template layout publik --}}
@extends('layouts.public')

{{-- Atur judul halaman untuk SEO dan tab browser --}}
@section('title', 'Profil Sekolah - Website Sekolah')

{{-- Gaya CSS kustom untuk halaman profil --}}
@section('styles')
<style>
    /* Variabel root CSS untuk tema */
    :root {
        --primary-color: #0d47a1;  /* Biru elegan */
        --secondary-color: #1565c0;
        --accent-color: #42a5f5;
        --light-color: #f8f9fa;
        --dark-bg: #121212; /* Warna dasar gelap */
        --card-bg: #1e1e1e; /* Card gelap solid */
        --text-light: #e0e0e0;
        --text-muted: #b0bec5;
    }

    /* Gaya body untuk tema gelap */
    body {
        background-color: var(--dark-bg);
        color: var(--text-light);
        font-family: "Poppins", "Segoe UI", sans-serif;
    }

    /* Gaya header halaman */
    .page-header {
        background: var(--secondary-color);
        color: #fff;
        text-align: center;
        padding: 3rem 1rem;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.5);
        margin-bottom: 3rem;
    }

    .school-logo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        margin-bottom: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    }

    /* Gaya card umum */
    .profile-card {
        background-color: var(--card-bg);
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.6);
        transition: all 0.3s ease;
        color: var(--text-light);
    }

    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 22px rgba(0,0,0,0.7);
    }

    .profile-card-header {
        background: var(--primary-color);
        color: #fff;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
        font-size: 1.05rem;
    }

    .profile-card-header i {
        margin-right: 0.6rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        padding: 0.8rem 1.5rem;
        border-bottom: 1px solid #2b2b2b;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--primary-color);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-item h5 {
        margin: 0;
        font-size: 0.95rem;
        color: #fff;
    }

    .info-item p {
        margin: 0;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    /* Gaya konten scroll */
    .content {
        padding: 1.5rem;
        color: var(--text-light);
        line-height: 1.8;
        max-height: 250px;
        overflow-y: auto;
    }

    /* Gaya card fitur */
    .feature-card {
        background-color: var(--card-bg);
        border-radius: 14px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.6);
        transition: all 0.3s ease;
        color: var(--text-light);
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.7);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }

    .section-title {
        color: #fff;
        font-weight: 700;
        border-left: 5px solid var(--primary-color);
        padding-left: 0.75rem;
        margin-bottom: 1.5rem;
    }

    /* Gaya card tidak ada data */
    .no-data-card {
        background-color: var(--card-bg);
        color: var(--text-light);
        border-radius: 14px;
        text-align: center;
        padding: 3rem;
        box-shadow: 0 5px 18px rgba(0,0,0,0.6);
    }

    .no-data-icon {
        font-size: 3.5rem;
        color: var(--accent-color);
        margin-bottom: 1rem;
    }
</style>
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
<!-- Kontainer halaman profil -->
<div class="profile-page">
    {{-- Kontainer utama dengan padding dan animasi --}}
    <div class="container py-5" data-aos="fade-up" data-aos-duration="1000">
        {{-- Periksa apakah data profil ada --}}
        @if($profilSekolah)
            <!-- Bagian header halaman -->
            <div class="page-header">
                {{-- Tampilkan logo sekolah jika tersedia --}}
                @if($profilSekolah->logo_url)
                    <img src="{{ $profilSekolah->logo_url }}" class="school-logo" alt="Logo {{ $profilSekolah->nama_sekolah }}">
                @endif
                <h1 class="fw-bold mb-2">{{ $profilSekolah->nama_sekolah }}</h1>
                <p class="mb-0 fs-5">Mewujudkan Generasi Unggul dan Berkarakter</p>
            </div>

            {{-- Baris untuk informasi sekolah dan foto --}}
            <div class="row justify-content-center mb-4">
                {{-- Card informasi sekolah --}}
                <div class="col-lg-8 mb-4">
                    <div class="profile-card">
                        <div class="profile-card-header"><i class="fas fa-info-circle"></i> Informasi Sekolah</div>
                        <div class="p-3">
                            {{-- Item info untuk kepala sekolah --}}
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                                <div><h5>Kepala Sekolah</h5><p>{{ $profilSekolah->kepala_sekolah }}</p></div>
                            </div>
                            {{-- Item info untuk alamat --}}
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div><h5>Alamat</h5><p>{{ $profilSekolah->alamat }}</p></div>
                            </div>
                            {{-- Item info untuk kontak --}}
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-phone"></i></div>
                                <div><h5>Kontak</h5><p>{{ $profilSekolah->kontak }}</p></div>
                            </div>
                            {{-- Item info untuk NPSN --}}
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-id-card"></i></div>
                                <div><h5>NPSN</h5><p>{{ $profilSekolah->npsn }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card foto sekolah jika tersedia --}}
                @if($profilSekolah->foto_url)
                    <div class="col-lg-4 mb-4">
                        <div class="profile-card h-100">
                            <div class="profile-card-header"><i class="fas fa-camera"></i> Foto Sekolah</div>
                            <div class="p-3 text-center">
                                <img src="{{ $profilSekolah->foto_url }}" alt="Foto {{ $profilSekolah->nama_sekolah }}" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Baris untuk deskripsi dan visi misi --}}
            <div class="row mb-5">
                {{-- Card deskripsi sekolah --}}
                @if($profilSekolah->deskripsi)
                    <div class="col-lg-6 mb-4">
                        <div class="profile-card h-100">
                            <div class="profile-card-header"><i class="fas fa-book"></i> Deskripsi Sekolah</div>
                            <div class="content">{!! $profilSekolah->deskripsi !!}</div>
                        </div>
                    </div>
                @endif

                {{-- Card visi dan misi --}}
                @if($profilSekolah->visi_misi)
                    <div class="col-lg-6 mb-4">
                        <div class="profile-card h-100">
                            <div class="profile-card-header"><i class="fas fa-bullseye"></i> Visi & Misi</div>
                            <div class="content">{!! $profilSekolah->visi_misi !!}</div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Baris untuk fasilitas unggulan --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="section-title">Fasilitas Unggulan</h2>
                </div>
                {{-- Card fasilitas 1 --}}
                <div class="col-md-4 mb-3 d-flex">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-futbol"></i></div>
                        <h5>Olahraga Terpadu</h5>
                        <p>Ekskul olahraga berprestasi dengan lapangan yang representatif.</p>
                    </div>
                </div>
                {{-- Card fasilitas 2 --}}
                <div class="col-md-4 mb-3 d-flex">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-laptop-code"></i></div>
                        <h5>Sarana Ilmiah & Teknologi</h5>
                        <p>Mendukung pembelajaran sains dan teknologi modern.</p>
                    </div>
                </div>
                {{-- Card fasilitas 3 --}}
                <div class="col-md-4 mb-3 d-flex">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-book-open"></i></div>
                        <h5>Pembinaan Karakter & Agama</h5>
                        <p>Fasilitas untuk membentuk akhlak dan karakter siswa.</p>
                    </div>
                </div>
            </div>

        @else
            {{-- Card tidak ada data --}}
            <div class="no-data-card">
                <div class="no-data-icon"><i class="fas fa-school"></i></div>
                <h4>Profil sekolah belum tersedia</h4>
                <p class="text-light mb-4">Informasi akan segera ditambahkan.</p>
                <a href="{{ url('/') }}" class="btn btn-primary px-4"><i class="fas fa-home me-2"></i>Kembali ke Beranda</a>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', 'Profil Sekolah - Website Sekolah')

@section('styles')
    <style>
        :root {
            --primary-color: #1565c0;
            /* biru elegan */
            --secondary-color: #5eb8ff;
            --accent-color: #ef5350;
            --light-color: #f8faff;
            --dark-color: #263238;
            --card-bg: #ffffff;
        }

        body {
            background-color: #ffffff !important;
            font-family: "Poppins", "Segoe UI", sans-serif;
            color: var(--dark-color);
        }

        .profile-page {
            background-color: #ffffff;
            padding-bottom: 3rem;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 1rem;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 80px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,154.7C384,160,480,192,576,186.7C672,181,768,139,864,106.7C960,75,1056,53,1152,85.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"/></svg>');
            background-size: cover;
        }

        .school-logo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            margin-bottom: 1rem;
        }

        /* Card umum */
        .profile-card {
            background: var(--card-bg);
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid #eef2f6;
        }

        .profile-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
        }

        .profile-card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            font-size: 1.05rem;
        }

        .profile-card-header i {
            margin-right: 0.6rem;
        }

        .info-item {
            display: flex;
            align-items: start;
            gap: 0.8rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f2f2f2;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .info-item h5 {
            margin: 0;
            font-size: 0.95rem;
            color: var(--primary-color);
        }

        .info-item p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--dark-color);
        }

        /* Section Title */
        .section-title {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--secondary-color);
            padding-left: 0.75rem;
        }

        /* Feature Card */
        .feature-card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-top: 4px solid var(--secondary-color);
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        /* Contact */
        .contact-info {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            border-radius: 18px;
            padding: 3rem 1rem;
            text-align: center;
            margin-top: 3rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-info .btn-light {
            color: var(--primary-color);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .contact-info .btn-light:hover {
            transform: scale(1.05);
            color: var(--secondary-color);
        }

        /* Deskripsi dan Visi-Misi Card */
        .profile-card .content {
            padding: 1.5rem;
            line-height: 1.8;
            color: var(--dark-color);
        }

        .profile-card .content p {
            margin-bottom: 1rem;
        }

        /* Jika data kosong */
        .no-data-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .no-data-icon {
            font-size: 3.5rem;
            color: #b0bec5;
            margin-bottom: 1rem;
        }

        /* Batasi tinggi dan tambahkan scroll untuk deskripsi dan visi misi */
        .profile-card .content {
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
    <div class="profile-page">
        <div class="container py-5" data-aos="fade-up" data-aos-duration="1000">
            @if($profilSekolah)
                <div class="page-header d-flex flex-column align-items-center justify-content-center">
                    @if($profilSekolah->logo_url)
                        <img src="{{ $profilSekolah->logo_url }}" class="school-logo" alt="Logo {{ $profilSekolah->nama_sekolah }}">
                    @endif
                    <h1 class="fw-bold mb-2 text-center">{{ $profilSekolah->nama_sekolah }}</h1>
                    <p class="mb-0 fs-5 text-center">Mewujudkan Generasi Unggul dan Berkarakter</p>
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 mb-4">
                        <div class="profile-card">
                            <div class="profile-card-header"><i class="fas fa-info-circle"></i> Informasi Sekolah</div>
                            <div class="p-4">
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                                    <div>
                                        <h5>Kepala Sekolah</h5>
                                        <p>{{ $profilSekolah->kepala_sekolah }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div>
                                        <h5>Alamat</h5>
                                        <p>{{ $profilSekolah->alamat }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                                    <div>
                                        <h5>Kontak</h5>
                                        <p>{{ $profilSekolah->kontak }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-id-card"></i></div>
                                    <div>
                                        <h5>NPSN</h5>
                                        <p>{{ $profilSekolah->npsn }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($profilSekolah->foto_url)
                        <div class="col-lg-4 mb-4">
                            <div class="profile-card h-100">
                                <div class="profile-card-header"><i class="fas fa-camera"></i> Foto Sekolah</div>
                                <div class="p-3 text-center">
                                    <img src="{{ $profilSekolah->foto_url }}" alt="Foto {{ $profilSekolah->nama_sekolah }}"
                                        class="img-fluid rounded shadow-sm">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row mb-5">
                    @if($profilSekolah->deskripsi)
                        <div class="col-lg-6 mb-4">
                            <div class="profile-card h-100">
                                <div class="profile-card-header"><i class="fas fa-book"></i> Deskripsi Sekolah</div>
                                <div class="content">{!! $profilSekolah->deskripsi !!}</div>
                            </div>
                        </div>
                    @endif

                    @if($profilSekolah->visi_misi)
                        <div class="col-lg-6 mb-4">
                            <div class="profile-card h-100">
                                <div class="profile-card-header"><i class="fas fa-bullseye"></i> Visi & Misi</div>
                                <div class="content">{!! $profilSekolah->visi_misi !!}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="section-title">Fasilitas Unggulan</h2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-flask"></i></div>
                            <h5>Laboratorium Sains</h5>
                            <p class="text-muted">Laboratorium modern untuk pembelajaran eksperimen sains.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-book-open"></i></div>
                            <h5>Perpustakaan Digital</h5>
                            <p class="text-muted">Akses ribuan buku digital dan sumber belajar online.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-laptop-code"></i></div>
                            <h5>Laboratorium Komputer</h5>
                            <p class="text-muted">Fasilitas komputer berteknologi tinggi untuk siswa.</p>
                        </div>
                    </div>
                </div>

                <div class="contact-info">
                    <h3 class="mb-3">Ingin Tahu Lebih Banyak?</h3>
                    <p class="mb-4">Hubungi kami untuk informasi program & pendaftaran.</p>
                    <a href="tel:{{ $profilSekolah->kontak }}" class="btn btn-light btn-lg px-4"><i
                            class="fas fa-phone me-2"></i>Hubungi Kami</a>
                </div>

            @else
                <div class="no-data-card">
                    <div class="no-data-icon"><i class="fas fa-school"></i></div>
                    <h4>Profil sekolah belum tersedia</h4>
                    <p class="text-muted mb-4">Informasi akan segera ditambahkan.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary px-4"><i class="fas fa-home me-2"></i>Kembali ke Beranda</a>
                </div>
            @endif
        </div>
    </div>
@endsection
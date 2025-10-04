@extends('layouts.public')

@section('title', 'Profil Sekolah - Website Sekolah')

@section('content')
 

<div class="container py-5" data-aos="fade-up" data-aos-duration="1000">
    @if($profilSekolah)
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Judul Halaman -->
            <div class="text-center mb-4 p-4 rounded-4 shadow-sm bg-white">
                <h1 class="fw-bold text-primary">{{ $profilSekolah->nama_sekolah }}</h1>
                <p class="mb-0 text-muted">Profil & Informasi Resmi</p>
            </div>

            <!-- Card utama -->
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="row g-0">

                    <!-- Kolom kiri: Logo & Foto -->
                    <div class="col-md-5 bg-white text-center p-4 d-flex flex-column align-items-center justify-content-center">
                        @if($profilSekolah->logo_url)
                            <img src="{{ $profilSekolah->logo_url }}"
                                 alt="Logo {{ $profilSekolah->nama_sekolah }}"
                                 class="img-fluid mb-3 rounded-circle border border-3 border-primary shadow-sm"
                                 style="max-height: 140px; object-fit: contain;">
                        @endif
                        @if($profilSekolah->foto_url)
                            <img src="{{ $profilSekolah->foto_url }}"
                                 alt="Foto {{ $profilSekolah->nama_sekolah }}"
                                 class="img-fluid rounded shadow mt-3"
                                 style="max-height: 240px; object-fit: cover;">
                        @endif
                    </div>

                    <!-- Kolom kanan: Informasi -->
                    <div class="col-md-7 p-4 bg-white">
                        <h4 class="fw-bold text-primary mb-3"><i class="fas fa-id-card me-2"></i> Informasi Umum</h4>
                        <table class="table table-sm table-borderless mb-3">
                            <tr>
                                <td class="fw-semibold">NPSN</td>
                                <td><span class="badge bg-secondary">{{ $profilSekolah->npsn }}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Kepala Sekolah</td>
                                <td>{{ $profilSekolah->kepala_sekolah }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tahun Berdiri</td>
                                <td>{{ $profilSekolah->tahun_berdiri }}</td>
                            </tr>
                        </table>

                        <h5 class="text-primary"><i class="fas fa-map-marker-alt me-2"></i> Alamat</h5>
                        <p class="mb-3">{{ $profilSekolah->alamat }}</p>

                        <h5 class="text-primary"><i class="fas fa-phone me-2"></i> Kontak</h5>
                        <p>{{ $profilSekolah->kontak }}</p>
                    </div>
                </div>

                <!-- Accordion untuk deskripsi & visi misi -->
                <div class="accordion accordion-flush p-4" id="accordionProfil">

                    @if($profilSekolah->deskripsi)
                    <div class="accordion-item mb-2 border rounded">
                        <h2 class="accordion-header" id="headingDesc">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDesc">
                                <i class="fas fa-info-circle me-2 text-primary"></i> Deskripsi
                            </button>
                        </h2>
                        <div id="collapseDesc" class="accordion-collapse collapse" data-bs-parent="#accordionProfil">
                            <div class="accordion-body">
                                {!! $profilSekolah->deskripsi !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profilSekolah->visi_misi)
                    <div class="accordion-item border rounded">
                        <h2 class="accordion-header" id="headingVisi">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVisi">
                                <i class="fas fa-eye me-2 text-primary"></i> Visi & Misi
                            </button>
                        </h2>
                        <div id="collapseVisi" class="accordion-collapse collapse" data-bs-parent="#accordionProfil">
                            <div class="accordion-body">
                                {!! $profilSekolah->visi_misi !!}
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @else
        <div class="card shadow-sm border-0 text-center p-5 bg-white">
            <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
            <h4>Profil sekolah belum tersedia</h4>
            <p class="text-muted">Informasi profil sekolah akan segera ditambahkan.</p>
        </div>
    @endif
</div>
@endsection

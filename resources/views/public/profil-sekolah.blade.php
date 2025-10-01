@extends('layouts.public')

@section('title', 'Profil Sekolah - Website Sekolah')

@section('content')
<section class="py-5 bg-light">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        @if($profilSekolah)
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="row g-4">
                    <!-- Logo & Foto -->
                    <div class="col-md-5 d-flex flex-column align-items-center text-center">
                        @if($profilSekolah->logo_url)
                            <img src="{{ $profilSekolah->logo_url }}" 
                                 alt="Logo {{ $profilSekolah->nama_sekolah }}" 
                                 class="img-fluid mb-3 rounded-circle border border-2 p-1" 
                                 style="max-height: 150px; object-fit: contain;">
                        @endif
                        @if($profilSekolah->foto_url)
                            <img src="{{ $profilSekolah->foto_url }}" 
                                 alt="Foto {{ $profilSekolah->nama_sekolah }}" 
                                 class="img-fluid rounded shadow-sm w-100 mb-3" 
                                 style="max-height: 300px; object-fit: cover;">
                        @endif
                    </div>

                    <!-- Informasi Umum -->
                    <div class="col-md-7">
                        <h2 class="text-primary fw-bold mb-3">{{ $profilSekolah->nama_sekolah }}</h2>
                        <hr>
                        <h5 class="text-secondary mb-3"><i class="fas fa-id-card me-2"></i> Informasi Umum</h5>
                        <table class="table table-sm table-borderless mb-3">
                            <tr>
                                <td class="fw-semibold">NPSN</td>
                                <td>: {{ $profilSekolah->npsn }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Kepala Sekolah</td>
                                <td>: {{ $profilSekolah->kepala_sekolah }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tahun Berdiri</td>
                                <td>: {{ $profilSekolah->tahun_berdiri }}</td>
                            </tr>
                        </table>

                        <h5 class="text-secondary mt-3"><i class="fas fa-map-marker-alt me-2"></i> Alamat</h5>
                        <p class="mb-2">{{ $profilSekolah->alamat }}</p>

                        <h5 class="text-secondary mt-3"><i class="fas fa-phone me-2"></i> Kontak</h5>
                        <p>{{ $profilSekolah->kontak }}</p>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if($profilSekolah->deskripsi)
                    <div class="mt-4">
                        <h5 class="text-secondary"><i class="fas fa-info-circle me-2"></i> Deskripsi</h5>
                        <div class="card bg-white border-light shadow-sm rounded p-3">
                            {!! nl2br(e($profilSekolah->deskripsi)) !!}
                        </div>
                    </div>
                @endif

                <!-- Visi & Misi -->
                @if($profilSekolah->visi_misi)
                    <div class="mt-4">
                        <h5 class="text-secondary"><i class="fas fa-eye me-2"></i> Visi & Misi</h5>
                        <div class="card bg-primary bg-opacity-10 border-0 shadow-sm rounded p-3">
                            {!! nl2br(e($profilSekolah->visi_misi)) !!}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="card shadow-sm border-0 text-center p-5">
                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                <h4>Profil sekolah belum tersedia</h4>
                <p class="text-muted">Informasi profil sekolah akan segera ditambahkan.</p>
            </div>
        @endif
    </div>
</section>


@endsection

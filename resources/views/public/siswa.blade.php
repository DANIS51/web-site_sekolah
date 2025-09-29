@extends('layouts.public')

@section('title', 'Siswa - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container" >
            <h1 class="hero-title">
                <i class="fas fa-users me-2"></i>
                Data Siswa
            </h1>
            <p class="hero-subtitle">Daftar peserta didik di sekolah</p>
        </div>
    </section>

    <!-- Students Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($siswa->count() > 0)
                <div class="row">
                    @foreach($siswa as $siswaItem)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="person-card">
                            @if($siswaItem->foto)
                                <img src="{{ asset('storage/' . $siswaItem->foto) }}" alt="{{ $siswaItem->nama }}" class="person-image img-fluid">
                            @else
                                <div class="person-image d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--success-color), var(--info-color));">
                                    <i class="fas fa-user-graduate fa-2x text-white"></i>
                                </div>
                            @endif
                            <h6 class="person-name">{{ $siswaItem->nama }}</h6>
                            <p class="text-muted mb-1">{{ $siswaItem->kelas }}</p>
                            @if($siswaItem->jenis_kelamin)
                                <small class="text-info">
                                    <i class="fas fa-{{ $siswaItem->jenis_kelamin == 'L' ? 'male' : 'female' }} me-1"></i>
                                    {{ $siswaItem->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </small>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $siswa->links() }}
                </div>
            @else
                <div class="section-card text-center">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4>Belum ada data siswa</h4>
                    <p class="text-muted">Data siswa akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

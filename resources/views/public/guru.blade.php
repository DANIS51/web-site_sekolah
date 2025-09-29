@extends('layouts.public')

@section('title', 'Guru - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                Data Guru
            </h1>
            <p class="hero-subtitle">Daftar tenaga pendidik dan kependidikan di sekolah</p>
        </div>
    </section>

    <!-- Teachers Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($guru->count() > 0)
                <div class="row">
                    @foreach($guru as $guruItem)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="person-card card text-center shadow-sm h-100">
                            <div class="card-body p-3">
                                @if($guruItem->foto)
                                    <img src="{{ asset('storage/' . $guruItem->foto) }}" alt="{{ $guruItem->nama_guru }}" class="person-image rounded-circle img-fluid mx-auto d-block" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="person-image d-flex align-items-center justify-content-center rounded-circle mx-auto" style="width: 150px; height: 150px; background-color: green; margin-bottom: 1rem;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                @endif
                                <h5 class="card-title text-black mb-2" style="font-size: 16px; font-family: 'Poppins', sans-serif;">{{ $guruItem->nama_guru }}</h5>
                                @if($guruItem->mapel)
                                    <p class="card-text text-muted mb-0" style="font-family: 'Poppins', sans-serif; font-size: 14px;">{{ $guruItem->mapel }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $guru->links() }}
                </div>
            @else
                <div class="section-card text-center">
                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                    <h4>Belum ada data guru</h4>
                    <p class="text-muted">Data guru akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

 @extends('layouts.public')

@section('title', 'Ekstrakurikuler - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section hero-ekstrakurikuler">
        <div class="overlay"></idiv>
        <div class="container text-center text-white position-relative">
            <h1 class="hero-title-ekstra">
                Ekstrakurikuler
                <span class="underline-red"></span>
            </h1>
            <p class="hero-subtitle-ekstra">Beragam kegiatan ekstrakurikuler yang dapat diikuti untuk mengembangkan bakat dan minat siswa dalam upaya pengembangan diri siswa.</p>
        </div>
    </section>

    <!-- Extracurricular Cards Section -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            @if($ekstrakurikuler->count() > 0)
                <div class="row justify-content-center">
                    @foreach($ekstrakurikuler as $item)
                    <div class="col-md-4 mb-4 d-flex justify-content-center">
                        <div class="ekstra-card ">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_ekstrakurikuler }}" class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #dc2626, #b91c1c); border-radius: 10px;">
                                    <i class="fas fa-trophy fa-3x text-white"></i>
                                </div>
                            @endif
                            <h5 class="mt-3 fw-bold">{{ $item->nama_ekskul }}</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                    <h4>Belum ada kegiatan ekstrakurikuler</h4>
                    <p class="text-muted">Kegiatan ekstrakurikuler akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

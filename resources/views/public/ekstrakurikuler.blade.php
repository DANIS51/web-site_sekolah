@extends('layouts.public')

@section('title', 'Ekstrakurikuler - Website Sekolah')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                <i class="fas fa-trophy me-2"></i>
                Ekstrakurikuler
            </h1>
            <p class="hero-subtitle">Kegiatan ekstrakurikuler dan pengembangan diri siswa</p>
        </div>
    </section>

    <!-- Extracurricular Section -->
    <section class="py-5">
        <div class="container">
            @if($ekstrakurikuler->count() > 0)
                <div class="row">
                    @foreach($ekstrakurikuler as $item)
                    <div class="col-md-6 mb-4">
                        <div class="section-card">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_ekstrakurikuler }}" class="img-fluid rounded" style="height: 150px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center" style="height: 150px; background: linear-gradient(135deg, var(--warning-color), var(--info-color)); border-radius: 10px;">
                                            <i class="fas fa-trophy fa-3x text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4 class="text-primary">{{ $item->nama_ekstrakurikuler }}</h4>
                                    @if($item->pembimbing)
                                        <p><strong>Pembimbing:</strong> {{ $item->pembimbing }}</p>
                                    @endif
                                    @if($item->jadwal)
                                        <p><strong>Jadwal:</strong> {{ $item->jadwal }}</p>
                                    @endif
                                    @if($item->tempat)
                                        <p><strong>Tempat:</strong> {{ $item->tempat }}</p>
                                    @endif
                                    @if($item->deskripsi)
                                        <p>{{ Str::limit($item->deskripsi, 150) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $ekstrakurikuler->links() }}
                </div>
            @else
                <div class="section-card text-center">
                    <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                    <h4>Belum ada kegiatan ekstrakurikuler</h4>
                    <p class="text-muted">Kegiatan ekstrakurikuler akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

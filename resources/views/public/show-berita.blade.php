@extends('layouts.public')

@section('title', $berita->judul . ' - Website Sekolah')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <!-- Judul Berita -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark" style="font-size: 1.75rem;">
                {{ $berita->judul }}
            </h2>
            <div class="d-flex justify-content-center align-items-center text-muted small mt-2">
                <i class="fas fa-user me-1"></i> {{ $berita->user->username }}
                <span class="mx-2">|</span>
                <i class="fas fa-calendar me-1"></i> {{ $berita->created_at->format('d F Y') }}
            </div>
            <hr class="mx-auto mt-3" 
                style="width: 80px; height: 3px; background-color: #0d6efd; opacity: 1; border: none; border-radius: 2px;">
        </div>

        <!-- Gambar Utama -->
        @if($berita->gambar)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                     alt="{{ $berita->judul }}" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 400px; object-fit: cover;">
            </div>
        @endif

        <!-- Isi Berita -->
        <div class="mb-4" style="line-height: 1.7; font-size: 1rem; color: #333;">
            {!! nl2br(e($berita->isi)) !!}
        </div>

        <hr>

        <!-- Info Penulis -->
        <div class="row text-muted small">
            <div class="col-md-6 mb-2">
                <strong><i class="fas fa-user me-2"></i>Penulis:</strong> {{ $berita->user->username }}
            </div>
            <div class="col-md-6 mb-2">
                <strong><i class="fas fa-calendar me-2"></i>Tanggal:</strong> {{ $berita->created_at->format('d F Y H:i') }}
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="{{ route('public.berita') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Berita
            </a>
        </div>
    </div>
</div>
@endsection

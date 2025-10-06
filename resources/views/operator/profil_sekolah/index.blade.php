@extends('layouts.operator')

@section('title', 'Kelola Data Profil Sekolah')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Profil Sekolah</h5>
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ route('operator.profil_sekolah.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari nama sekolah, kepala sekolah, atau NPSN...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </div>
                </form>
                <a href="{{ route('operator.profil_sekolah.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Profil Sekolah
                </a>
            </div>
        </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="profil-sekolah-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Logo</th>
                                    <th>Nama Sekolah</th>
                                    <th>Kepala Sekolah</th>
                                    <th>NPSN</th>
                                    <th>Kontak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($profils as $index => $profil)
                                    <tr>
                                        <td>{{ $profils->firstItem() + $index }}</td>
                                        <td>
                                            @if($profil->logo)
                                                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" class="img-fluid rounded" style="max-width: 60px; max-height: 60px;">
                                            @else
                                                <span class="text-muted">Tidak ada logo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $profil->nama_sekolah }}</strong>
                                        </td>
                                        <td>{{ $profil->kepala_sekolah }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $profil->npsn }}</span>
                                        </td>
                                        <td>{{ $profil->kontak }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('operator.profil_sekolah.edit', $profil->id_profil) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                                <form action="{{ route('operator.profil_sekolah.destroy', $profil->id_profil) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil sekolah ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="py-4">
                                                <i class="bi bi-building fs-1 text-muted"></i>
                                                <p class="text-muted mt-2">Belum ada data profil sekolah</p>
                                                <a href="{{ route('operator.profil_sekolah.create') }}" class="btn btn-primary">
                                                    <i class="bi bi-plus-circle me-2"></i>Tambah Profil Sekolah Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

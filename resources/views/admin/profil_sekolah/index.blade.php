@extends('layouts.admin')

@section('title', 'Data Profil Sekolah')

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
                <form method="GET" action="{{ route('admin.profil_sekolah.index') }}" class="d-flex me-2">
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
                <a href="{{ route('admin.profil_sekolah.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Profil Sekolah
                </a>
            </div>
        </div>
        <div class="card-body">
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
                        @foreach($profils as $index => $profil)
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
                                    <a href="{{ route('admin.profil_sekolah.edit', $profil->id_profil) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.profil_sekolah.destroy', $profil->id_profil) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus profil sekolah ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

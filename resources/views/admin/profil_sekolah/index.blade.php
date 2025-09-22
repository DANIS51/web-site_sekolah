@extends('layouts.admin')

@section('title', 'Data Profil Sekolah')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h5 class="card-title mb-0">Data Profil Sekolah</h5>
            <a href="{{ route('admin.profil_sekolah.create') }}" class="btn btn-primary btn-sm mt-2 mt-md-0">
                <i class="bi bi-plus me-1"></i> Tambah Profil Sekolah
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" action="{{ route('admin.profil_sekolah.index') }}" class="d-flex justify-content-end">
                        <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">Cari:</span>
                            <input type="text" class="form-control" name="search" value="{{ $search }}"
                                placeholder="Cari nama sekolah, kepala sekolah, atau NPSN...">
                            <button type="submit" class="btn btn-outline-secondary">Cari</button>
                        </div>
                    </form>
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
                                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah" width="50" height="50"
                                            class="rounded">
                                    @else
                                        <span class="text-muted">Tidak Ada Logo</span>
                                    @endif
                                </td>
                                <td>{{ $profil->nama_sekolah }}</td>
                                <td>{{ $profil->kepala_sekolah }}</td>
                                <td>{{ $profil->npsn }}</td>
                                <td>{{ $profil->kontak }}</td>
                                <td>
                                    <a href="{{ route('admin.profil_sekolah.edit', $profil->id_profil) }}" class="btn btn-warning btn-sm"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.profil_sekolah.destroy', $profil->id_profil) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-info-circle fs-4 mb-2"></i>
                                        <p>Tidak ada data profil sekolah ditemukan.</p>
                                        <a href="{{ route('admin.profil_sekolah.create') }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus"></i> Tambah Profil Sekolah Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($profils->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                    <div>Menampilkan {{ $profils->firstItem() }} sampai {{ $profils->lastItem() }} dari {{ $profils->total() }} entri</div>
                    {{ $profils->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Data Berita')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h5 class="card-title mb-0">Data Berita</h5>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm mt-2 mt-md-0">
            <i class="fas fa-plus me-1"></i> Tambah Berita
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <form method="GET" action="{{ route('admin.berita') }}" class="d-flex align-items-center flex-wrap">
                    
                    @if($search)
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif
                </form>
            </div>
            <div class="col-12 col-md-6">
                <form method="GET" action="{{ route('admin.berita') }}" class="d-flex justify-content-end">
                    <div class="input-group input-group-sm w-auto">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari...">
                        <button type="submit" class="btn btn-outline-secondary">Cari</button>
                    </div>
                    @if(request('per_page'))
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                    @endif
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="berita-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Id_user</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $index => $berita)
                        <tr>
                            <td>{{ $beritas->firstItem() + $index }}</td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->tanggal }}</td>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="100" height="60" class="img-thumbnail">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>{{ $berita->user ? $berita->user->username : 'Unknown' }}</td>
                            <td>{{ $berita->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.berita.edit', $berita->id_berita) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
            <div>Menampilkan {{ $beritas->firstItem() }} sampai {{ $beritas->lastItem() }} dari {{ $beritas->total() }} entri</div>
            {{ $beritas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

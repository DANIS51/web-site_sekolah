@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Siswa</h5>
            <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Siswa
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="search col-12">
                    <form method="GET" action="{{ route('admin.siswa.index') }}" class="d-flex justify-content-end">
                        <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">Cari:</span>
                            <input type="text" class="form-control" name="search" value="{{ $search }}"
                                placeholder="Cari...">
                            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="siswa-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tahun Masuk</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $item)
                            <tr>
                                <td>{{ $siswa->firstItem() + $index }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama_siswa }}</td>
                                <td>
                                    @if($item->jenis_kelamin == 'Laki-laki')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge bg-danger">Perempuan</span>
                                    @endif
                                </td>
                                <td>{{ $item->tahun_masuk }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Siswa" class="img-fluid rounded" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.siswa.edit', Crypt::encrypt($item->id_siswa)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', Crypt::encrypt($item->id_siswa)) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
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

 
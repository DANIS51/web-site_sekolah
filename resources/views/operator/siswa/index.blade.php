@extends('layouts.operator')

@section('title', 'Kelola Data Siswa')

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
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ route('operator.siswa.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari siswa...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a href="{{ route('operator.siswa.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Siswa
                </a>
            </div>
        </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="siswa-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Tahun Masuk</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>
                                            @if($item->jenis_kelamin == 'Laki-laki')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @else
                                                <span class="badge bg-danger">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>{{$item->alamat}}</td>
                                        <td>{{ $item->tahun_masuk }}</td>
                                        <td>
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Siswa" class="img-fluid rounded" style="max-width: 50px; max-height: 50px;">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group " role="group">
                                                <a href="{{ route('operator.siswa.edit', Crypt::encrypt($item->id_siswa)) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                                </a>
                                                <form action="{{ route('operator.siswa.destroy', Crypt::encrypt($item->id_siswa)) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
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
                                        <td colspan="7" class="text-center">Belum ada data siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

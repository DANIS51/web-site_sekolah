@extends('layouts.admin')

@section('title', 'Kelola Data Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kelola Data Siswa</h2>
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>Tambah Siswa Baru
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('admin.siswa.index') }}" class="d-flex justify-content-end">
                                <div class="input-group input-group-sm w-auto">
                                    <span class="input-group-text">Cari:</span>
                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Cari...">
                                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="min-width: 600px;">
                            <thead class="table-dark">
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
                                @forelse($siswa as $index => $item)
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
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Hapus
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

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div>Menampilkan {{ $siswa->firstItem() }} sampai {{ $siswa->lastItem() }} dari {{ $siswa->total() }} entri</div>
                        {{ $siswa->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 
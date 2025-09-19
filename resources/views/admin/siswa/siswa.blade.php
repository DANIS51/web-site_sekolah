@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data Siswa</h5>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Siswa
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <span class="me-2">Show</span>
                    <select class="form-select form-select-sm w-auto" id="entries-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <div class="input-group input-group-sm w-auto">
                        <span class="input-group-text">Search:</span>
                        <input type="text" class="form-control" id="search-input" placeholder="Cari...">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="siswa-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISM</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nism }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tahun_masuk }}</td>
                        <td>
                            <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline">
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

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>Showing 1 to {{ $siswa->count() }} of {{ $siswa->count() }} entries</div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    <li class="page-item active"><span class="page-link">1</span></li>
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

 
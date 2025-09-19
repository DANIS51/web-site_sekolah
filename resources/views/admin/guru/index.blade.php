@extends('layouts.admin')

@section('title', 'Data Guru')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h5 class="card-title mb-0">Data Guru</h5>
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary btn-sm mt-2 mt-md-0">
                <i class="fas fa-plus me-1"></i> Tambah Guru
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <form method="GET" action="{{ route('admin.guru') }}" class="d-flex align-items-center flex-wrap">
                        <span class="me-2">Show</span>
                        <select class="form-select form-select-sm w-auto" name="per_page" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="ms-2">entries</span>
                        @if($search)
                            <input type="hidden" name="search" value="{{ $search }}">
                        @endif
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <form method="GET" action="{{ route('admin.guru') }}" class="d-flex justify-content-end">
                        <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">Search:</span>
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
                <table class="table table-bordered table-striped" id="guru-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mapel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gurus as $index => $guru)
                            <tr>
                                <td>{{ $gurus->firstItem() + $index }}</td>
                                <td>
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="50" height="50"
                                            class="rounded">
                                    @else
                                        <span class="text-muted">No Photo</span>
                                    @endif
                                </td>
                                <td>{{ $guru->nama }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td>{{ $guru->mapel }}</td>
                                <td>
                                    <a href="{{ route('admin.guru.edit', $guru->id_guru) }}" class="btn btn-warning btn-sm"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                <div>Showing {{ $gurus->firstItem() }} to {{ $gurus->lastItem() }} of {{ $gurus->total() }} entries</div>
                {{ $gurus->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

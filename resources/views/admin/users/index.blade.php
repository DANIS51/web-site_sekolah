@extends('layouts.admin')

@section('title', 'Data User')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data User</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah User
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
            <table class="table table-bordered table-striped" id="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id_user) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.delete', $user->id_user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>Showing 1 to {{ $users->count() }} of {{ $users->count() }} entries</div>
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

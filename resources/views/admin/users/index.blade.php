{{-- Perluas template layout admin --}}
@extends('layouts.admin')

{{-- Atur judul halaman untuk data user --}}
@section('title', 'Data User')

{{-- Bagian konten utama halaman --}}
@section('content')
    {{-- Card untuk menampilkan data user --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data User</h5>
            <div class="d-flex align-items-center">
                {{-- Form untuk pencarian user --}}
                <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex me-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Cari:</span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            placeholder="Cari...">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                {{-- Tombol untuk menambah user baru --}}
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Tabel untuk menampilkan daftar user --}}
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
                        {{-- Loop untuk menampilkan setiap data user --}}
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    {{-- Tombol untuk edit user --}}
                                    <a href="{{ route('admin.users.edit', Crypt::encrypt($user->id_user)) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Form untuk menghapus user --}}
                                    <form action="{{ route('admin.users.destroy', Crypt::encrypt($user->id_user)) }}"
                                        method="POST" class="d-inline">
                                        {{-- Token CSRF untuk keamanan --}}
                                        @csrf
                                        {{-- Method untuk delete --}}
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
        </div>
    </div>
@endsection

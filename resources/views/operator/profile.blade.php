@extends('layouts.operator')

@section('title', 'Profile Operator')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Profile Operator</h2>
                <div>
                    <a href="{{ route('operator.profile.password') }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-key me-1"></i> Ubah Password
                    </a>
                </div>
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
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Profile</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('operator.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Dibuat</label>
                            <input type="text" class="form-control" value="{{ $user->created_at->format('d F Y H:i') }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Terakhir Diperbarui</label>
                            <input type="text" class="form-control" value="{{ $user->updated_at->format('d F Y H:i') }}" readonly>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-circle text-white fs-1"></i>
                        </div>
                        <h5 class="mt-3">{{ $user->name }}</h5>
                        <p class="text-muted">{{ ucfirst($user->role) }}</p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>

                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-success">Aktif</span>
                    </div>

                    <div class="mb-3">
                        <strong>Member sejak:</strong><br>
                        <span class="text-muted">{{ $user->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('operator.profile.password') }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-key me-2"></i> Ubah Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

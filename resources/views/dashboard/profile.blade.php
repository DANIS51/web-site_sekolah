@extends('layouts.operator')
@section('title', 'Edit Profil')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Profil</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="img-thumbnail mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="width: 200px; height: 200px;">
                                            <i class="bi bi-person-circle" style="font-size: 100px; color: #6c757d;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3 row align-items-center">
                                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="role" class="col-sm-4 col-form-label">Role</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="role" name="role" value="{{ ucfirst($user->role) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="old_password" class="col-sm-4 col-form-label">Password Lama</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="old_password" name="old_password">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="new_password" class="col-sm-4 col-form-label">Password Baru</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="confirm_password" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="mb-3 row align-items-center">
                                        <label for="foto" class="col-sm-4 col-form-label">Ganti Foto Profil</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="offset-sm-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

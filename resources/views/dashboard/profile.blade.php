 @extends('layouts.admin')
@section('title', 'Edit Profile')

@section('content')
   

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Profile</h5>
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

                        <form method="POST" action="{{ route('admin.profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username', $user->username) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Username</button>
                        </form>

                        <hr>

                        <h5>Ubah Password</h5>
                        <form method="POST" action="{{ route('admin.profile.password') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Minimal 6 karakter</div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>

                        <hr>

                        <div class="mt-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                        </div>

                        <hr>

                        <h6>Informasi Akun:</h6>
                        <ul>
                            <li>Role: <strong>{{ $user->role }}</strong></li>
                            <li>Terdaftar sejak: {{ $user->created_at->format('d M Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
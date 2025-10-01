@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit User</h5>
    </div>
    <div class="card-body">
<form action="{{ route('admin.users.update', Crypt::encrypt($user->id_user)) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>Operator</option>

                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

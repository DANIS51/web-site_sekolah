<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Sekolah</title>
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #2c3e50;
      /* Elegant dark blue-gray */
      --secondary-color: #7f8c8d;
      /* Muted gray */
      --success-color: #27ae60;
      /* Soft green */
      --info-color: #3498db;
      /* Light blue */
      --warning-color: #f39c12;
      /* Warm orange */
      --light-bg: #ecf0f1;
      /* Light gray background */
      --dark-text: #2c3e50;
      /* Dark text */
      --accent-color: #e74c3c;
      /* Red accent for highlights */
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="card login-card">
      <div class="card-header text-center">
        <div class="logo mb-2">
          <img src="{{ asset('storage/smp.png') }}" alt="Logo Sekolah" style="height: 60px; width: auto;">
        </div>
        <h4>Login Sistem Sekolah</h4>
      </div>
      <div class="card-body">

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
          @csrf

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username') }}" required>
            </div>
            @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>

          <div class="text-center mt-3">
            <a href="{{ route('public.index') }}" class="text-secondary">← Kembali ke Beranda</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
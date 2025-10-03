<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Sekolah</title>

  <!-- Bootstrap -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #0f172a, #1e293b);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
      --secondary-color: #475569;
      --light-bg: rgba(255, 255, 255, 0.08);
      --accent-color: #f59e0b; /* warna kuning */
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 15px;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: #f8fafc;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .card-header {
      background: transparent;
      border-bottom: none;
    }

    .card-header h4 {
      font-weight: 600;
      color: #f8fafc;
    }

    .form-label {
      font-weight: 500;
      color: #f1f5f9;
    }

    .input-group-text {
      background: transparent;
      color: var(--accent-color); /* ikon sama warna dengan SMA 2 Tasikmalaya */
      border: none;
      font-size: 1.1rem;
    }

    .form-control {
      border: none;
      border-radius: 0.5rem;
      background: rgba(255, 255, 255, 0.1);
      color: #f8fafc;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      outline: none !important;
      box-shadow: none !important;
    }

    .btn-primary {
      background: var(--accent-color);
      border: none;
      padding: 0.75rem;
      font-weight: 600;
      border-radius: 0.75rem;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background: #d97706;
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    }

    .text-secondary {
      color: #cbd5e1 !important;
      font-size: 0.9rem;
    }

    .text-secondary:hover {
      color: var(--accent-color) !important;
    }

    .alert {
      border-radius: 0.75rem;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="login-wrapper" data-aos="zoom-in" data-aos-duration="800">
    <div class="card login-card p-4">
      <div class="card-header text-center">
        <div class="logo mb-3">
          <img src="{{ asset('storage/logo-sekolah/sma2.png') }}" alt="Logo Sekolah"
            style="height: 70px; width: auto;">
        </div>
        <h4>Login Sistem <br> <span class="text-warning">SMA 2 Tasikmalaya</span></h4>
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

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
          </div>

          <div class="text-center mt-3">
            <a href="{{ route('public.index') }}" class="text-secondary">← Kembali ke Beranda</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>

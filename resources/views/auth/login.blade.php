<!-- DOCTYPE dan tag html untuk halaman login -->
<!DOCTYPE html>
<html lang="id">

<!-- Bagian head -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Sekolah</title>

  <!-- Bootstrap CSS -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    /* Gaya untuk body halaman login */
    body {
      background: linear-gradient(135deg, #0f172a, #1e293b);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Variabel root untuk tema */
    :root {
      --secondary-color: #475569;
      --light-bg: rgba(255, 255, 255, 0.08);
      --accent-color: #1B0BF5FF; /* warna kuning */
    }

    /* Wrapper untuk login */
    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 15px;
    }

    /* Card untuk form login */
    .login-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: #f8fafc;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Header card */
    .card-header {
      background: transparent;
      border-bottom: none;
    }

    /* Judul di header card */
    .card-header h4 {
      font-weight: 600;
      color: #f8fafc;
    }

    /* Label form */
    .form-label {
      font-weight: 500;
      color: #f1f5f9;
    }

    /* Teks input group */
    .input-group-text {
      background: transparent;
      color: var(--accent-color); /* ikon sama warna dengan SMA 2 Tasikmalaya */
      border: none;
      font-size: 1.1rem;
    }
    /* Icon mata agar background sama dengan input */
    .input-group .form-control + .input-group-text {
      background: rgba(255, 255, 255, 0.1);
      color: #0400FFFF;
      border-radius: 0 0.5rem 0.5rem 0;
      border: none;
      transition: background 0.2s;
    }
    .input-group .form-control:focus + .input-group-text {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    /* Kontrol form */
    .form-control {
      border: none;
      border-radius: 0.5rem;
      background: rgba(255, 255, 255, 0.1);
      color: #f8fafc;
    }

    /* Focus untuk form control */
    .form-control:focus {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      outline: none !important;
      box-shadow: none !important;
    }

    /* Tombol primary */
    .btn-primary {
      background: var(--accent-color);
      border: none;
      padding: 0.75rem;
      font-weight: 600;
      border-radius: 0.75rem;
      transition: 0.3s;
    }

    /* Hover untuk tombol primary */
    .btn-primary:hover {
      background: #00FF15FF;
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    }

    /* Teks secondary */
    .text-secondary {
      color: #cbd5e1 !important;
      font-size: 0.9rem;
    }

    /* Hover untuk teks secondary */
    .text-secondary:hover {
      color: var(--accent-color) !important;
    }

    /* Alert */
    .alert {
      border-radius: 0.75rem;
      font-size: 0.9rem;
    }
  </style>
</head>

<!-- Bagian body -->
<body>
  <!-- Wrapper login -->
  <div class="login-wrapper" data-aos="zoom-in" data-aos-duration="800">
    <div class="card login-card p-4">
      <div class="card-header text-center">
        <div class="logo mb-3">
          <img src="{{ asset('storage/smk.gif') }}" alt="Logo Sekolah"
            style="height: 70px; width: auto;">
        </div>

       </div>
      <div class="card-body">

        {{-- Periksa apakah ada error validasi --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              {{-- Loop untuk menampilkan setiap error --}}
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Periksa session success --}}
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <!-- Form untuk login -->
        <form method="POST" action="{{ route('login.post') }}">
          {{-- Token CSRF untuk keamanan --}}
          @csrf

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username') }}" required>
            </div>
            {{-- Tampilkan error untuk username --}}
            @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="password" name="password" required>
              <span class="input-group-text" id="toggle-password" style="cursor:pointer;">
                <i class="bi bi-eye-slash" id="icon-eye"></i>
              </span>
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

  <!-- Script JS -->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Inisialisasi library AOS untuk animasi
    AOS.init();
    // Toggle show/hide password
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const togglePassword = document.getElementById('toggle-password');
      const iconEye = document.getElementById('icon-eye');
      togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          iconEye.classList.remove('bi-eye-slash');
          iconEye.classList.add('bi-eye');
        } else {
          passwordInput.type = 'password';
          iconEye.classList.remove('bi-eye');
          iconEye.classList.add('bi-eye-slash');
        }
      });
    });
  </script>
</body>

</html>

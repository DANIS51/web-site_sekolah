<?php

// Import statements untuk controller dan facade yang digunakan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Routes Autentikasi
|--------------------------------------------------------------------------
| Bagian ini mengatur route untuk proses login pengguna yang belum terautentikasi.
*/
Route::middleware('guest')->group(function () {
    // Menampilkan form login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Memproses data login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Routes untuk Pengguna yang Sudah Login
|--------------------------------------------------------------------------
| Bagian ini mengatur route yang hanya dapat diakses oleh pengguna yang sudah terautentikasi.
*/
Route::middleware('auth')->group(function () {

    // Route untuk logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Routes Admin
    |--------------------------------------------------------------------------
    | Bagian ini mengatur route khusus untuk pengguna dengan role admin.
    */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profil admin
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [DashboardController::class, 'editPassword'])->name('profile.password');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Users
        |--------------------------------------------------------------------------
        | Routes untuk mengelola data pengguna (users).
        */
        Route::get('/users', [UserController::class, 'users'])->name('users');
        Route::get('/users/create', [UserController::class, 'createUser'])->name('users.create');
        Route::post('/users', [UserController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Siswa
        |--------------------------------------------------------------------------
        | Routes untuk mengelola data siswa.
        */
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Guru
        |--------------------------------------------------------------------------
        | Routes untuk mengelola data guru.
        */
        Route::get('/guru', [GuruController::class, 'guru'])->name('guru');
        Route::get('/guru/create', [GuruController::class, 'createGuru'])->name('guru.create');
        Route::post('/guru', [GuruController::class,'storeGuru'])->name('guru.store');
        Route::get('/guru/{id}/edit', [GuruController::class, 'editGuru'])->name('guru.edit');
        Route::put('/guru/{id}', [GuruController::class, 'updateGuru'])->name('guru.update');
        Route::delete('/guru/{id}', [GuruController::class, 'destroyGuru'])->name('guru.destroy');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Berita
        |--------------------------------------------------------------------------
        | Routes untuk mengelola berita sekolah.
        */
        Route::get('/berita', [BeritaController::class, 'berita'])->name('berita');
        Route::get('/berita/create', [BeritaController::class, 'createBerita'])->name('berita.create');
        Route::post('/berita', [BeritaController::class, 'storeBerita'])->name('berita.store');
        Route::get('/berita/{id}/edit', [BeritaController::class, 'editBerita'])->name('berita.edit');
        Route::put('/berita/{id}', [BeritaController::class, 'updateBerita'])->name('berita.update');
        Route::delete('/berita/{id}', [BeritaController::class, 'destroyBerita'])->name('berita.destroy');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Galeri
        |--------------------------------------------------------------------------
        | Routes untuk mengelola galeri sekolah.
        */
        Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
        Route::get('/galeri/create', [GaleriController::class, 'createGaleri'])->name('galeri.create');
        Route::post('/galeri', [GaleriController::class, 'storeGaleri'])->name('galeri.store');
        Route::get('/galeri/{id}/edit', [GaleriController::class, 'editGaleri'])->name('galeri.edit');
        Route::put('/galeri/{id}', [GaleriController::class, 'updateGaleri'])->name('galeri.update');
        Route::delete('/galeri/{id}', [GaleriController::class, 'destroyGaleri'])->name('galeri.destroy');

        /*
        |--------------------------------------------------------------------------
        | Manajemen Ekstrakurikuler
        |--------------------------------------------------------------------------
        | Routes untuk mengelola ekstrakurikuler.
        */
        Route::get('/ekstrakurikulera', [EkstrakurikulerController::class, 'ekstrakurikulera'])->name('ekstrakurikulera');
        Route::get('/ekstrakurikulera/create', [EkstrakurikulerController::class, 'createEkstrakurikulera'])->name('ekstrakurikulera.create');
        Route::post('/ekstrakurikulera', [EkstrakurikulerController::class, 'StoreEskul'])->name('ekstrakurikulera.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes Operator
    |--------------------------------------------------------------------------
    | Bagian ini mengatur route khusus untuk pengguna dengan role operator.
    */
    Route::middleware('operator')->prefix('operator')->name('operator.')->group(function () {
        // Dashboard operator
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});



/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
| Mengarahkan akses root '/' ke halaman dashboard sesuai role pengguna.
*/
Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if (strtolower($user->role) == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (strtolower($user->role) == 'operator') {
            return redirect()->route('operator.dashboard');
        } else {
            abort(403, 'Unauthorized');
        }
    })->name('dashboard');
});

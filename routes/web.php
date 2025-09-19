<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController as OperatorDashboardController;
use App\Http\Controllers\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use Illuminate\Support\Facades\Auth;

// ==========================
// AUTHENTICATION ROUTES
// ==========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ==========================
// LOGGED IN ROUTES
// ==========================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // General User Dashboard & Profile
   
    // ==========================
    // ADMIN ROUTES
    // ==========================
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [UserDashboardController::class, 'editPassword'])->name('profile.password');

        // Manajemen Users
        Route::get('/users', [UserController::class, 'users'])->name('users');
        Route::get('/users/create', [UserController::class, 'createUser'])->name('users.create');
        Route::post('/users', [UserController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');

        // Manajemen Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Placeholder routes for other sections
        Route::get('/guru', [GuruController::class, 'guru'])->name('guru');
        Route::get('/berita', [BeritaController::class, 'berita'])->name('berita');
        Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
        Route::get('/galeri/create', [GaleriController::class, 'createGaleri'])->name('galeri.create');
        Route::post('/galeri', [GaleriController::class, 'storeGaleri'])->name('galeri.store');
        Route::get('/ekstrakurikulera', [EkstrakurikulerController::class, 'ekstrakurikulera'])->name('ekstrakurikulera');
    });

    // ==========================
    // OPERATOR ROUTES
    // ==========================
    Route::middleware('operator')->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');
    });
});



// ==========================
// REDIRECT ROOT
// ==========================
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

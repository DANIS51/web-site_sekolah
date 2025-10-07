<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\EkstrakurikulerPublicController;

use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile admin
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [DashboardController::class, 'editPassword'])->name('profile.password');

        // Users
        Route::get('users', [UserController::class, 'users'])->name('users.index');
        Route::get('users/create', [UserController::class, 'createUser'])->name('users.create');
        Route::post('users', [UserController::class, 'storeUser'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'editUser'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'updateUser'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'deleteUser'])->name('users.destroy');

        // Siswa
        Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Guru
        Route::get('/guru', [GuruController::class, 'guru'])->name('guru.index');
        Route::get('/guru/create', [GuruController::class, 'createGuru'])->name('guru.create');
        Route::post('/guru', [GuruController::class,'storeGuru'])->name('guru.store');
        Route::get('/guru/{id}/edit', [GuruController::class, 'editGuru'])->name('guru.edit');
        Route::put('/guru/{id}', [GuruController::class, 'updateGuru'])->name('guru.update');
        Route::delete('/guru/{id}', [GuruController::class, 'destroyGuru'])->name('guru.destroy');

        // Berita
        Route::get('berita', [BeritaController::class, 'berita'])->name('berita.index');
        Route::get('berita/create', [BeritaController::class, 'createBerita'])->name('berita.create');
        Route::post('berita', [BeritaController::class, 'storeBerita'])->name('berita.store');
        Route::get('berita/{berita}/edit', [BeritaController::class, 'editBerita'])->name('berita.edit');
        Route::put('berita/{berita}', [BeritaController::class, 'updateBerita'])->name('berita.update');
        Route::delete('berita/{berita}', [BeritaController::class, 'destroyBerita'])->name('berita.destroy');

        // Galeri
        Route::get('galeri', [GaleriController::class, 'galeri'])->name('galeri.index');
        Route::get('galeri/create', [GaleriController::class, 'createGaleri'])->name('galeri.create');
        Route::post('galeri', [GaleriController::class, 'storeGaleri'])->name('galeri.store');
        Route::get('galeri/{galeri}/edit', [GaleriController::class, 'editGaleri'])->name('galeri.edit');
        Route::put('galeri/{galeri}', [GaleriController::class, 'updateGaleri'])->name('galeri.update');
        Route::delete('galeri/{galeri}', [GaleriController::class, 'destroyGaleri'])->name('galeri.destroy');

        // Ekstrakurikuler
        Route::get('ekstrakurikuler', [EkstrakurikulerController::class, 'ekstrakurikuler'])->name('ekstrakurikuler.index');
        Route::get('ekstrakurikuler/create', [EkstrakurikulerController::class, 'createEkstrakurikuler'])->name('ekstrakurikuler.create');
        Route::post('ekstrakurikuler', [EkstrakurikulerController::class, 'storeEkstrakurikuler'])->name('ekstrakurikuler.store');
        Route::get('ekstrakurikuler/{ekstrakurikuler}/edit', [EkstrakurikulerController::class, 'editEkstrakurikuler'])->name('ekstrakurikuler.edit');
        Route::put('ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'updateEkstrakurikuler'])->name('ekstrakurikuler.update');
        Route::delete('ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroyEkstrakurikuler'])->name('ekstrakurikuler.destroy');

        // Profil Sekolah
        Route::get('profil_sekolah', [ProfilSekolahController::class, 'index'])->name('profil_sekolah.index');
        Route::get('profil_sekolah/create', [ProfilSekolahController::class, 'create'])->name('profil_sekolah.create');
        Route::post('profil_sekolah', [ProfilSekolahController::class, 'store'])->name('profil_sekolah.store');
        Route::get('profil_sekolah/{profil_sekolah}/edit', [ProfilSekolahController::class, 'edit'])->name('profil_sekolah.edit');
        Route::put('profil_sekolah/{profil_sekolah}', [ProfilSekolahController::class, 'update'])->name('profil_sekolah.update');
        Route::delete('profil_sekolah/{profil_sekolah}', [ProfilSekolahController::class, 'destroy'])->name('profil_sekolah.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Operator Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('operator')->prefix('operator')->name('operator.')->group(function () {
        // Profile operator
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/password', [DashboardController::class, 'editPassword'])->name('profile.password');
        Route::put('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password.update');

        // Siswa
        Route::get('siswa', [App\Http\Controllers\Operator\SiswaController::class, 'index'])->name('siswa.index');
        Route::get('siswa/create', [App\Http\Controllers\Operator\SiswaController::class, 'create'])->name('siswa.create');
        Route::post('siswa', [App\Http\Controllers\Operator\SiswaController::class, 'store'])->name('siswa.store');
        Route::get('siswa/{siswa}', [App\Http\Controllers\Operator\SiswaController::class, 'show'])->name('siswa.show');
        Route::get('siswa/{siswa}/edit', [App\Http\Controllers\Operator\SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('siswa/{siswa}', [App\Http\Controllers\Operator\SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('siswa/{siswa}', [App\Http\Controllers\Operator\SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Berita
        Route::get('berita', [App\Http\Controllers\Operator\BeritaController::class, 'index'])->name('berita.index');
        Route::get('berita/create', [App\Http\Controllers\Operator\BeritaController::class, 'create'])->name('berita.create');
        Route::post('berita', [App\Http\Controllers\Operator\BeritaController::class, 'store'])->name('berita.store');
        Route::get('berita/{berita}/edit', [App\Http\Controllers\Operator\BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('berita/{berita}', [App\Http\Controllers\Operator\BeritaController::class, 'update'])->name('berita.update');
        Route::delete('berita/{berita}', [App\Http\Controllers\Operator\BeritaController::class, 'destroy'])->name('berita.destroy');

        // Galeri
        Route::get('galeri', [App\Http\Controllers\Operator\GaleriController::class, 'index'])->name('galeri.index');
        Route::get('galeri/create', [App\Http\Controllers\Operator\GaleriController::class, 'create'])->name('galeri.create');
        Route::post('galeri', [App\Http\Controllers\Operator\GaleriController::class, 'store'])->name('galeri.store');
        Route::get('galeri/{galeri}/edit', [App\Http\Controllers\Operator\GaleriController::class, 'edit'])->name('galeri.edit');
        Route::put('galeri/{galeri}', [App\Http\Controllers\Operator\GaleriController::class, 'update'])->name('galeri.update');
        Route::delete('galeri/{galeri}', [App\Http\Controllers\Operator\GaleriController::class, 'destroy'])->name('galeri.destroy');

        // Ekstrakurikuler
        Route::get('ekstrakurikuler', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
        Route::get('ekstrakurikuler/create', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
        Route::post('ekstrakurikuler', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
        Route::get('ekstrakurikuler/{ekstrakurikuler}/edit', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
        Route::put('ekstrakurikuler/{ekstrakurikuler}', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
        Route::delete('ekstrakurikuler/{ekstrakurikuler}', [App\Http\Controllers\Operator\EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');

        // Profil Sekolah
        Route::get('profil_sekolah', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'index'])->name('profil_sekolah.index');
        Route::get('profil_sekolah/create', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'create'])->name('profil_sekolah.create');
        Route::post('profil_sekolah', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'store'])->name('profil_sekolah.store');
        Route::get('profil_sekolah/{profil_sekolah}/edit', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'edit'])->name('profil_sekolah.edit');
        Route::put('profil_sekolah/{profil_sekolah}', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'update'])->name('profil_sekolah.update');
        Route::delete('profil_sekolah/{profil_sekolah}', [App\Http\Controllers\Operator\ProfilSekolahController::class, 'destroy'])->name('profil_sekolah.destroy');
    });


 
});

    /*
|--------------------------------------------------------------------------
| Public Routes (No Login Required)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/berita', [PublicController::class, 'berita'])->name('public.berita');
Route::get('/berita/{id}', [PublicController::class, 'showBerita'])->name('public.berita.show');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri');

Route::get('/ekstra', [EkstrakurikulerPublicController::class, 'index'])->name('public.ekstrakurikuler');

Route::get('/guru', [PublicController::class, 'guru'])->name('public.guru');
Route::get('/siswa', [PublicController::class, 'siswa'])->name('public.siswa');
Route::get('/profil-sekolah', [PublicController::class, 'profilSekolah'])->name('public.profil-sekolah');

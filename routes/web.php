<?php

use Illuminate\Support\Facades\Route;

use App\Models\Jadwal;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/jadwal',[JadwalController::class, 'index'])->name('jadwal');
    Route::get('/materi',[MateriController::class, 'index'])->name('materi');
  
    Route::middleware('role:admin')->group(function () {
        //role khusus admin
        Route::resource('kelas', KelasController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('mata-pelajaran', MataPelajaranController::class);
    });
  
    Route::middleware('role:guru')->group(function () {
            // Route khusus guru
        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('nilai', NilaiController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    Route::middleware('role:siswa')->group(function () {
            // Route khusus siswa
        Route::get('/nilai',[NilaiController::class,'siswa'])->name('nilai');
    });  
});

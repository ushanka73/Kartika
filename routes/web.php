<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Models\Jadwal;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

route::get('/jadwal',[JadwalController::class, 'index'])->name('jadwal');

route::get('/materi',[MateriController::class, 'index'])->name('materi');

route::get('/nilai',[NilaiController::class,'index'])->name('nilai');

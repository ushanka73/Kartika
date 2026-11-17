<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\PengajuanMitraController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\KomplainController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::get('/password/reset', fn() => view('auth.passwords.email'))->name('password.request');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);

    // Owner Management
    Route::resource('owners', OwnerController::class)->except(['create', 'edit', 'show']);

    // Pengajuan Mitra
    Route::get('/pengajuan', [PengajuanMitraController::class, 'index'])->name('pengajuan.index');
    Route::put('/pengajuan/{id}/setujui', [PengajuanMitraController::class, 'setujui'])->name('pengajuan.setujui');
    Route::put('/pengajuan/{id}/tolak', [PengajuanMitraController::class, 'tolak'])->name('pengajuan.tolak');

    // Booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Komplain
    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::put('/komplain/{id}/selesai', [KomplainController::class, 'selesai'])->name('komplain.selesai');
});

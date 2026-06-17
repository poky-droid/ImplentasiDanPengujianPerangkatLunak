<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\PengajuanMitraController;
use App\Http\Controllers\Admin\List_BookingController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\KomplainController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\Owner\KosController as OwnerKosController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kos', [KosController::class, 'index'])->name('kos.index');
Route::get('/kos/search', [KosController::class, 'search'])->name('kos.search');
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');
// allow owners to create kos via /kos/create (used in templates)
Route::get('/kos/create', [OwnerKosController::class, 'create'])->name('kos.create')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/booking/{kos}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/pembayaran/{booking}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/chat/{kos_id}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/kirim', [ChatController::class, 'send'])->name('chat.kirim');

    // Favorit
    Route::post('/favorit/{kos_id}/toggle', [FavoritController::class, 'toggle'])->name('favorit.toggle');
    Route::get('/favorit', [FavoritController::class, 'index'])->name('favorit.index');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
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
    Route::get('/bookings', [List_BookingController::class, 'index'])->name('bookings.index');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Komplain
    Route::get('/komplain', [KomplainController::class, 'index'])->name('komplain.index');
    Route::put('/komplain/{id}/selesai', [KomplainController::class, 'selesai'])->name('komplain.selesai');

    
});

Route::middleware('auth')->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    // Owner-managed kos routes
    Route::prefix('owner')->name('owner.')->middleware('auth')->group(function () {
        Route::resource('kos', OwnerKosController::class)->except(['show']);
    });
    Route::resource('notifikasi', NotifikasiController::class);
    Route::resource('chat', ChatController::class);
});


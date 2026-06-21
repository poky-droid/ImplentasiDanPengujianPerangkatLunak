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
use App\Http\Controllers\Owner\NotificationController as OwnerNotificationController;
use App\Http\Controllers\Owner\BookingController as OwnerBookingController;
use App\Http\Controllers\Owner\PembayaranController as OwnerPembayaranController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kos', [KosController::class, 'index'])->name('kos.index');
Route::get('/kos/search', [KosController::class, 'search'])->name('kos.search');
Route::get('/kos/listing', [KosController::class, 'listing'])->name('kos.listing');
// IMPORTANT: /kos/create must come BEFORE /kos/{id} to avoid wildcard conflict
Route::get('/kos/create', [OwnerKosController::class, 'create'])->name('kos.create')->middleware(['auth','owner']);
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/booking/{kos}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/riwayat-transaksi', [BookingController::class, 'history'])->name('booking.history');
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/pembayaran/{booking}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/chat/{kos_id}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/kirim', [ChatController::class, 'send'])->name('chat.kirim');
    // Legacy/alternate route name used by views: chat.send
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

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
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard')->middleware('owner');
    // Owner-managed kos routes
    Route::prefix('owner')->name('owner.')->middleware(['auth','owner'])->group(function () {
        Route::resource('kos', OwnerKosController::class)->except(['show']);

        // Booking owner
        Route::get('/booking', [OwnerBookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/{id}', [OwnerBookingController::class, 'show'])->name('booking.show');
        Route::patch('/booking/{id}/status', [OwnerBookingController::class, 'updateStatus'])->name('booking.updateStatus');

        // Pembayaran owner
        Route::get('/pembayaran', [OwnerPembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran/{id}/konfirmasi', [OwnerPembayaranController::class, 'konfirmasiLunas'])->name('pembayaran.konfirmasi');
        Route::post('/pembayaran/{id}/tolak', [OwnerPembayaranController::class, 'tolakPembayaran'])->name('pembayaran.tolak');

        // Notifikasi Owner
        Route::get('/notifications', [OwnerNotificationController::class, 'index'])->name('notifications');
        Route::post('/notifications/read-all', [OwnerNotificationController::class, 'markAllRead'])->name('notifications.readAll');
        Route::post('/notifications/{id}/read', [OwnerNotificationController::class, 'markRead'])->name('notifications.read');

        // Owner Chat (Pesan)
        Route::get('/messages', [ChatController::class, 'ownerInbox'])->name('messages.inbox');
        Route::get('/messages/{kos_id}/{user_id}', [ChatController::class, 'ownerChat'])->name('messages.show');
        Route::post('/messages/send', [ChatController::class, 'ownerSend'])->name('messages.send');
    });
    Route::resource('notifikasi', NotifikasiController::class);
    Route::resource('chat', ChatController::class);
});


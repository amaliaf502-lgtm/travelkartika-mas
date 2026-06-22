<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPaketController;
use App\Http\Controllers\MidtransController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pakets', [PaketController::class, 'index'])->name('pakets.index');
Route::get('/pakets/{paket}', [PaketController::class, 'show'])->name('pakets.show');

// Static pages
Route::view('/syarat', 'pages.terms')->name('pages.terms');
Route::view('/kontak', 'pages.contact')->name('pages.contact');
Route::view('/cara-pendaftaran', 'pages.cara-daftar')->name('pages.cara-daftar');
Route::view('/tentang-kami', 'pages.about')->name('pages.about');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Midtrans Callback Webhook
Route::post('/midtrans/callback', [PemesananController::class, 'midtransCallback'])->name('midtrans.callback');

// Protected Routes - Jamaah
Route::middleware('auth')->group(function () {
    Route::get('/pemesanan/{paket}/create', [PemesananController::class, 'create'])->name('pemesanans.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanans.store');
    Route::get('/pemesanan-saya', [PemesananController::class, 'index'])->name('pemesanans.index');
    Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanans.show');
    Route::patch('/pemesanan/{pemesanan}/cancel', [PemesananController::class, 'cancel'])->name('pemesanans.cancel');
    Route::get('/pemesanan/{pemesanan}/info-keberangkatan', [PemesananController::class, 'departureInfo'])->name('pemesanans.departure-info');
    Route::get('/pemesanan/{pemesanan}/cetak', [PemesananController::class, 'cetakBukti'])->name('pemesanans.cetak');

    Route::post('/pemesanan/{pemesanan}/simulasi-bayar', [PemesananController::class, 'simulasiBayar'])->name('pemesanans.simulasi-bayar');
    Route::post('/pemesanan/{pemesanan}/cek-status', [PemesananController::class, 'cekStatusMidtrans'])->name('pemesanans.cek-status');
    Route::get('/pemesanan/{pemesanan}/lengkapi-data', [PemesananController::class, 'completeData'])->name('pemesanans.complete-data');
    Route::post('/pemesanan/{pemesanan}/lengkapi-data', [PemesananController::class, 'updateManifest'])->name('pemesanans.update-manifest');
});

// Admin Routes
Route::middleware('auth', 'isAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Jamaah Management
    Route::get('/jamaah', [AdminController::class, 'jamaah_index'])->name('jamaah.index');
    Route::get('/jamaah/create', [AdminController::class, 'jamaah_create'])->name('jamaah.create');
    Route::post('/jamaah', [AdminController::class, 'jamaah_store'])->name('jamaah.store');
    Route::get('/jamaah/{jamaah}', [AdminController::class, 'jamaah_show'])->name('jamaah.show');
    Route::get('/jamaah/{jamaah}/edit', [AdminController::class, 'jamaah_edit'])->name('jamaah.edit');
    Route::put('/jamaah/{jamaah}', [AdminController::class, 'jamaah_update'])->name('jamaah.update');
    Route::delete('/jamaah/{jamaah}', [AdminController::class, 'jamaah_destroy'])->name('jamaah.destroy');
    
    // Paket Management
    Route::get('/pakets', [AdminPaketController::class, 'index'])->name('pakets.index');
    Route::get('/pakets/create', [AdminPaketController::class, 'create'])->name('pakets.create');
    Route::post('/pakets', [AdminPaketController::class, 'store'])->name('pakets.store');
    Route::get('/pakets/{paket}', [AdminPaketController::class, 'show'])->name('pakets.show');
    Route::get('/pakets/{paket}/edit', [AdminPaketController::class, 'edit'])->name('pakets.edit');
    Route::put('/pakets/{paket}', [AdminPaketController::class, 'update'])->name('pakets.update');
    Route::delete('/pakets/{paket}', [AdminPaketController::class, 'destroy'])->name('pakets.destroy');
    
    // Pemesanan Management
    Route::get('/pemesanan', [AdminController::class, 'pemesanans_index'])->name('pemesanans.index');
    Route::get('/pemesanan/{pemesanan}', [AdminController::class, 'pemesanans_show'])->name('pemesanans.show');
    Route::get('/pemesanan/{pemesanan}/cetak', [AdminController::class, 'cetakKuitansi'])->name('pemesanans.cetak');
    Route::get('/pemesanan/{pemesanan}/konfirmasi', [AdminController::class, 'pemesanans_confirm'])->name('pemesanans.confirm');
    Route::post('/pemesanan/{pemesanan}/konfirmasi', [AdminController::class, 'pemesanans_confirm_store'])->name('pemesanans.confirm.store');
    Route::patch('/pemesanan/{pemesanan}/batalkan', [AdminController::class, 'pemesanans_cancel'])->name('pemesanans.cancel');
    
    // Verifikasi Pembayaran
    Route::get('/verifikasi-pembayaran', [AdminController::class, 'verifikasi_pembayaran_index'])->name('verifikasi-pembayaran');
    
    // Kelola Kuota
    Route::get('/kelola-kuota', [AdminPaketController::class, 'kuota_index'])->name('kelola-kuota');
    
    // Informasi Keberangkatan
    Route::get('/informasi-keberangkatan', [AdminController::class, 'departure_info_index'])->name('departure-info.index');
});

// Endpoint untuk Webhook / Notifikasi Otomatis dari Midtrans
Route::post('/api/midtrans/callback', [MidtransController::class, 'handleNotification'])->name('midtrans.notification');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori.home');
Route::get('/buku', [HomeController::class, 'buku'])->name('buku.home');
Route::get('/buku/{id}', [HomeController::class, 'buku_detail'])->name('buku_detail');

Route::middleware('guest')->group(function () {
    Route::get('/authentikasi', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');  
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::prefix('/dashboard')->middleware(['auth'])->group(function (){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post'); 
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/editprofil', [DashboardController::class, 'edit_profil'])->name('edit_profil');
    Route::put('/editprofil', [DashboardController::class, 'edit_profil_post'])->name('edit_profil.post');
    Route::put('/editpassword', [DashboardController::class, 'edit_password'])->name('edit_password');
    Route::post('/pinjam', [DashboardController::class, 'pinjam'])->name('transaksi_pinjam');
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');
    Route::get('/favorit', [DashboardController::class, 'favorit'])->name('favorit');
    Route::post('/favorit/{id}', [DashboardController::class, 'favorit_togle'])->name('favorit_togle');
    Route::delete('/favorit/{id}', [DashboardController::class, 'favorit_delete'])->name('favorit_delete');
    Route::get('/pengembalian', [DashboardController::class, 'pengembalian'])->name('pengembalian');
    Route::put('/pengembalian', [DashboardController::class, 'pengembalian_update'])->name('pengembalian_update');
    Route::put('/batalkan_pengajuan/{id}', [DashboardController::class, 'batalkan_pengajuan'])->name('batalkan_pengajuan');
    Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');

    Route::middleware(['role:1'])->group(function () {
        Route::put('/transaksi/editstatus/{id}/{status}', [TransaksiController::class, 'edit_status'])->name('edit_status_transaksi');
        Route::get('/aktifasi-user', [UserController::class, 'aktivasi'])->name('aktifasi');
        Route::put('/aktifasi-user/{id}', [UserController::class, 'aktifasi_toggle'])->name('aktifasi_toggle');
        Route::get('/pengembalian-transaksi', [TransaksiController::class, 'request_transaksi'])->name('transaksi.request');
        Route::get('/buku-export', [BukuController::class, 'export'])->name('buku.export');
        Route::get('/data-kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
        Route::get('/data-kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
        Route::get('/kunjungan-export', [KunjunganController::class, 'export'])->name('kunjungan.export');
        Route::get('/dashboard', [KunjunganController::class, 'grafik'])->name('kunjungan.grafik');

        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class); 
        Route::resource('buku', BukuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('transaksi', TransaksiController::class);
    });
});


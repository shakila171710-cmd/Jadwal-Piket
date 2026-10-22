<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\AuthController;

// Halaman Publik (Lihat Jadwal & Kirim Bukti)
Route::get('/', [PiketController::class, 'index'])->name('piket.index');
Route::post('/dokumentasi/upload', [PiketController::class, 'uploadDokumentasi'])->name('dokumentasi.upload');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Khusus ADMIN PPLG 2 (Wajib Login Dulu)
Route::middleware('auth')->group(function () {
    Route::get('/admin', [PiketController::class, 'admin'])->name('admin.dashboard');
    Route::post('/piket/store', [PiketController::class, 'store'])->name('piket.store');
    Route::put('/piket/{id}', [PiketController::class, 'update'])->name('piket.update');
    Route::patch('/piket/{id}/toggle', [PiketController::class, 'toggleStatus'])->name('piket.toggle');
    Route::delete('/piket/{id}', [PiketController::class, 'destroy'])->name('piket.destroy');
    Route::post('/piket/reset-mingguan', [PiketController::class, 'resetMingguan'])->name('piket.reset');
});
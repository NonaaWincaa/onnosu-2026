<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

// Route Halaman Utama Pemesanan Tiket
Route::get('/', [TiketController::class, 'index'])->name('tiket.index');
Route::post('/pesan', [TiketController::class, 'store'])->name('tiket.store');

// Route Dashboard Admin Panitia
Route::get('/admin', [TiketController::class, 'admin'])->name('admin.index');
Route::get('/admin/update/{id}/{status}', [TiketController::class, 'updateStatus'])->name('admin.update');
Route::get('/admin/export', [TiketController::class, 'exportCsv'])->name('admin.export');

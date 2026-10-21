<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

// Route Pemesanan
Route::get('/', [TiketController::class, 'index'])->name('tiket.index');
Route::post('/pesan', [TiketController::class, 'store'])->name('tiket.store');

// Route Admin (Prefix adminwincarlin)
Route::prefix('adminwincarlin')->group(function () {
    Route::get('/', [TiketController::class, 'admin'])->name('admin.index');
    Route::post('/update/{id}/{status}', [TiketController::class, 'updateStatus'])->name('admin.update');
    Route::get('/export', [TiketController::class, 'exportCsv'])->name('admin.export');
});
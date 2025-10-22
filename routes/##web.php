<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoalController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ====================== HOME ======================
// Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/', [UserController::class, 'index'])->middleware('auth')->name('home');

Route::fallback(function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// ====================== DASHBOARD ======================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


// ====================== ADMIN ======================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ----- CRUD Soal -----
        Route::get('/soal', [AdminController::class, 'soal'])->name('soal');
        Route::get('/soal/create', [AdminController::class, 'createSoal'])->name('soal.create');
        Route::post('/soal', [AdminController::class, 'storeSoal'])->name('soal.store');
        Route::get('/soal/{id}/edit', [AdminController::class, 'edit'])->name('soal.edit');
        Route::put('/soal/{id}', [AdminController::class, 'update'])->name('soal.update');
        Route::delete('/soal/{id}', [AdminController::class, 'destroySoal'])->name('soal.destroy');
        // 📌 route reset semua soal & jawaban
        Route::delete('admin/soal/reset', [AdminController::class, 'resetSoal'])->name('soal.reset');

        // Upload soal
        Route::post('/soal/upload', [AdminController::class, 'upload'])->name('soal.upload');
        Route::get('/hasil/pdf', [AdminController::class, 'exportPdf'])->name('hasil.pdf');

      
    
        // Resource route untuk soal
        Route::prefix('admin')->name('admin.')->middleware(['auth','isAdmin'])->group(function () {
        Route::resource('soal', App\Http\Controllers\SoalController::class);});
        
        // ----- Daftar Peserta -----
        Route::get('/peserta', [AdminController::class, 'peserta'])->name('peserta');

        // Ubah role user
        Route::put('users/{id}/role', [AdminController::class, 'updateRole'])->name('users.updateRole');

        // Hapus user
        Route::delete('users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

        // ----- Hasil Ujian -----
        Route::get('/hasil', [AdminController::class, 'hasil'])->name('hasil');
});
// routes/web.php
Route::get('/admin/hasil/{id}', [AdminController::class, 'hasilDetail'])
    ->name('admin.hasil.detail')
    ->middleware(['auth', 'role:admin']);


// Export hasil ujian
    Route::get('/admin/export-soal', [AdminController::class, 'exportSoalCsv'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.export.soal');

// ====================== PESERTA ======================
Route::middleware(['auth', 'role:peserta'])
    ->prefix('peserta')
    ->name('peserta.')
    ->group(function () {
        Route::get('/ujian', [PesertaController::class, 'ujian'])->name('ujian');
        Route::post('/ujian/submit', [PesertaController::class, 'submitUjian'])->name('ujian.submit');
        Route::get('/hasil', [PesertaController::class, 'hasil'])->name('hasil');
        Route::get('/peserta/hasil/pdf', [PesertaController::class, 'hasilPdf'])->name('peserta.hasil.pdf');
    });
        // route untuk export PDF
        Route::get('/peserta/hasil/pdf', [PesertaController::class, 'hasilPdf'])
        ->name('peserta.hasil.pdf');


// ====================== AUTH ======================
require __DIR__ . '/auth.php';

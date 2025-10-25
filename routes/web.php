<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHasilController;
use App\Http\Controllers\Admin\AdminPesertaController;
use App\Http\Controllers\Admin\ExamResetController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\PesertaController;
use App\Http\Controllers\Peserta\UjianController;
use App\Http\Controllers\Peserta\ProfilController;

// ==========================
// 🌐 LANDING PAGE
// ==========================
Route::get('/', fn() => view('landing'))->name('landing');


// ==========================
// 👑 ADMIN AREA
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // 🏠 Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // 👥 Manajemen User
        Route::resource('users', UserController::class)->except(['show']);
        Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
        Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

        // 👤 Manajemen Peserta
        Route::get('/peserta', [AdminPesertaController::class, 'index'])->name('peserta.index');
        Route::put('/peserta/{user}/reset-password', [AdminPesertaController::class, 'resetPassword'])->name('peserta.resetPassword');
        Route::delete('/peserta/{user}', [AdminPesertaController::class, 'destroy'])->name('peserta.destroy');

        // 🧠 Manajemen Soal
        Route::post('/soal/upload', [SoalController::class, 'upload'])->name('soal.upload');
        Route::get('/soal/export', [SoalController::class, 'export'])->name('soal.export');
        Route::delete('/soal/reset', [SoalController::class, 'reset'])->name('soal.reset');
        Route::resource('soal', SoalController::class)->except(['show']);

        // 📊 Hasil Ujian
        Route::get('/hasil', [AdminHasilController::class, 'index'])->name('hasil.index');
        Route::get('/hasil/pdf', [AdminHasilController::class, 'hasilPdf'])->name('hasil.pdf');
        Route::delete('/hasil/reset', [AdminHasilController::class, 'resetHasil'])->name('hasil.reset');

        // 🔄 Permintaan Ujian Ulang
        Route::get('/exam-reset', [ExamResetController::class, 'index'])->name('exam-reset.index');
        Route::post('/exam-reset/{id}/approve', [ExamResetController::class, 'approve'])->name('exam-reset.approve');
        Route::post('/exam-reset/{id}/reject', [ExamResetController::class, 'reject'])->name('exam-reset.reject');
    });

// ==========================
// 🧑‍🎓 PESERTA AREA
// ==========================
Route::middleware(['auth', 'role:peserta'])
    ->prefix('peserta')
    ->as('peserta.')
    ->group(function () {

        // 🏠 Dashboard Peserta
        Route::get('/', [PesertaDashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [PesertaDashboardController::class, 'index'])->name('dashboard');
        Route::post('/request-reset', [PesertaDashboardController::class, 'requestExamReset'])
            ->name('request.reset');

        // 🧩 Ujian (Peserta)
        Route::prefix('ujian')->as('ujian.')->group(function () {
            Route::get('/', [UjianController::class, 'index'])->name('index');
            Route::get('/soal-ajax', [UjianController::class, 'showAjax'])->name('soal.ajax');
            Route::post('/save', [UjianController::class, 'saveAnswer'])->name('save');
            Route::post('/submit', [UjianController::class, 'submit'])->name('submit');
            Route::get('/cek-jawaban', [UjianController::class, 'cekJawaban'])->name('cekJawaban');
        });

        // 🧾 Hasil ujian peserta
        Route::get('/hasil', [UjianController::class, 'hasil'])->name('hasil.index');

        // 🔁 Permintaan Ujian Ulang
        Route::get('/ujian-ulang', [UjianController::class, 'formUjianUlang'])->name('ujian-ulang.form');
        Route::post('/ujian-ulang/kirim', [UjianController::class, 'ajukanUjianUlang'])->name('ujian-ulang.kirim');

        // 👤 Profil Peserta
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    });


// ==========================
// 🔐 AUTH ROUTES
// ==========================
require __DIR__ . '/auth.php';


// ==========================
// 🚫 REDIRECT UNTUK GUEST
// ==========================

// Jika user belum login dan mencoba akses selain landing atau login/register,
// arahkan balik ke landing.
Route::fallback(function () {
    if (!auth()->check()) {
        return redirect()->route('landing');
    }
    abort(404); // Jika sudah login tapi route tidak ditemukan, tampilkan 404
});

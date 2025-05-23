<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogBimbinganController;
use App\Http\Controllers\PengajuanPembimbingController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DeskEvaluationController;
use App\Http\Controllers\NilaiBimbinganController;
use App\Http\Controllers\NilaiDeController;
use App\Http\Controllers\NilaiPresentasiController;
use App\Http\Controllers\NilaiLiteraturController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Public routes
Route::get('/templateTA', function () {
    return view('templateTA');
});

Route::get('/login', function () {
    return view('login');
});

// Authentication routes
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth')->name('logout');

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Mahasiswa routes
    Route::get('/pendaftaran', function () {
        return view('pendaftaran');
    });

    Route::get('/pengajuan', function () {
        return view('pengajuan');
    });

    // Log Bimbingan routes
    Route::prefix('logBimbingan')->group(function () {
        Route::get('/', [LogBimbinganController::class, 'create'])->name('log-bimbingan.create');
        Route::post('/', [LogBimbinganController::class, 'store'])->name('log-bimbingan.store');
        Route::get('/riwayat', [LogBimbinganController::class, 'index'])->name('log-bimbingan.index');
    });

    // Pengajuan Pembimbing routes
    Route::get('/pengajuanpembibing', [PengajuanPembimbingController::class, 'index'])->name('pengajuanpembimbing');
    Route::post('/pengajuanpembimbing', [PengajuanPembimbingController::class, 'store'])->name('pengajuanpembimbing.store');

    // Nilai Bimbingan routes
    Route::get('/nilaibimbingan', [NilaiBimbinganController::class, 'index'])->name('nilai-bimbingan.index');
    Route::post('/nilaibimbingan', [NilaiBimbinganController::class, 'store'])->name('nilai-bimbingan.store');

    // Nilai DE routes
    Route::get('/nilaideskevaluasi', [NilaiDeController::class, 'index'])->name('nilai-de.index');
    Route::post('/nilaideskevaluasi', [NilaiDeController::class, 'store'])->name('nilai-de.store');

    // Nilai Presentasi routes
    Route::get('/nilaipresentasiproposalta', [NilaiPresentasiController::class, 'index'])->name('nilai-presentasi.index');
    Route::post('/nilaipresentasiproposalta', [NilaiPresentasiController::class, 'store'])->name('nilai-presentasi.store');
    Route::get('/nilai-presentasi/get-dosen', [NilaiPresentasiController::class, 'getDosen'])->name('nilai-presentasi.get-dosen');

    // Other assessment routes
    Route::get('/nilailiteratur', [NilaiLiteraturController::class, 'index'])->name('nilai-literatur.index');

    // Admin routes
    Route::get('/dashboardadmin', function () {
        return view('dashboardadmin');
    });

    Route::get('/skPenguji', function () {
        return view('skPenguji');
    });

    Route::get('/skPembimbing', function () {
        return view('skPembimbing');
    });

    // Other routes
    Route::get('/pendaftaranproposal', function () {
        return view('pendaftaranproposal');
    });

    Route::get('/dlogbimbingan', function () {
        return view('dlogbimbingan');
    });

    Route::get('/dpendaftaranproposal', function () {
        return view('dpendaftaranproposal');
    });

    Route::get('/penilaiandosen', function () {
        return view('penilaiandosen');
    });

    // Desk Evaluation routes
    Route::get('/deskevaluasi', [DeskEvaluationController::class, 'index'])->name('desk-evaluation.index');
    Route::post('/desk-evaluation', [DeskEvaluationController::class, 'store'])->name('desk-evaluation.store');
    Route::get('/desk-evaluation/get-dosen', [DeskEvaluationController::class, 'getDosen'])->name('desk-evaluation.get-dosen');

    // Nilai Literatur routes
    Route::get('/nilailiteratur', [NilaiLiteraturController::class, 'index'])->name('nilai-literatur.index');
    Route::post('/nilailiteratur', [NilaiLiteraturController::class, 'store'])->name('nilai-literatur.store');
});

require __DIR__.'/auth.php';

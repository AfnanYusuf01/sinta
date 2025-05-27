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
<<<<<<< HEAD
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RekapLogBimbinganController;
use Illuminate\Support\Facades\Route;
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranProposalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NilaiController;
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)

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
<<<<<<< HEAD
        return view('pendaftaranproposal');
=======
        return view('pendaftaran');
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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

<<<<<<< HEAD
    // Admin routes
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::post('/dashboardadmin/update-status/{id}', [DashboardAdminController::class, 'updateStatus'])->name('dashboard.updateStatus');
=======
    Route::get('/pendaftaranproposal', [PendaftaranProposalController::class, 'index'])->name('pendaftaranproposal');
    Route::post('/pendaftaranproposal', [PendaftaranProposalController::class, 'store'])->name('pendaftaranproposal.store');

    // Admin routes
    Route::get('/dashboardadmin', [PengajuanPembimbingController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/pengajuan-pembimbing/approve/{id}', [PengajuanPembimbingController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan-pembimbing/reject/{id}', [PengajuanPembimbingController::class, 'reject'])->name('pengajuan.reject');

    // Pendaftaran Proposal Admin routes
    Route::get('/dpendaftaranproposal', [PendaftaranProposalController::class, 'adminIndex'])->name('admin.proposal');
    Route::post('/pendaftaran-proposal/approve/{id}', [PendaftaranProposalController::class, 'approve'])->name('proposal.approve');
    Route::post('/pendaftaran-proposal/reject/{id}', [PendaftaranProposalController::class, 'reject'])->name('proposal.reject');
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)

    Route::get('/skPenguji', function () {
        return view('skPenguji');
    });

    Route::get('/skPembimbing', function () {
        return view('skPembimbing');
    });

<<<<<<< HEAD


    Route::get('/dlogbimbingan', [RekapLogBimbinganController::class, 'index'])->name('rekap.logbimbingan');
    Route::get('/dlogbimbingan/export', [RekapLogBimbinganController::class, 'export'])->name('rekap.logbimbingan.export');

    Route::get('/dpendaftaranproposal', function () {
        return view('dpendaftaranproposal');
=======
    Route::get('/dlogbimbingan', function () {
        return view('dlogbimbingan');
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    });

    Route::get('/penilaiandosen', function () {
        return view('penilaiandosen');
    });

<<<<<<< HEAD
=======
    // Nilai routes
    Route::get('/dnilaibimprota', [NilaiController::class, 'nilaiBimbingan'])->name('nilai.bimbingan');
    Route::get('/dnilaide', [NilaiController::class, 'nilaiDe'])->name('nilai.de');
    Route::get('/dnilaipresentasita', [NilaiController::class, 'nilaiPresentasi'])->name('nilai.presentasi');
    Route::get('/dnilailiteratur', [NilaiController::class, 'nilaiLiteratur'])->name('nilai.literatur');

    // Detail nilai routes
    Route::get('/nilai-bimbingan/{id}', [NilaiController::class, 'detailNilaiBimbingan'])->name('nilai.bimbingan.detail');
    Route::get('/nilai-de/{id}', [NilaiController::class, 'detailNilaiDe'])->name('nilai.de.detail');
    Route::get('/nilai-presentasi/{id}', [NilaiController::class, 'detailNilaiPresentasi'])->name('nilai.presentasi.detail');
    Route::get('/nilai-literatur/{id}', [NilaiController::class, 'detailNilaiLiteratur'])->name('nilai.literatur.detail');

>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    // Desk Evaluation routes
    Route::get('/deskevaluasi', [DeskEvaluationController::class, 'index'])->name('desk-evaluation.index');
    Route::post('/desk-evaluation', [DeskEvaluationController::class, 'store'])->name('desk-evaluation.store');
    Route::get('/desk-evaluation/get-dosen', [DeskEvaluationController::class, 'getDosen'])->name('desk-evaluation.get-dosen');

    // Nilai Literatur routes
    Route::get('/nilailiteratur', [NilaiLiteraturController::class, 'index'])->name('nilai-literatur.index');
    Route::post('/nilailiteratur', [NilaiLiteraturController::class, 'store'])->name('nilai-literatur.store');
});

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======
require __DIR__ . '/auth.php';
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)

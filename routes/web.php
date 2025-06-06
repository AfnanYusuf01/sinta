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
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\RekapLogBimbinganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranProposalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PengujiAssignmentController;
use App\Http\Controllers\DPengujiController;

require __DIR__.'/auth.php';

// Public routes
Route::get('/', function () {
    return view('index');
});

Route::get('/templateTA', function () {
    return view('templateTA');
});

Route::get('/skPembimbing', function () {
    return view('skPembimbing');
});

// Guest routes (for non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Index route
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Default dashboard (will redirect based on role)
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboardadmin');
        } elseif ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } else {
            return redirect()->route('mahasiswa.dashboard');
        }
    })->name('dashboard');

    // Admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Dashboard and main features
        Route::get('/admin/dashboardadmin', [DashboardAdminController::class, 'index'])->name('admin.dashboardadmin');
        Route::get('/admin/logbimbingan', [AdminController::class, 'logbimbingan'])->name('admin.logbimbingan');
        Route::get('/admin/pendaftaranproposal', [AdminController::class, 'pendaftaranproposal'])->name('admin.pendaftaranproposal');

        // User Management Routes
        Route::group(['prefix' => 'admin/users'], function () {
            Route::get('/', [AdminController::class, 'users'])->name('admin.users');
            Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');
            Route::match(['put', 'patch'], '/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
            Route::delete('/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

            // Import routes
            Route::get('/import', [AdminController::class, 'importForm'])->name('admin.users.import');
            Route::post('/import', [AdminController::class, 'import']);
            Route::get('/template/mahasiswa', [AdminController::class, 'downloadTemplateMahasiswa'])->name('admin.users.template.mahasiswa');
            Route::get('/template/dosen', [AdminController::class, 'downloadTemplateDosen'])->name('admin.users.template.dosen');
        });

        // Penguji management
        Route::get('/admin/penguji', [AdminController::class, 'penguji'])->name('admin.penguji');
        Route::post('/admin/penguji', [AdminController::class, 'storePenguji'])->name('admin.penguji.store');
        Route::put('/admin/penguji/{id}', [AdminController::class, 'updatePenguji'])->name('admin.penguji.update');
        Route::delete('/admin/penguji/{id}', [AdminController::class, 'destroyPenguji'])->name('admin.penguji.destroy');

        // Nilai management
        Route::get('/admin/nilaibimprota', [AdminController::class, 'nilaibimprota'])->name('admin.nilaibimprota');
        Route::get('/admin/nilaide', [AdminController::class, 'nilaide'])->name('admin.nilaide');
        Route::get('/admin/nilaipresentasita', [AdminController::class, 'nilaipresentasita'])->name('admin.nilaipresentasita');
        Route::get('/admin/nilailiteratur', [AdminController::class, 'nilailiteratur'])->name('admin.nilailiteratur');

        // Pembimbing Management Routes
        Route::group(['prefix' => 'admin/pembimbing'], function () {
            Route::get('/', [AdminController::class, 'pembimbing'])->name('admin.pembimbing');
            Route::post('/', [AdminController::class, 'storePembimbing'])->name('admin.pembimbing.store');
            Route::put('/{pembimbing}', [AdminController::class, 'updatePembimbing'])->name('admin.pembimbing.update');
            Route::delete('/{pembimbing}', [AdminController::class, 'destroyPembimbing'])->name('admin.pembimbing.destroy');
        });

        // API endpoints for nilai details
        Route::get('/admin/nilai-bimbingan/{id}', [AdminController::class, 'detailNilaiBimbingan'])->name('admin.nilai-bimbingan.detail');
        Route::get('/admin/nilai-de/{id}', [AdminController::class, 'detailNilaiDe'])->name('admin.nilai-de.detail');
        Route::get('/admin/nilai-presentasi/{id}', [AdminController::class, 'detailNilaiPresentasi'])->name('admin.nilai-presentasi.detail');
        Route::get('/admin/nilai-literatur/{id}', [AdminController::class, 'detailNilaiLiteratur'])->name('admin.nilai-literatur.detail');

        // Pengajuan Pembimbing routes
        Route::post('/admin/pengajuanpembimbing/approve/{id}', [DashboardAdminController::class, 'approve'])->name('admin.pengajuanpembimbing.approve');
        Route::post('/admin/pengajuanpembimbing/reject/{id}', [DashboardAdminController::class, 'reject'])->name('admin.pengajuanpembimbing.reject');
        Route::post('/admin/pendaftaranproposal/approve/{id}', [AdminController::class, 'approveProposal'])->name('admin.pendaftaranproposal.approve');
        Route::post('/admin/pendaftaranproposal/reject/{id}', [AdminController::class, 'rejectProposal'])->name('admin.pendaftaranproposal.reject');

        // Dosen Penguji routes
        // Route::get('/dpenguji', [DPengujiController::class, 'index'])->name('dpenguji.index');
        // Route::post('/dpenguji', [DPengujiController::class, 'store'])->name('dpenguji.store');
        // Route::put('/dpenguji/{id}', [DPengujiController::class, 'update'])->name('dpenguji.update');
        // Route::delete('/dpenguji/{id}', [DPengujiController::class, 'destroy'])->name('dpenguji.destroy');
    });

    // Dosen routes
    Route::middleware('role:dosen')->prefix('dosen')->group(function () {
        Route::get('/', [DashboardController::class, 'dosen'])->name('dosen.dashboard');
        Route::get('/penilaiandosen', function () {
            return view('penilaiandosen');
        })->name('penilaiandosen');
        Route::get('/nilaibimbingan', [NilaiBimbinganController::class, 'index'])->name('nilai-bimbingan.index');
        Route::post('/nilaibimbingan', [NilaiBimbinganController::class, 'store'])->name('nilai-bimbingan.store');
        Route::get('/nilaideskevaluasi', [NilaiDeController::class, 'index'])->name('nilai-de.index');
        Route::post('/nilaideskevaluasi', [NilaiDeController::class, 'store'])->name('nilai-de.store');
        Route::get('/nilaipresentasi', [NilaiPresentasiController::class, 'index'])->name('nilai-presentasi.index');
        Route::post('/nilaipresentasi', [NilaiPresentasiController::class, 'store'])->name('nilai-presentasi.store');
        Route::get('/nilailiteratur', [NilaiLiteraturController::class, 'index'])->name('nilai-literatur.index');
        Route::post('/nilailiteratur', [NilaiLiteraturController::class, 'store'])->name('nilai-literatur.store');

        // Add new proposal approval routes
        Route::get('/proposal-approval', [PendaftaranProposalController::class, 'dosenIndex'])->name('dosen.proposal-approval');
        Route::post('/proposal/approve/{id}', [PendaftaranProposalController::class, 'dosenApprove'])->name('dosen.proposal.approve');
        Route::post('/proposal/reject/{id}', [PendaftaranProposalController::class, 'dosenReject'])->name('dosen.proposal.reject');

        // Log Bimbingan routes untuk dosen
        Route::get('/log-bimbingan', [LogBimbinganController::class, 'dosenIndex'])->name('dosen.log-bimbingan');
        Route::post('/log-bimbingan/{id}/nilai', [LogBimbinganController::class, 'nilaiStore'])->name('dosen.log-bimbingan.nilai');
    });

    // Mahasiswa routes
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
        Route::get('/pendaftaranproposal', [PendaftaranProposalController::class, 'index'])->name('pendaftaranproposal');
        Route::post('/pendaftaranproposal', [PendaftaranProposalController::class, 'store'])->name('pendaftaranproposal.store');

        // Pengajuan Pembimbing routes
        Route::get('/pengajuanpembimbing', [PengajuanPembimbingController::class, 'index'])->name('pengajuanpembimbing');
        Route::post('/pengajuanpembimbing', [PengajuanPembimbingController::class, 'store'])->name('pengajuanpembimbing.store');

        // Log Bimbingan routes
        Route::prefix('logBimbingan')->group(function () {
            Route::get('/', [LogBimbinganController::class, 'create'])->name('log-bimbingan.create');
            Route::post('/', [LogBimbinganController::class, 'store'])->name('log-bimbingan.store');
            Route::get('/riwayat', [LogBimbinganController::class, 'index'])->name('log-bimbingan.index');
        });
    });

    // Shared routes (accessible by all authenticated users)
    Route::get('/desk-evaluation/get-dosen', [DeskEvaluationController::class, 'getDosen'])->name('desk-evaluation.get-dosen');
    Route::get('/nilai-presentasi/get-dosen', [NilaiPresentasiController::class, 'getDosen'])->name('nilai-presentasi.get-dosen');
});
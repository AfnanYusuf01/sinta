<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogBimbinganController;
use App\Http\Controllers\PengajuanPembimbingController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DeskEvaluationController;
use App\Http\Controllers\NilaiBimbinganController;
use App\Http\Controllers\NilaiDeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Public routes
Route::get('/templateTA', function () {
    return view('templateTA');
});

// Authentication routes
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth')->name('logout');

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/pendaftaran', function () {
        return view('pendaftaran');
    });
    
    Route::get('/pengajuan', function () {
        return view('pengajuan');
    });
    
    Route::get('/logBimbingan', function () {
        return view('logBimbingan');
    });
    
    Route::prefix('logBimbingan')->group(function () {
        Route::get('/', [LogBimbinganController::class, 'create'])->name('log-bimbingan.create');
        Route::post('/', [LogBimbinganController::class, 'store'])->name('log-bimbingan.store');
        Route::get('/riwayat', [LogBimbinganController::class, 'index'])->name('log-bimbingan.index');
    });

    Route::get('/pengajuanpembibing', [PengajuanPembimbingController::class, 'index'])->name('pengajuanpembimbing');
    Route::post('/pengajuanpembimbing', [PengajuanPembimbingController::class, 'store'])->name('pengajuanpembimbing.store');
});

// Routes for dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/nilaibimbingan', [NilaiBimbinganController::class, 'index'])->name('nilai-bimbingan.index');
    Route::post('/nilaibimbingan', [NilaiBimbinganController::class, 'store'])->name('nilai-bimbingan.store');
    
    Route::get('/nilaideskevaluasi', [NilaiDeController::class, 'index'])->name('nilai-de.index');
    Route::post('/nilaideskevaluasi', [NilaiDeController::class, 'store'])->name('nilai-de.store');
    
    Route::get('/nilaipresentasiproposalta', function () {
        return view('nilaipresentasiproposalta');
    });
    
    Route::get('/nilailiteratur', function () {
        return view('nilailiteratur');
    });
});

// Routes for admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboardadmin', function () {
        return view('dashboardadmin');
    });
    
    Route::get('/skPenguji', function () {
        return view('skPenguji');
    });
    
    Route::get('/skPembimbing', function () {
        return view('skPembimbing');
    });
});

Route::get('/pendaftaranproposal', function () {
    return view('pendaftaranproposal');
});

Route::get('/nilaideskevaluasi', function () {
    return view('nilaideskevaluasi');
});

Route::get('/nilaipresentasiproposalta', function () {
    return view('nilaipresentasiproposalta');
});

Route::get('/nilailiteratur', function () {
    return view('nilailiteratur');
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

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/deskevaluasi', [DeskEvaluationController::class, 'index'])->name('desk-evaluation.index');
Route::post('/desk-evaluation', [DeskEvaluationController::class, 'store'])->name('desk-evaluation.store');
Route::get('/desk-evaluation/get-dosen', [DeskEvaluationController::class, 'getDosen'])->name('desk-evaluation.get-dosen');

require __DIR__.'/auth.php';

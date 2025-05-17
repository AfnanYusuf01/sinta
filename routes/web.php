<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogBimbinganController;
use App\Http\Controllers\PengajuanPembimbingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/templateTA', function () {
    return view('templateTA');
});

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});

Route::get('/pengajuan', function () {
    return view('pengajuan');
});

Route::get('/perpanjangan', function () {
    return view('perpanjangan');
});

Route::get('/deskevaluasi', function () {
    return view('deskevaluasi');
});

Route::get('/penilaiandosen', function () {
    return view('penilaiandosen');
});

Route::get('/skPenguji', function () {
    return view('skPenguji');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/pendaftaranproposal', function () {
    return view('pendaftaranproposal');
});

Route::get('/skPembimbing', function () {
    return view('skPembimbing');
});

Route::get('/nilaibimbingan', function () {
    return view('nilaibimbingan');
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

Route::get('/logBimbingan', function () {
    return view('logBimbingan');
});


Route::get('/eksperimen', function () {
    return view('eksperimen');
})->name('eksperimen');

Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:dosen'])->group(function () {
//     Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
// });

// Route::middleware(['role:admin'])->group(function () {
    Route::prefix('logBimbingan')->group(function () {
        Route::get('/', [LogBimbinganController::class, 'create'])->name('log-bimbingan.create');
        Route::post('/', [LogBimbinganController::class, 'store'])->name('log-bimbingan.store');
        Route::get('/riwayat', [LogBimbinganController::class, 'index'])->name('log-bimbingan.index');
    });

        Route::get('/pengajuanpembibing', [PengajuanPembimbingController::class, 'index'])->name('pengajuanpembimbing');
    Route::post('/pengajuanpembimbing', [PengajuanPembimbingController::class, 'store'])->name('pengajuanpembimbing.store');
// });



require __DIR__.'/auth.php';

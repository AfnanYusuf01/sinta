<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\PendaftaranProposal;
use App\Models\Pembimbing;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function admin(): RedirectResponse
    {
        return redirect()->route('admin.dashboardadmin');
    }

    /**
     * Show the dosen dashboard.
     */
    public function dosen()
    {
        return view('index');
    }

    /**
     * Show the mahasiswa dashboard.
     */
    public function mahasiswa(): View
    {
        return view('index');
    }
}
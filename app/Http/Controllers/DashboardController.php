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
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Data dosen tidak ditemukan.');
        }

        // Get count of pending proposals
        $pendingProposals = PendaftaranProposal::where(function($query) use ($dosen) {
            $query->where('id_dosen_1', $dosen->id)
                  ->orWhere('id_dosen_2', $dosen->id);
        })
        ->where('status', 'menunggu')
        ->count();

        // Get count of total students being supervised
        $totalMahasiswa = Pembimbing::where('id_dosen', $dosen->id)
            ->where('status', 'aktif')
            ->count();

        // Get count of pending assessments (you can modify this based on your needs)
        $pendingPenilaian = 0; // This should be calculated based on your assessment system

        return view('dosen.dashboard', compact('pendingProposals', 'totalMahasiswa', 'pendingPenilaian'));
    }

    /**
     * Show the mahasiswa dashboard.
     */
    public function mahasiswa(): View
    {
        return view('dashboard.mahasiswa');
    }
}
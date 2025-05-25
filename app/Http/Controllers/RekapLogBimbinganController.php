<?php

namespace App\Http\Controllers;

use App\Models\LogBimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapLogBimbinganController extends Controller
{
    public function index(Request $request)
    {
        $query = LogBimbingan::query()
            ->select('log_bimbingan.*',
                    'mahasiswa.nama as nama_mahasiswa',
                    'mahasiswa.nim',
                    'dosen.nama as nama_dosen')
            ->join('users', 'log_bimbingan.id_user', '=', 'users.id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('dosen', 'log_bimbingan.id_dosen', '=', 'dosen.id')
            ->orderBy('log_bimbingan.tanggal', 'desc');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('mahasiswa.nama', 'like', "%{$search}%")
                  ->orWhere('mahasiswa.nim', 'like', "%{$search}%")
                  ->orWhere('dosen.nama', 'like', "%{$search}%")
                  ->orWhere('log_bimbingan.catatan', 'like', "%{$search}%");
            });
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('log_bimbingan.tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter by dosen if provided
        if ($request->has('dosen_id') && $request->dosen_id != '') {
            $query->where('log_bimbingan.id_dosen', $request->dosen_id);
        }

        // Get all dosen for filter dropdown
        $dosen = Dosen::orderBy('nama')->get();

        // Get paginated results
        $logs = $query->paginate(10)->withQueryString();

        return view('dlogbimbingan', compact('logs', 'dosen'));
    }

    public function export(Request $request)
    {
        // TODO: Implement export functionality
        return redirect()->back()->with('info', 'Fitur export akan segera tersedia.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulDospem;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pembimbing;
use App\Models\PengujiAssignment;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Get pengajuan pembimbing data
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Count pending submissions
        $pending_count = UsulDospem::where('status', 'menunggu')->count();

        // Get penguji assignments data
        $assignments = PengujiAssignment::with(['mahasiswa', 'dosen'])->get();
        $mahasiswas = Mahasiswa::whereNotIn('id', PengujiAssignment::pluck('id_mahasiswa'))->get();
        $dosens = Dosen::all();

        return view('dashboardadmin', compact('pengajuanList', 'pending_count', 'assignments', 'mahasiswas', 'dosens'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();

            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'diterima';
            $usulan->save();

            // Add to pembimbing table when approved
            Pembimbing::create([
                'id_mahasiswa' => $usulan->id_mahasiswa,
                'id_dosen' => $usulan->id_dosen_1,
                'status' => 'aktif',
                'jenis_pembimbing' => '1'
            ]);

            // Add second pembimbing if exists
            if ($usulan->id_dosen_2) {
                Pembimbing::create([
                    'id_mahasiswa' => $usulan->id_mahasiswa,
                    'id_dosen' => $usulan->id_dosen_2,
                    'status' => 'aktif',
                    'jenis_pembimbing' => '2'
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pengajuan pembimbing berhasil disetujui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'ditolak';
            $usulan->save();

            return redirect()->back()->with('success', 'Pengajuan pembimbing berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        try {
            DB::beginTransaction();

            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = $request->status;
            $usulan->save();

            // If approved, add to pembimbing table
            if ($request->status === 'diterima') {
                // Add first pembimbing
                Pembimbing::create([
                    'id_mahasiswa' => $usulan->id_mahasiswa,
                    'id_dosen' => $usulan->id_dosen_1,
                    'status' => 'aktif',
                    'jenis_pembimbing' => '1'
                ]);

                // Add second pembimbing if exists
                if ($usulan->id_dosen_2) {
                    Pembimbing::create([
                        'id_mahasiswa' => $usulan->id_mahasiswa,
                        'id_dosen' => $usulan->id_dosen_2,
                        'status' => 'aktif',
                        'jenis_pembimbing' => '2'
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
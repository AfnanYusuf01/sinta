<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulDospem;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Mengambil semua usulan dengan relasi mahasiswa dan dosen
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Hitung jumlah pengajuan yang masih menunggu
        $pending_count = UsulDospem::where('status', 'menunggu')->count();

        return view('dashboardadmin', compact('pengajuanList', 'pending_count'));
    }

    public function approve($id)
    {
        try {
            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'diterima';
            $usulan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembimbing berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'ditolak';
            $usulan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembimbing berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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

            // Jika status diterima, tambahkan ke tabel pembimbing
            if ($request->status === 'diterima') {
                // Tambah pembimbing 1
                Pembimbing::create([
                    'id_mahasiswa' => $usulan->id_mahasiswa,
                    'id_dosen' => $usulan->id_dosen_1,
                    'status' => 'aktif',
                    'jenis_pembimbing' => '1'
                ]);

                // Tambah pembimbing 2 jika ada
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
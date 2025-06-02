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
        // Get pengajuan pembimbing data yang berstatus menunggu
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
                            ->where('status', 'menunggu')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Count by status untuk statistik
        $totalPengajuan = UsulDospem::count();
        $menungguCount = UsulDospem::where('status', 'menunggu')->count();
        $diterimaCount = UsulDospem::where('status', 'diterima')->count();
        $ditolakCount = UsulDospem::where('status', 'ditolak')->count();

        return view('dashboardadmin', compact(
            'pengajuanList',
            'totalPengajuan',
            'menungguCount',
            'diterimaCount',
            'ditolakCount'
        ));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();

            $usulan = UsulDospem::findOrFail($id);
            
            // Cek apakah sudah ada data pembimbing untuk mahasiswa ini
            $existingPembimbing = Pembimbing::where('id_mahasiswa', $usulan->id_mahasiswa)
                ->where('status', 'aktif')
                ->exists();

            if ($existingPembimbing) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa sudah memiliki pembimbing aktif'
                ], 400);
            }

            // Update status usulan
            $usulan->status = 'diterima';
            $usulan->save();

            // Tambahkan pembimbing 1
            Pembimbing::create([
                'id_mahasiswa' => $usulan->id_mahasiswa,
                'id_dosen' => $usulan->id_dosen_1,
                'status' => 'aktif',
                'jenis_pembimbing' => '1'
            ]);

            // Tambahkan pembimbing 2 jika ada
            if ($usulan->id_dosen_2) {
                Pembimbing::create([
                    'id_mahasiswa' => $usulan->id_mahasiswa,
                    'id_dosen' => $usulan->id_dosen_2,
                    'status' => 'aktif',
                    'jenis_pembimbing' => '2'
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembimbing berhasil disetujui dan data pembimbing telah ditambahkan'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
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
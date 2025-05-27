<?php

namespace App\Http\Controllers;

use App\Models\UsulDospem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin', compact('pengajuanList'));
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
} 
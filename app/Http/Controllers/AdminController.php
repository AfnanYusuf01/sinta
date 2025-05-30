<?php

namespace App\Http\Controllers;

use App\Models\UsulDospem;
use App\Models\PendaftaranProposal;
use App\Models\NilaiBimbingan;
use App\Models\NilaiDe;
use App\Models\NilaiPresentasi;
use App\Models\NilaiLiteratur;
use App\Models\LogBimbingan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin', compact('pengajuanList'));
    }

    public function dashboard()
    {
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        $mahasiswas = \App\Models\Mahasiswa::all();
        $dosens = \App\Models\Dosen::all();
        $assignments = \App\Models\PengujiAssignment::with(['mahasiswa', 'dosen'])->get();

        return view('dashboardadmin', compact('pengajuanList', 'mahasiswas', 'dosens', 'assignments'));
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

    public function logbimbingan()
    {
        $logs = LogBimbingan::with(['mahasiswa', 'dosen'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        $dosen = \App\Models\Dosen::all();

        return view('dlogbimbingan', compact('logs', 'dosen'));
    }

    public function pendaftaranproposal()
    {
        $pendaftaranProposal = PendaftaranProposal::with(['mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dpendaftaranproposal', compact('pendaftaranProposal'));
    }

    public function nilaibimprota()
    {
        $nilaiBimbingan = NilaiBimbingan::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaibimprota', compact('nilaiBimbingan'));
    }

    public function nilaide()
    {
        $nilaiDeskEvaluasi = NilaiDe::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaide', compact('nilaiDeskEvaluasi'));
    }

    public function nilaipresentasita()
    {
        $nilaiPresentasi = NilaiPresentasi::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaipresentasita', compact('nilaiPresentasi'));
    }

    public function nilailiteratur()
    {
        $nilaiLiteratur = NilaiLiteratur::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilailiteratur', compact('nilaiLiteratur'));
    }

    public function penguji()
    {
        // Get mahasiswa yang belum memiliki penguji aktif
        $mahasiswas = \App\Models\Mahasiswa::whereDoesntHave('pengujiAssignments', function($query) {
            $query->where('status', 'aktif');
        })->get();

        // Get semua dosen
        $dosens = \App\Models\Dosen::all();

        // Get penugasan penguji yang aktif dengan relasinya
        $assignments = \App\Models\PengujiAssignment::with(['mahasiswa', 'dosen'])
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dpenguji', compact('mahasiswas', 'dosens', 'assignments'));
    }

    public function storePenguji(Request $request)
    {
        try {
            $request->validate([
                'mahasiswa_id' => [
                    'required',
                    'exists:mahasiswa,id',
                    Rule::unique('penguji_assignments')->where(function ($query) {
                        return $query->where('status', 'aktif');
                    })
                ],
                'dosen_id' => [
                    'required',
                    'exists:dosen,id',
                    'different:mahasiswa_id'
                ],
            ], [
                'mahasiswa_id.unique' => 'Mahasiswa ini sudah memiliki dosen penguji yang aktif.',
                'dosen_id.different' => 'Dosen penguji tidak boleh sama dengan mahasiswa.',
            ]);

            // Nonaktifkan penugasan sebelumnya jika ada
            \App\Models\PengujiAssignment::where('mahasiswa_id', $request->mahasiswa_id)
                ->update(['status' => 'nonaktif']);

            // Buat penugasan baru
            \App\Models\PengujiAssignment::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'dosen_id' => $request->dosen_id,
                'status' => 'aktif'
            ]);

            return redirect()->route('admin.penguji')
                           ->with('success', 'Penguji berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.penguji')
                           ->withErrors($e->validator)
                           ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function updatePenguji(Request $request, $id)
    {
        try {
            $request->validate([
                'dosen_id' => 'sometimes|required|exists:dosens,id',
                'status' => 'sometimes|required|in:aktif,nonaktif'
            ]);

            $assignment = \App\Models\PengujiAssignment::findOrFail($id);

            if ($request->has('dosen_id')) {
                // Nonaktifkan penugasan lama
                $assignment->update(['status' => 'nonaktif']);

                // Buat penugasan baru
                \App\Models\PengujiAssignment::create([
                    'mahasiswa_id' => $assignment->mahasiswa_id,
                    'dosen_id' => $request->dosen_id,
                    'status' => 'aktif'
                ]);

                $message = 'Dosen penguji berhasil diperbarui';
            } else if ($request->has('status')) {
                // Update status saja
                $assignment->update(['status' => $request->status]);
                $message = 'Status penguji berhasil diperbarui';
            }

            return redirect()->route('admin.penguji')
                           ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyPenguji($id)
    {
        try {
            $assignment = \App\Models\PengujiAssignment::findOrFail($id);
            $assignment->delete();

            return redirect()->route('admin.penguji')
                           ->with('success', 'Penguji berhasil dihapus dari sistem');
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function approveProposal($id)
    {
        try {
            $proposal = PendaftaranProposal::findOrFail($id);
            $proposal->status = 'diterima';
            $proposal->save();

            return response()->json([
                'success' => true,
                'message' => 'Proposal berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rejectProposal($id)
    {
        try {
            $proposal = PendaftaranProposal::findOrFail($id);
            $proposal->status = 'ditolak';
            $proposal->save();

            return response()->json([
                'success' => true,
                'message' => 'Proposal berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detailNilaiBimbingan($id)
    {
        $nilai = NilaiBimbingan::with(['mahasiswa', 'dosen'])->findOrFail($id);
        return response()->json($nilai);
    }

    public function detailNilaiDe($id)
    {
        $nilai = NilaiDe::with(['mahasiswa', 'dosen'])->findOrFail($id);
        return response()->json($nilai);
    }

    public function detailNilaiPresentasi($id)
    {
        $nilai = NilaiPresentasi::with(['mahasiswa', 'dosen'])->findOrFail($id);
        return response()->json($nilai);
    }

    public function detailNilaiLiteratur($id)
    {
        $nilai = NilaiLiteratur::with(['mahasiswa', 'dosen'])->findOrFail($id);
        return response()->json($nilai);
    }
}
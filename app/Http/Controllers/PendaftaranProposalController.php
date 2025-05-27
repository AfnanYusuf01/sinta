<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranProposal;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class PendaftaranProposalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        // Ambil semua dosen dari tabel dosen
        $dosenList = Dosen::all();
        // Ambil data pendaftaran proposal mahasiswa
        $pendaftaran = PendaftaranProposal::where('id_mahasiswa', $mahasiswa->id)
            ->whereIn('status', ['menunggu', 'diterima'])
            ->latest()
            ->first();

        return view('pendaftaranproposal', compact('mahasiswa', 'dosenList', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_ta' => 'required|string|max:255',
            'abstrak' => 'required|string',
            'dosen1' => 'required|exists:dosen,id',
            'dosen2' => 'nullable|exists:dosen,id|different:dosen1',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $mahasiswa_id = $mahasiswa->id;

        // Cek apakah mahasiswa sudah memiliki pendaftaran proposal yang belum diproses
        $pendaftaran = PendaftaranProposal::with(['dosen1', 'dosen2'])
            ->where('id_mahasiswa', $mahasiswa->id)
            ->whereIn('status', ['menunggu', 'diterima', 'ditolak'])
            ->latest()
            ->first();

        if ($pendaftaran) {
            return redirect()->back()->with('error', 'Anda sudah memiliki usulan yang belum diproses.');
        }

        PendaftaranProposal::create([
            'judul_ta' => $request->judul_ta,
            'abstrak' => $request->abstrak,
            'id_mahasiswa' => $mahasiswa_id,
            'id_dosen_1' => $request->dosen1,
            'id_dosen_2' => $request->dosen2,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pendaftaranproposal')->with('success', 'Pendaftaran proposal berhasil dikirim!');
    }

    public function adminIndex()
    {
        $proposalList = PendaftaranProposal::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dpendaftaranproposal', compact('proposalList'));
    }

    public function approve($id)
    {
        try {
            $proposal = PendaftaranProposal::findOrFail($id);
            $proposal->status = 'diterima';
            $proposal->save();

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran proposal berhasil disetujui'
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
            $proposal = PendaftaranProposal::findOrFail($id);
            
            // Langsung hapus data ketika ditolak
            $proposal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran proposal telah ditolak dan dihapus dari sistem'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LogBimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogBimbinganController extends Controller
{
    /**
     * Menampilkan form input log bimbingan
     */
    public function create()
    {
        // Ambil data mahasiswa yang login
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Ambil daftar dosen pembimbing yang terkait dengan mahasiswa
        $dosen = Dosen::whereHas('mahasiswaPembimbing', function($query) use ($mahasiswa) {
            $query->where('pembimbing.id_mahasiswa', $mahasiswa->id)
                  ->where('pembimbing.status', 'aktif');
        })->get();

        // Ambil riwayat log bimbingan dengan pagination
        $logs = LogBimbingan::where('id_user', Auth::id())
            ->with('dosen')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('logBimbingan', compact('mahasiswa', 'dosen', 'logs'));
    }

    /**
     * Menyimpan log bimbingan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_dosen' => 'required|exists:dosen,id',
            'catatan' => 'required|string'
        ]);

        // Ambil ID mahasiswa dari user yang login
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Validasi bahwa dosen yang dipilih adalah pembimbing mahasiswa
        $isValidDosen = $mahasiswa->dosenPembimbing()
            ->where('dosen.id', $request->id_dosen)
            ->where('pembimbing.status', 'aktif')
            ->exists();

        if (!$isValidDosen) {
            return redirect()->back()
                ->with('error', 'Dosen yang dipilih bukan pembimbing Anda!')
                ->withInput();
        }

        LogBimbingan::create([
            'id_user' => Auth::id(),
            'id_dosen' => $request->id_dosen,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'nilai' => null // Nilai awalnya null (menunggu persetujuan)
        ]);

        return redirect()->route('log-bimbingan.create')
            ->with('success', 'Log bimbingan berhasil disimpan!');
    }

    /**
     * Menampilkan daftar log bimbingan untuk dosen
     */
    public function dosenIndex()
    {
        // Ambil data dosen yang login
        $dosen = Dosen::where('user_id', Auth::id())->first();

        // Ambil log bimbingan yang perlu dinilai
        $logs = LogBimbingan::where('id_dosen', $dosen->id)
            ->with(['user.mahasiswa'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('dosen.logBimbingan', compact('logs'));
    }

    /**
     * Menyimpan nilai untuk log bimbingan
     */
    public function nilaiStore(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100'
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->first();
        $logBimbingan = LogBimbingan::where('id', $id)
            ->where('id_dosen', $dosen->id)
            ->firstOrFail();

        $logBimbingan->update([
            'nilai' => $request->nilai
        ]);

        return redirect()->route('dosen.log-bimbingan')
            ->with('success', 'Nilai berhasil disimpan!');
    }
}
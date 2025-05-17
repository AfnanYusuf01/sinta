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
        // dd($mahasiswa);
        
        // Ambil daftar dosen pembimbing
        $dosen = Dosen::all();
        
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
     * Menampilkan riwayat log bimbingan
     */
    public function index()
    {
        $logs = LogBimbingan::where('id_user', Auth::id())
            ->with('dosen')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('log-bimbingan.index', compact('logs'));
    }
}
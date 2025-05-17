<?php

namespace App\Http\Controllers;

use App\Models\DeskEvaluasi;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    // Menampilkan daftar mahasiswa yang perlu dinilai
    public function index()
    {
        // Ambil data dosen yang login
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();
        
        // Ambil mahasiswa yang dibimbing atau diuji oleh dosen ini
        $mahasiswa = Mahasiswa::where('pembimbing', $dosen->id)
                        ->orWhere('penguji', $dosen->id)
                        ->get();
        
        return view('dex', compact('mahasiswa', 'dosen'));
    }

    // Menampilkan halaman penilaian untuk mahasiswa tertentu
    public function show(Mahasiswa $mahasiswa)
    {
        // Pastikan dosen yang login berhak menilai mahasiswa ini
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();
        
        if ($mahasiswa->pembimbing != $dosen->id && $mahasiswa->penguji != $dosen->id) {
            abort(403, 'Anda tidak berhak menilai mahasiswa ini');
        }
        
        // Ambil semua evaluasi untuk mahasiswa ini oleh dosen ini
        $evaluations = DeskEvaluasi::where('id_mahasiswa', $mahasiswa->id)
                        ->where('id_dosen', $dosen->id)
                        ->get();
        
        return view('penilaian', compact('mahasiswa', 'dosen', 'evaluations'));
    }

    // Menambahkan desk evaluation baru
    public function addEvaluation(Mahasiswa $mahasiswa, Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();
        
        // Pastikan dosen berhak menambah evaluasi
        if ($mahasiswa->pembimbing != $dosen->id && $mahasiswa->penguji != $dosen->id) {
            abort(403, 'Anda tidak berhak menambah evaluasi untuk mahasiswa ini');
        }
        
        $evaluation = new DeskEvaluasi();
        $evaluation->id_mahasiswa = $mahasiswa->id;
        $evaluation->id_dosen = $dosen->id;
        $evaluation->save();
        
        return redirect()->route('penilaian.show', $mahasiswa)
                         ->with('success', 'Desk evaluation baru berhasil ditambahkan');
    }

    // Menyimpan penilaian
    public function store(DeskEvaluasi $deskEvaluasi, Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_ta' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);
        
        // Pastikan yang mengedit adalah dosen yang membuat evaluasi
        if ($deskEvaluasi->id_dosen != Dosen::where('user_id', Auth::id())->first()->id) {
            abort(403, 'Anda tidak berhak mengedit evaluasi ini');
        }
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('evaluations');
            $validated['file'] = $filePath;
        }
        
        $deskEvaluasi->update($validated);
        
        return back()->with('success', 'Penilaian berhasil disimpan');
    }

    // Menandai evaluasi sebagai selesai
    public function complete(DeskEvaluasi $deskEvaluasi)
    {
        // Pastikan yang mengedit adalah dosen yang membuat evaluasi
        if ($deskEvaluasi->id_dosen != Dosen::where('user_id', Auth::id())->first()->id) {
            abort(403, 'Anda tidak berhak mengedit evaluasi ini');
        }
        
        $deskEvaluasi->update(['completed' => true]);
        
        return back()->with('success', 'Evaluasi telah ditandai sebagai selesai');
    }
}
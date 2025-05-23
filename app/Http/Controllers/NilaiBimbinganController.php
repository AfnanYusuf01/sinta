<?php

namespace App\Http\Controllers;

use App\Models\NilaiBimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NilaiBimbinganController extends Controller
{
    public function index()
    {
        // Ambil data dosen yang sedang login
        $dosen = Dosen::where('user_id', Auth::id())->first();
        
        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        // Ambil data mahasiswa bimbingan yang belum dinilai
        $mahasiswa = Mahasiswa::whereHas('pembimbing', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id)
                  ->where('status', 'aktif');
        })->whereDoesntHave('nilaiBimbingan', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id);
        })->get();

        // Log untuk debug
        Log::info('Dosen ID: ' . $dosen->id);
        Log::info('Jumlah Mahasiswa yang belum dinilai: ' . $mahasiswa->count());
        
        // Cek data pembimbing
        $pembimbing = Pembimbing::where('id_dosen', $dosen->id)
                               ->where('status', 'aktif')
                               ->get();
        Log::info('Data Pembimbing: ' . $pembimbing->toJson());

        // Ambil nilai bimbingan yang sudah ada
        $nilaiExisting = NilaiBimbingan::where('id_dosen', $dosen->id)
            ->get()
            ->keyBy('id_mahasiswa');

        return view('nilaibimbingan', compact('mahasiswa', 'dosen', 'nilaiExisting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'nilai_1' => 'required|integer|min:0|max:100',
            'nilai_2' => 'required|integer|min:0|max:100',
            'nilai_3' => 'required|integer|min:0|max:100',
            'nilai_4' => 'required|integer|min:0|max:100',
            'nilai_5' => 'required|integer|min:0|max:100',
            'nilai_6' => 'required|integer|min:0|max:100',
            'nilai_7' => 'required|integer|min:0|max:100',
        ]);

        // Ambil data dosen yang sedang login
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        // Verifikasi bahwa mahasiswa adalah mahasiswa bimbingan dosen ini
        $isMahasiswaBimbingan = Mahasiswa::where('id', $request->mahasiswa_id)
            ->whereHas('pembimbing', function($query) use ($dosen) {
                $query->where('id_dosen', $dosen->id)
                      ->where('status', 'aktif');
            })->exists();

        if (!$isMahasiswaBimbingan) {
            return redirect()->back()->with('error', 'Mahasiswa bukan mahasiswa bimbingan Anda.');
        }

        // Hitung total nilai
        $total_nilai = ($request->nilai_1 + $request->nilai_2 + $request->nilai_3 + 
                       $request->nilai_4 + $request->nilai_5 + $request->nilai_6 + 
                       $request->nilai_7) / 7;

        // Cek apakah sudah ada nilai untuk mahasiswa ini
        $nilai = NilaiBimbingan::where('id_mahasiswa', $request->mahasiswa_id)
                              ->where('id_dosen', $dosen->id)
                              ->first();

        if ($nilai) {
            // Update nilai yang sudah ada
            $nilai->update([
                'nilai_1' => $request->nilai_1,
                'nilai_2' => $request->nilai_2,
                'nilai_3' => $request->nilai_3,
                'nilai_4' => $request->nilai_4,
                'nilai_5' => $request->nilai_5,
                'nilai_6' => $request->nilai_6,
                'nilai_7' => $request->nilai_7,
                'total_nilai' => $total_nilai
            ]);

            $message = 'Nilai bimbingan berhasil diperbarui!';
        } else {
            // Buat nilai baru
            NilaiBimbingan::create([
                'id_mahasiswa' => $request->mahasiswa_id,
                'id_dosen' => $dosen->id,
                'nilai_1' => $request->nilai_1,
                'nilai_2' => $request->nilai_2,
                'nilai_3' => $request->nilai_3,
                'nilai_4' => $request->nilai_4,
                'nilai_5' => $request->nilai_5,
                'nilai_6' => $request->nilai_6,
                'nilai_7' => $request->nilai_7,
                'total_nilai' => $total_nilai
            ]);

            $message = 'Nilai bimbingan berhasil disimpan!';
        }

        return redirect()->back()->with('success', $message);
    }
} 
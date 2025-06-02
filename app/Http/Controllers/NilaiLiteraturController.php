<?php

namespace App\Http\Controllers;

use App\Models\NilaiLiteratur;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NilaiLiteraturController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        // Mahasiswa yang dibimbing dosen & belum dinilai literatur oleh dosen ini
        $mahasiswa = Mahasiswa::whereHas('pembimbing', function ($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id)
                ->where('status', 'aktif');
        })->whereDoesntHave('nilaiLiteratur', function ($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id);
        })->get();

        Log::info('Dosen ID (Literatur): ' . $dosen->id);
        Log::info('Jumlah Mahasiswa yang belum dinilai literatur: ' . $mahasiswa->count());

        $pembimbing = Pembimbing::where('id_dosen', $dosen->id)
            ->where('status', 'aktif')->get();

        Log::info('Data Pembimbing (Literatur): ' . $pembimbing->toJson());

        $nilaiExisting = NilaiLiteratur::where('id_dosen', $dosen->id)
            ->get()
            ->keyBy('id_mahasiswa');

        return view('nilailiteratur', compact('mahasiswa', 'dosen', 'nilaiExisting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id',
            'nilai_pemahaman' => 'required|integer|min:0|max:100',
            'nilai_analisis' => 'required|integer|min:0|max:100',
            'nilai_sintesis' => 'required|integer|min:0|max:100',
            'nilai_kesimpulan' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string'
        ]);


        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        $isMahasiswaBimbingan = Mahasiswa::where('id', $request->id_mahasiswa)
            ->whereHas('pembimbing', function ($query) use ($dosen) {
                $query->where('id_dosen', $dosen->id)
                    ->where('status', 'aktif');
            })->exists();

        if (!$isMahasiswaBimbingan) {
            return redirect()->back()->with('error', 'Mahasiswa bukan bimbingan Anda.');
        }

        // Hitung total nilai literatur
        $total_nilai = $request->nilai_pemahaman + $request->nilai_analisis + $request->nilai_sintesis + $request->nilai_kesimpulan;

        // Cek jika nilai sudah ada
        $nilai = NilaiLiteratur::where('id_mahasiswa', $request->id_mahasiswa)
            ->where('id_dosen', $dosen->id)
            ->first();

        if ($nilai) {
            $nilai->update([
                'nilai_pemahaman' => $request->nilai_pemahaman,
                'nilai_analisis' => $request->nilai_analisis,
                'nilai_sintesis' => $request->nilai_sintesis,
                'nilai_kesimpulan' => $request->nilai_kesimpulan,
                'catatan' => $request->catatan,
                'total_nilai' => $total_nilai
            ]);

            $message = 'Nilai literatur berhasil diperbarui!';
        } else {
            NilaiLiteratur::create([
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_dosen' => $dosen->id,
                'nilai_pemahaman' => $request->nilai_pemahaman,
                'nilai_analisis' => $request->nilai_analisis,
                'nilai_sintesis' => $request->nilai_sintesis,
                'nilai_kesimpulan' => $request->nilai_kesimpulan,
                'catatan' => $request->catatan,
                'total_nilai' => $total_nilai
            ]);

            $message = 'Nilai literatur berhasil disimpan!';
        }

        return redirect()->back()->with('success', $message);
    }
    // NilaiLiteraturController.php
    public function show($id)
    {
        $nilai = NilaiLiteratur::with(['mahasiswa', 'dosen'])->findOrFail($id);

        return response()->json($nilai);
    }
}

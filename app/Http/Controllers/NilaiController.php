<?php

namespace App\Http\Controllers;

use App\Models\NilaiBimbingan;
use App\Models\NilaiDe;
use App\Models\NilaiPresentasi;
use App\Models\NilaiLiteratur;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function nilaiBimbingan()
    {
        $nilaiBimbingan = NilaiBimbingan::with(['mahasiswa', 'dosen'])->get()->map(function($nilai) {
            $total = ($nilai->nilai_1 + $nilai->nilai_2 + $nilai->nilai_3 +
                     $nilai->nilai_4 + $nilai->nilai_5 + $nilai->nilai_6 +
                     $nilai->nilai_7) / 7;
            $nilai->total_nilai = number_format($total, 2);
            return $nilai;
        });
        return view('dnilaibimprota', compact('nilaiBimbingan'));
    }

    public function nilaiDe()
    {
        $nilaiDe = NilaiDe::with(['mahasiswa', 'dosen'])->get()->map(function($nilai) {
            $total = ($nilai->nilai_1 + $nilai->nilai_2 + $nilai->nilai_3 +
                     $nilai->nilai_4 + $nilai->nilai_5 + $nilai->nilai_6 +
                     $nilai->nilai_7) / 7;
            $nilai->total_nilai = number_format($total, 2);
            return $nilai;
        });
        return view('dnilaide', compact('nilaiDe'));
    }

    public function nilaiPresentasi()
    {
        $nilaiPresentasi = NilaiPresentasi::with(['mahasiswa', 'dosen'])->get()->map(function($nilai) {
            $total = ($nilai->nilai_penyajian + $nilai->nilai_tingkat_penguasaan +
                     $nilai->nilai_kualitas_jawaban + $nilai->nilai_sikap) / 4;
            $nilai->total_nilai = number_format($total, 2);
            return $nilai;
        });
        return view('dnilaipresentasita', compact('nilaiPresentasi'));
    }

    public function nilaiLiteratur()
    {
        $nilaiLiteratur = NilaiLiteratur::with(['mahasiswa', 'dosen'])->get()->map(function($nilai) {
            $total = ($nilai->nilai_pemahaman + $nilai->nilai_analisis +
                     $nilai->nilai_sintesis + $nilai->nilai_kesimpulan) / 4;
            $nilai->total_nilai = number_format($total, 2);
            return $nilai;
        });
        return view('dnilailiteratur', compact('nilaiLiteratur'));
    }

    // Detail methods with average calculation
    public function detailNilaiBimbingan($id)
    {
        $nilai = NilaiBimbingan::with(['mahasiswa', 'dosen'])->findOrFail($id);
        $total = ($nilai->nilai_1 + $nilai->nilai_2 + $nilai->nilai_3 +
                 $nilai->nilai_4 + $nilai->nilai_5 + $nilai->nilai_6 +
                 $nilai->nilai_7) / 7;
        $nilai->total_nilai = number_format($total, 2);
        return response()->json($nilai);
    }

    public function detailNilaiDe($id)
    {
        $nilai = NilaiDe::with(['mahasiswa', 'dosen'])->findOrFail($id);
        $total = ($nilai->nilai_1 + $nilai->nilai_2 + $nilai->nilai_3 +
                 $nilai->nilai_4 + $nilai->nilai_5 + $nilai->nilai_6 +
                 $nilai->nilai_7) / 7;
        $nilai->total_nilai = number_format($total, 2);
        return response()->json($nilai);
    }

    public function detailNilaiPresentasi($id)
    {
        $nilai = NilaiPresentasi::with(['mahasiswa', 'dosen'])->findOrFail($id);
        $total = ($nilai->nilai_penyajian + $nilai->nilai_tingkat_penguasaan +
                 $nilai->nilai_kualitas_jawaban + $nilai->nilai_sikap) / 4;
        $nilai->total_nilai = number_format($total, 2);
        return response()->json($nilai);
    }

    public function detailNilaiLiteratur($id)
    {
        $nilai = NilaiLiteratur::with(['mahasiswa', 'dosen'])->findOrFail($id);
        $total = ($nilai->nilai_pemahaman + $nilai->nilai_analisis +
                 $nilai->nilai_sintesis + $nilai->nilai_kesimpulan) / 4;
        $nilai->total_nilai = number_format($total, 2);
        return response()->json($nilai);
    }
}
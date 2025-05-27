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
        $nilaiBimbingan = NilaiBimbingan::with(['mahasiswa', 'dosen'])->get();
        return view('dnilaibimprota', compact('nilaiBimbingan'));
    }

    public function nilaiDe()
    {
        $nilaiDe = NilaiDe::with(['mahasiswa', 'dosen'])->get();
        return view('dnilaide', compact('nilaiDe'));
    }

    public function nilaiPresentasi()
    {
        $nilaiPresentasi = NilaiPresentasi::with(['mahasiswa', 'dosen'])->get();
        return view('dnilaipresentasita', compact('nilaiPresentasi'));
    }

    public function nilaiLiteratur()
    {
        $nilaiLiteratur = NilaiLiteratur::with(['mahasiswa', 'dosen'])->get();
        return view('dnilailiteratur', compact('nilaiLiteratur'));
    }

    // Detail methods
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
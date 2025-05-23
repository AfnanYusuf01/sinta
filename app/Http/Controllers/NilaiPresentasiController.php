<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\NilaiPresentasi;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NilaiPresentasiController extends Controller
{
    public function index()
    {
        // Ambil data dosen yang sedang login
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        // Ambil data mahasiswa yang belum dinilai
        // Mahasiswa yang dipilih adalah yang memiliki relasi dengan dosen di tabel Pembimbing
        $mahasiswa = Mahasiswa::whereHas('Pembimbing', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id)
                  ->where('status', 'aktif');
        })->whereDoesntHave('nilaiPresentasi', function($query) use ($dosen) {
            $query->where('id_dosen', $dosen->id);
        })->get();

        // Log untuk debug
        Log::info('Dosen ID: ' . $dosen->id);
        Log::info('Jumlah Mahasiswa yang belum dinilai Presentasi: ' . $mahasiswa->count());

        // Cek data Pembimbing
        $Pembimbing = Pembimbing::where('id_dosen', $dosen->id)
                         ->where('status', 'aktif')
                         ->get();
        Log::info('Data Pembimbing: ' . $Pembimbing->toJson());

        // Ambil nilai presentasi yang sudah ada
        $nilaiPresentasis = NilaiPresentasi::where('id_dosen', $dosen->id)
            ->with('mahasiswa') // Eager load mahasiswa relation
            ->get()
            ->keyBy('id_mahasiswa');

        return view('nilaipresentasiproposalta', compact('mahasiswa', 'dosen', 'nilaiPresentasis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id',
            'nilai_penyajian' => 'required|integer|min:0|max:100',
            'nilai_tingkat_penguasaan' => 'required|integer|min:0|max:100',
            'nilai_kualitas_jawaban' => 'required|integer|min:0|max:100',
            'nilai_sikap' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:1000'
            ]);

        // Ambil data dosen yang sedang login
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
        }

        // Verifikasi bahwa mahasiswa adalah mahasiswa yang diuji oleh dosen ini
        $isMahasiswaPembimbing = Pembimbing::where('id_mahasiswa', $request->id_mahasiswa)
            ->where('id_dosen', $dosen->id)
            ->where('status', 'aktif')
            ->exists();

        if (!$isMahasiswaPembimbing) {
            return redirect()->back()->with('error', 'Mahasiswa bukan mahasiswa yang Anda uji.');
        }

        try {
            // Cek apakah sudah ada nilai untuk mahasiswa ini
            $nilaiPresentasi = NilaiPresentasi::where('id_mahasiswa', $request->id_mahasiswa)
                ->where('id_dosen', $dosen->id)
                ->first();

            if ($nilaiPresentasi) {
                // Update nilai yang sudah ada
                $nilaiPresentasi->update([
                    'nilai_penyajian' => $request->nilai_penyajian,
                    'nilai_tingkat_penguasaan' => $request->nilai_tingkat_penguasaan,
                    'nilai_kualitas_jawaban' => $request->nilai_kualitas_jawaban,
                    'nilai_sikap' => $request->nilai_sikap,
                    'catatan' => $request->catatan
                ]);

                $message = 'Nilai presentasi berhasil diperbarui!';
            } else {
                // Buat nilai baru
                NilaiPresentasi::create([
                    'id_mahasiswa' => $request->id_mahasiswa,
                    'id_dosen' => $dosen->id,
                    'nilai_penyajian' => $request->nilai_penyajian,
                    'nilai_tingkat_penguasaan' => $request->nilai_tingkat_penguasaan,
                    'nilai_kualitas_jawaban' => $request->nilai_kualitas_jawaban,
                    'nilai_sikap' => $request->nilai_sikap,
                    'catatan' => $request->catatan
                ]);

                $message = 'Nilai presentasi berhasil disimpan!';
            }

            // Log aktivitas
            Log::info('Nilai Presentasi berhasil disimpan/diupdate', [
                'dosen_id' => $dosen->id,
                'mahasiswa_id' => $request->id_mahasiswa,
                'nilai' => $request->all()
            ]);

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan nilai presentasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan nilai.');
        }
    }

    public function getDosen()
    {
        $dosens = Dosen::all();
        return response()->json($dosens);
    }
}
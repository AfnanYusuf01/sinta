<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\NilaiLiteratur;
use App\Models\Penguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NilaiLiteraturController extends Controller
{
    public function index()
    {
        try {
            // Ambil data dosen yang sedang login
            $dosen = Dosen::where('user_id', Auth::id())->first();

            if (!$dosen) {
                return redirect()->back()->with('error', 'Akses ditolak. Anda bukan dosen.');
            }

            // Ambil data mahasiswa yang belum dinilai
            // Mahasiswa yang dipilih adalah yang memiliki relasi dengan dosen di tabel penguji
            $mahasiswa = Mahasiswa::whereHas('penguji', function($query) use ($dosen) {
                $query->where('id_dosen', $dosen->id)
                      ->where('status', 'aktif');
            })->whereDoesntHave('nilaiLiteratur', function($query) use ($dosen) {
                $query->where('id_dosen', $dosen->id);
            })->get();

            // Log untuk debug
            Log::info('Dosen ID: ' . $dosen->id);
            Log::info('Jumlah Mahasiswa yang belum dinilai Literatur: ' . $mahasiswa->count());

            // Cek data penguji
            $penguji = Penguji::where('id_dosen', $dosen->id)
                             ->where('status', 'aktif')
                             ->get();
            Log::info('Data Penguji: ' . $penguji->toJson());

            // Ambil nilai literatur yang sudah ada
            $nilaiLiteraturs = NilaiLiteratur::where('id_dosen', $dosen->id)
                ->with('mahasiswa')
                ->get();

            return view('nilailiteratur', compact('mahasiswa', 'dosen', 'nilaiLiteraturs'));
        } catch (\Exception $e) {
            Log::error('Error in NilaiLiteraturController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman.');
        }
    }

    public function store(Request $request)
    {
        try {
            // Log data yang diterima
            Log::info('Data yang diterima:', $request->all());

            // Validasi input
            $validated = $request->validate([
                'id_mahasiswa' => 'required|exists:mahasiswa,id',
                'nilai_pemahaman' => 'required|integer|min:0|max:100',
                'nilai_analisis' => 'required|integer|min:0|max:100',
                'nilai_sintesis' => 'required|integer|min:0|max:100',
                'nilai_kesimpulan' => 'required|integer|min:0|max:100',
                'catatan' => 'nullable|string|max:1000'
            ]);

            Log::info('Validasi berhasil:', $validated);

            // Ambil data dosen yang sedang login
            $dosen = Dosen::where('user_id', Auth::id())->first();
            Log::info('Data dosen:', ['dosen_id' => $dosen ? $dosen->id : null]);

            if (!$dosen) {
                Log::error('Dosen tidak ditemukan untuk user_id: ' . Auth::id());
                return redirect()->route('nilai-literatur.index')->with('error', 'Akses ditolak. Anda bukan dosen.');
            }

            // Verifikasi bahwa mahasiswa adalah mahasiswa yang diuji oleh dosen ini
            $isMahasiswaPenguji = Penguji::where('id_mahasiswa', $request->id_mahasiswa)
                ->where('id_dosen', $dosen->id)
                ->where('status', 'aktif')
                ->exists();

            Log::info('Status mahasiswa penguji:', [
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_dosen' => $dosen->id,
                'is_penguji' => $isMahasiswaPenguji
            ]);

            if (!$isMahasiswaPenguji) {
                Log::error('Mahasiswa bukan penguji yang valid:', [
                    'id_mahasiswa' => $request->id_mahasiswa,
                    'id_dosen' => $dosen->id
                ]);
                return redirect()->route('nilai-literatur.index')
                    ->with('error', 'Mahasiswa bukan mahasiswa yang Anda uji.')
                    ->withInput();
            }

            // Cek apakah sudah ada nilai untuk mahasiswa ini
            $nilaiLiteratur = NilaiLiteratur::where('id_mahasiswa', $request->id_mahasiswa)
                ->where('id_dosen', $dosen->id)
                ->first();

            Log::info('Status nilai literatur:', [
                'exists' => $nilaiLiteratur ? true : false,
                'nilai_id' => $nilaiLiteratur ? $nilaiLiteratur->id : null
            ]);

            $data = [
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_dosen' => $dosen->id,
                'nilai_pemahaman' => $request->nilai_pemahaman,
                'nilai_analisis' => $request->nilai_analisis,
                'nilai_sintesis' => $request->nilai_sintesis,
                'nilai_kesimpulan' => $request->nilai_kesimpulan,
                'catatan' => $request->catatan
            ];

            if ($nilaiLiteratur) {
                // Update nilai yang sudah ada
                $nilaiLiteratur->update($data);
                $message = 'Nilai literatur berhasil diperbarui!';
                Log::info('Nilai literatur berhasil diupdate:', $data);
            } else {
                // Buat nilai baru
                NilaiLiteratur::create($data);
                $message = 'Nilai literatur berhasil disimpan!';
                Log::info('Nilai literatur berhasil disimpan:', $data);
            }

            return redirect()->route('nilai-literatur.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error detail saat menyimpan nilai literatur: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('nilai-literatur.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan nilai: ' . $e->getMessage())
                ->withInput();
        }
    }
}
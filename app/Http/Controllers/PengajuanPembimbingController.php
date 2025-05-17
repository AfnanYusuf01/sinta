<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulDospem;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class PengajuanPembimbingController extends Controller
{
        public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        // dd(Auth::id());
        $mahasiswa_id = $mahasiswa->id;
        // Cek apakah mahasiswa sudah pernah mengajukan
        $usulan = UsulDospem::where('id_mahasiswa', $mahasiswa_id)
                            ->latest()
                            ->first();

        // Ambil data dosen untuk dropdown
        $dosenList = Dosen::orderBy('nama')->get();
        // dd($dosenList);

        return view('pengajuanpembibing', compact('usulan', 'dosenList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_ta' => 'required|string|max:255',
            'dosen1' => 'required|exists:dosen,id',
            'dosen2' => 'nullable|exists:dosen,id|different:dosen1',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        // dd(Auth::id());
        $mahasiswa_id = $mahasiswa->id;
        // Cek apakah mahasiswa sudah memiliki usulan yang belum diproses
        $existingUsulan = UsulDospem::where('id_mahasiswa', $mahasiswa_id)
                                    ->whereIn('status', ['menunggu', 'diterima'])
                                    ->first();

        if ($existingUsulan) {
            return redirect()->back()->with('error', 'Anda sudah memiliki usulan yang belum diproses.');
        }


        
        UsulDospem::create([
            'judul_ta' => $request->judul_ta,
            'id_mahasiswa' => $mahasiswa_id,
            'id_dosen_1' => $request->dosen1,
            'id_dosen_2' => $request->dosen2,
            'status' => 'menunggu'
        ]);

        return redirect()->route('pengajuanpembimbing')->with('success', 'Usulan pembimbing berhasil dikirim!');
    }
}
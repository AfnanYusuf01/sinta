<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengujiAssignment;
use Illuminate\Http\Request;

class PengujiAssignmentController extends Controller
{
    public function index()
    {
        $assignments = PengujiAssignment::with(['mahasiswa', 'dosen'])->get();
        $mahasiswas = Mahasiswa::whereNotIn('id', PengujiAssignment::pluck('mahasiswa_id'))->get();
        $dosen = Dosen::all();

        return view('dpenguji', compact('assignments', 'mahasiswas', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'dosen_id' => 'required|exists:dosen,id'
        ]);

        PengujiAssignment::create($request->only(['mahasiswa_id', 'dosen_id']));

        return redirect()->route('admin.penguji')->with('success', 'Penguji berhasil ditambahkan');
    }

    public function update(Request $request, PengujiAssignment $assignment)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id'
        ]);

        $assignment->update(['dosen_id' => $request->dosen_id]);

        return redirect()->route('admin.penguji')->with('success', 'Penguji berhasil diperbarui');
    }

    public function destroy(PengujiAssignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('admin.penguji')->with('success', 'Penguji berhasil dihapus');
    }
}

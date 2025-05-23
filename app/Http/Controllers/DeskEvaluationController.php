<?php

namespace App\Http\Controllers;

use App\Models\DeskEvaluasi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskEvaluationController extends Controller
{
    public function index()
    {
        // Get logged in student
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        // Get existing evaluations
        $evaluations = DeskEvaluasi::where('id_mahasiswa', $mahasiswa->id)
            ->with('dosen')
            ->get()
            ->keyBy('id_dosen');
            
        // Get all dosen for dropdown
        $allDosen = Dosen::all();
        
        return view('deskevaluasi', compact('mahasiswa', 'evaluations', 'allDosen'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|exists:dosen,id',
            'judul_ta' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);
        
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('desk_evaluations', $fileName, 'public');
        }
        
        // Create or update evaluation
        DeskEvaluasi::updateOrCreate(
            [
                'id_mahasiswa' => $mahasiswa->id,
                'id_dosen' => $request->id_dosen,
            ],
            [
                'judul_ta' => $request->judul_ta,
                'file' => $filePath,
            ]
        );
        
        return redirect()->route('desk-evaluation.index')->with('success', 'Desk evaluation submitted successfully!');
    }
    
    public function getDosen()
    {
        $dosen = Dosen::all();
        return response()->json($dosen);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\UsulDospem;
use App\Models\PendaftaranProposal;
use App\Models\NilaiBimbingan;
use App\Models\NilaiDe;
use App\Models\NilaiPresentasi;
use App\Models\NilaiLiteratur;
use App\Models\LogBimbingan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboardadmin', compact('pengajuanList'));
    }

    public function dashboard()
    {
        $pengajuanList = UsulDospem::with(['mahasiswa', 'dosen1', 'dosen2'])
            ->orderBy('created_at', 'desc')
            ->get();

        $mahasiswas = \App\Models\Mahasiswa::all();
        $dosens = \App\Models\Dosen::all();
        $assignments = \App\Models\PengujiAssignment::with(['mahasiswa', 'dosen'])->get();

        return view('dashboardadmin', compact('pengajuanList', 'mahasiswas', 'dosens', 'assignments'));
    }

    public function approve($id)
    {
        try {
            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'diterima';
            $usulan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembimbing berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $usulan = UsulDospem::findOrFail($id);
            $usulan->status = 'ditolak';
            $usulan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembimbing berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logbimbingan()
    {
        $logs = LogBimbingan::with(['mahasiswa', 'dosen'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        $dosen = \App\Models\Dosen::all();

        return view('dlogbimbingan', compact('logs', 'dosen'));
    }

    public function pendaftaranproposal()
    {
        $pendaftaranProposal = PendaftaranProposal::with(['mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dpendaftaranproposal', compact('pendaftaranProposal'));
    }

    public function nilaibimprota()
    {
        $nilaiBimbingan = NilaiBimbingan::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaibimprota', compact('nilaiBimbingan'));
    }

    public function nilaide()
    {
        $nilaiDeskEvaluasi = NilaiDe::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaide', compact('nilaiDeskEvaluasi'));
    }

    public function nilaipresentasita()
    {
        $nilaiPresentasi = NilaiPresentasi::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilaipresentasita', compact('nilaiPresentasi'));
    }

    public function nilailiteratur()
    {
        $nilaiLiteratur = NilaiLiteratur::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dnilailiteratur', compact('nilaiLiteratur'));
    }

    public function penguji()
    {
        // Get mahasiswa yang belum memiliki penguji aktif
        $mahasiswas = \App\Models\Mahasiswa::whereDoesntHave('pengujiAssignments', function($query) {
            $query->where('status', 'aktif');
        })->get();

        // Get semua dosen
        $dosens = \App\Models\Dosen::all();

        // Get penugasan penguji yang aktif dengan relasinya
        $assignments = \App\Models\PengujiAssignment::with(['mahasiswa', 'dosen'])
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dpenguji', compact('mahasiswas', 'dosens', 'assignments'));
    }

    public function storePenguji(Request $request)
    {
        try {
            $request->validate([
                'mahasiswa_id' => [
                    'required',
                    'exists:mahasiswa,id',
                    Rule::unique('penguji_assignments')->where(function ($query) {
                        return $query->where('status', 'aktif');
                    })
                ],
                'dosen_id' => [
                    'required',
                    'exists:dosen,id',
                    'different:mahasiswa_id'
                ],
            ], [
                'mahasiswa_id.unique' => 'Mahasiswa ini sudah memiliki dosen penguji yang aktif.',
                'dosen_id.different' => 'Dosen penguji tidak boleh sama dengan mahasiswa.',
            ]);

            // Nonaktifkan penugasan sebelumnya jika ada
            \App\Models\PengujiAssignment::where('mahasiswa_id', $request->mahasiswa_id)
                ->update(['status' => 'nonaktif']);

            // Buat penugasan baru
            \App\Models\PengujiAssignment::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'dosen_id' => $request->dosen_id,
                'status' => 'aktif'
            ]);

            return redirect()->route('admin.penguji')
                           ->with('success', 'Penguji berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.penguji')
                           ->withErrors($e->validator)
                           ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function updatePenguji(Request $request, $id)
    {
        try {
            $request->validate([
                'dosen_id' => 'sometimes|required|exists:dosens,id',
                'status' => 'sometimes|required|in:aktif,nonaktif'
            ]);

            $assignment = \App\Models\PengujiAssignment::findOrFail($id);

            if ($request->has('dosen_id')) {
                // Nonaktifkan penugasan lama
                $assignment->update(['status' => 'nonaktif']);

                // Buat penugasan baru
                \App\Models\PengujiAssignment::create([
                    'mahasiswa_id' => $assignment->mahasiswa_id,
                    'dosen_id' => $request->dosen_id,
                    'status' => 'aktif'
                ]);

                $message = 'Dosen penguji berhasil diperbarui';
            } else if ($request->has('status')) {
                // Update status saja
                $assignment->update(['status' => $request->status]);
                $message = 'Status penguji berhasil diperbarui';
            }

            return redirect()->route('admin.penguji')
                           ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyPenguji($id)
    {
        try {
            $assignment = \App\Models\PengujiAssignment::findOrFail($id);
            $assignment->delete();

            return redirect()->route('admin.penguji')
                           ->with('success', 'Penguji berhasil dihapus dari sistem');
        } catch (\Exception $e) {
            return redirect()->route('admin.penguji')
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function approveProposal($id)
    {
        try {
            $proposal = PendaftaranProposal::findOrFail($id);
            $proposal->status = 'diterima';
            $proposal->save();

            return response()->json([
                'success' => true,
                'message' => 'Proposal berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rejectProposal($id)
    {
        try {
            $proposal = PendaftaranProposal::findOrFail($id);
            $proposal->status = 'ditolak';
            $proposal->save();

            return response()->json([
                'success' => true,
                'message' => 'Proposal berhasil ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

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

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function storeUser(Request $request)
    {
        try {
            // Basic validation
            $validationRules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'in:admin,dosen,mahasiswa'],
            ];

            // Add role-specific validation rules
            if ($request->role === 'mahasiswa') {
                $validationRules['nim'] = ['required', 'string', 'max:20', 'unique:mahasiswa'];
                $validationRules['prodi'] = ['required', 'string', 'max:100'];
                $validationRules['angkatan'] = ['required', 'string', 'max:4'];
            } elseif ($request->role === 'dosen') {
                $validationRules['nip'] = ['required', 'string', 'max:20', 'unique:dosen'];
                $validationRules['bidang_keahlian'] = ['required', 'string', 'max:100'];
            }

            $request->validate($validationRules);

            // Begin transaction
            DB::beginTransaction();

            try {
                // Create user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);

                // Create corresponding record based on role
                if ($request->role === 'mahasiswa') {
                    \App\Models\Mahasiswa::create([
                        'user_id' => $user->id,
                        'nama' => $request->name,
                        'nim' => $request->nim,
                        'prodi' => $request->prodi,
                        'angkatan' => $request->angkatan
                    ]);
                } elseif ($request->role === 'dosen') {
                    \App\Models\Dosen::create([
                        'user_id' => $user->id,
                        'nama' => $request->name,
                        'nip' => $request->nip,
                        'bidang_keahlian' => $request->bidang_keahlian
                    ]);
                }

                DB::commit();

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User berhasil ditambahkan'
                    ]);
                }

                return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->route('admin.users')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan user: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.users')
                ->with('error', 'Gagal menambahkan user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'role' => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
                'password' => $request->filled('password') ? ['confirmed', Rules\Password::defaults()] : [],
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Begin transaction
            DB::beginTransaction();

            try {
                // Update user
                $user->update($data);

                // Handle role-specific data
                if ($request->role === 'mahasiswa') {
                    $mahasiswa = $user->mahasiswa ?? new \App\Models\Mahasiswa();
                    $mahasiswa->user_id = $user->id;
                    $mahasiswa->nama = $request->name;
                    $mahasiswa->save();

                    // Remove dosen record if exists
                    if ($user->dosen) {
                        $user->dosen->delete();
                    }
                } elseif ($request->role === 'dosen') {
                    $dosen = $user->dosen ?? new \App\Models\Dosen();
                    $dosen->user_id = $user->id;
                    $dosen->nama = $request->name;
                    $dosen->save();

                    // Remove mahasiswa record if exists
                    if ($user->mahasiswa) {
                        $user->mahasiswa->delete();
                    }
                } else {
                    // For admin role, remove both mahasiswa and dosen records if they exist
                    if ($user->mahasiswa) {
                        $user->mahasiswa->delete();
                    }
                    if ($user->dosen) {
                        $user->dosen->delete();
                    }
                }

                DB::commit();

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User berhasil diperbarui'
                    ]);
                }

                return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->route('admin.users')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui user: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.users')
                ->with('error', 'Gagal memperbarui user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyUser(User $user)
    {
        try {
            $user->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil dihapus'
                ]);
            }

            return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus user: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.users')
                ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }

    public function pembimbing()
    {
        $pembimbings = \App\Models\Pembimbing::with(['mahasiswa', 'dosen'])
            ->orderBy('created_at', 'desc')
            ->get();

        $mahasiswas = \App\Models\Mahasiswa::all();
        $dosens = \App\Models\Dosen::all();

        return view('admin.pembimbing.index', compact('pembimbings', 'mahasiswas', 'dosens'));
    }

    public function storePembimbing(Request $request)
    {
        try {
            $request->validate([
                'id_mahasiswa' => 'required|exists:mahasiswa,id',
                'id_dosen' => 'required|exists:dosen,id',
                'jenis_pembimbing' => 'required|in:1,2',
                'status' => 'required|in:aktif,nonaktif'
            ]);

            // Check if mahasiswa already has a pembimbing with the same jenis_pembimbing
            $existingPembimbing = \App\Models\Pembimbing::where('id_mahasiswa', $request->id_mahasiswa)
                ->where('jenis_pembimbing', $request->jenis_pembimbing)
                ->where('status', 'aktif')
                ->exists();

            if ($existingPembimbing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa sudah memiliki pembimbing ' . $request->jenis_pembimbing . ' yang aktif'
                ], 400);
            }

            $pembimbing = \App\Models\Pembimbing::create([
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_dosen' => $request->id_dosen,
                'jenis_pembimbing' => $request->jenis_pembimbing,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembimbing berhasil ditambahkan',
                'data' => $pembimbing
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePembimbing(Request $request, $id)
    {
        try {
            $request->validate([
                'id_dosen' => 'required|exists:dosen,id',
                'status' => 'required|in:aktif,nonaktif'
            ]);

            $pembimbing = \App\Models\Pembimbing::findOrFail($id);

            // If changing to aktif, check if there's already an active pembimbing
            if ($request->status === 'aktif' && $request->status !== $pembimbing->status) {
                $existingPembimbing = \App\Models\Pembimbing::where('id_mahasiswa', $pembimbing->id_mahasiswa)
                    ->where('jenis_pembimbing', $pembimbing->jenis_pembimbing)
                    ->where('status', 'aktif')
                    ->where('id', '!=', $id)
                    ->exists();

                if ($existingPembimbing) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Mahasiswa sudah memiliki pembimbing ' . $pembimbing->jenis_pembimbing . ' yang aktif'
                    ], 400);
                }
            }

            $pembimbing->update([
                'id_dosen' => $request->id_dosen,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil diperbarui',
                'data' => $pembimbing
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyPembimbing($id)
    {
        try {
            $pembimbing = \App\Models\Pembimbing::findOrFail($id);
            $pembimbing->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pembimbing berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
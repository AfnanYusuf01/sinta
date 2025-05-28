<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        // Update user's basic information
        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update role-specific information
        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if (!$mahasiswa) {
                $mahasiswa = new Mahasiswa();
                $mahasiswa->user_id = $user->id;
            }

            $mahasiswa->fill([
                'nim' => $validatedData['nim'],
                'nama' => $validatedData['name'],
                'prodi' => $validatedData['prodi'],
                'fakultas' => $validatedData['fakultas'],
                'angkatan' => $validatedData['angkatan'],
            ]);

            $mahasiswa->save();
        } elseif ($user->role === 'dosen') {
            $dosen = Dosen::where('user_id', $user->id)->first();
            if (!$dosen) {
                $dosen = new Dosen();
                $dosen->user_id = $user->id;
            }

            $dosen->fill([
                'nip' => $validatedData['nip'],
                'nama' => $validatedData['name'],
                'program_studi' => $validatedData['program_studi'],
                'bidang_keahlian' => $validatedData['bidang_keahlian'],
            ]);

            $dosen->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        Auth::logout();

        // Delete associated role-specific data
        if ($user->role === 'mahasiswa') {
            Mahasiswa::where('user_id', $user->id)->delete();
        } elseif ($user->role === 'dosen') {
            Dosen::where('user_id', $user->id)->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ];

        // Add role-specific validation rules
        if ($this->user()->role === 'mahasiswa') {
            $rules = array_merge($rules, [
                'nim' => ['required', 'string', 'max:20'],
                'prodi' => ['required', 'string', 'max:100'],
                'fakultas' => ['required', 'string', 'max:100'],
                'angkatan' => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            ]);
        } elseif ($this->user()->role === 'dosen') {
            $rules = array_merge($rules, [
                'nip' => ['required', 'string', 'max:20'],
                'program_studi' => ['required', 'string', 'max:100'],
                'bidang_keahlian' => ['required', 'string', 'max:100'],
            ]);
        }

        return $rules;
    }
}

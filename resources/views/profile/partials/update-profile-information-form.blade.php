@php
    $user = Auth::user();
    $mahasiswa = null;
    $dosen = null;

    if ($user->role === 'mahasiswa') {
        $mahasiswa = App\Models\Mahasiswa::where('user_id', $user->id)->first();
    } elseif ($user->role === 'dosen') {
        $dosen = App\Models\Dosen::where('user_id', $user->id)->first();
    }
@endphp

<section>
    <header>
        <h3 class="h4 mb-3">Informasi Profile</h3>
        <p class="text-muted mb-4">
            Update informasi profile dan alamat email anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Basic Information -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        Email anda belum terverifikasi.
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            Klik disini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            Link verifikasi baru telah dikirim ke email anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Foto Profile</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            @error('profile_picture')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        @if($user->role === 'mahasiswa')
        <!-- Mahasiswa Fields -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $mahasiswa ? $mahasiswa->nim : '') }}" required>
            @error('nim')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="prodi" name="prodi" value="{{ old('prodi', $mahasiswa ? $mahasiswa->prodi : '') }}" required>
            @error('prodi')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" class="form-control" id="fakultas" name="fakultas" value="{{ old('fakultas', $mahasiswa ? $mahasiswa->fakultas : '') }}" required>
            @error('fakultas')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan', $mahasiswa ? $mahasiswa->angkatan : '') }}" required>
            @error('angkatan')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        @elseif($user->role === 'dosen')
        <!-- Dosen Fields -->
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $dosen ? $dosen->nip : '') }}" required>
            @error('nip')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ old('program_studi', $dosen ? $dosen->program_studi : '') }}" required>
            @error('program_studi')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
            <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" value="{{ old('bidang_keahlian', $dosen ? $dosen->bidang_keahlian : '') }}" required>
            @error('bidang_keahlian')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>

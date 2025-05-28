@php
    $user = Auth::user();
@endphp

<section>
    <header>
        <h3 class="h4 mb-3">Hapus Akun</h3>
        <p class="text-muted mb-4">
            Setelah akun anda dihapus, semua sumber daya dan data akan dihapus secara permanen.
            Sebelum menghapus akun anda, harap unduh data atau informasi yang ingin anda simpan.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Hapus Akun
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">Apakah anda yakin ingin menghapus akun?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Setelah akun anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan password anda untuk mengkonfirmasi bahwa anda ingin menghapus akun anda secara permanen.
            </p>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
            </div>
        </form>
        </div>
    </div>
</section>

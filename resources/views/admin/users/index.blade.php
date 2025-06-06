@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User Management</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Add User Button -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Manajemen User</h4>
        <div>
            <a href="{{ route('admin.users.import') }}" class="btn btn-success me-2">
                <i class="fas fa-file-excel me-2"></i>Import Excel
            </a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus me-2"></i>Tambah User
        </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Daftar User
        </div>
        <div class="card-body">
            <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-user"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}"
                                    data-user-email="{{ $user->email }}"
                                    data-user-role="{{ $user->role }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-user"
                                    data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Error Messages -->
                    <div class="alert alert-danger d-none" id="addErrorMessages"></div>

                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="add_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="add_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="add_email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="add_role" class="form-label">Role</label>
                        <select class="form-select" id="add_role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>

                    <!-- Mahasiswa Fields -->
                    <div id="mahasiswa_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="add_nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="add_nim" name="nim">
                        </div>
                        <div class="mb-3">
                            <label for="add_prodi" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="add_prodi" name="prodi">
                        </div>
                        <div class="mb-3">
                            <label for="add_angkatan" class="form-label">Angkatan</label>
                            <input type="text" class="form-control" id="add_angkatan" name="angkatan">
                        </div>
                    </div>

                    <!-- Dosen Fields -->
                    <div id="dosen_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="add_nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="add_nip" name="nip">
                        </div>
                        <div class="mb-3">
                            <label for="add_bidang_keahlian" class="form-label">Bidang Keahlian</label>
                            <input type="text" class="form-control" id="add_bidang_keahlian" name="bidang_keahlian">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="add_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="add_password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="add_password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="add_password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Error Messages -->
                    <div class="alert alert-danger d-none" id="editErrorMessages"></div>

                    <div class="mb-3">
                        <label for="edit_name" class="form-label required">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                        <div class="invalid-feedback" id="edit_name_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label required">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                        <div class="invalid-feedback" id="edit_email_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label required">Role</label>
                        <select class="form-select" id="edit_role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                        <div class="invalid-feedback" id="edit_role_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit_password" name="password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleEditPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        <div class="invalid-feedback" id="edit_password_error"></div>
                    </div>
                    <div class="mb-3" id="password_confirmation_group">
                        <label for="edit_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                            <button class="btn btn-outline-secondary" type="button" id="toggleEditPasswordConfirm">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="edit_password_confirmation_error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
.required:after {
    content: " *";
    color: red;
}

.modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
}

.modal-body {
    padding: 20px;
}

.form-label {
    font-weight: 500;
}

.invalid-feedback {
    display: block;
}

.btn-outline-secondary:hover {
    background-color: var(--primary-light);
    border-color: var(--primary);
    color: white;
}

#password_confirmation_group {
    display: none;
}
</style>
@endsection

@section('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show success message if exists in session
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 1500,
            showConfirmButton: false
        });
    @endif

    // Show error message if exists in session
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}'
        });
    @endif

    const editUserForm = document.getElementById('editUserForm');
    const addUserForm = document.getElementById('addUserForm');
    const editNameInput = document.getElementById('edit_name');
    const editEmailInput = document.getElementById('edit_email');
    const editRoleSelect = document.getElementById('edit_role');
    const editPasswordInput = document.getElementById('edit_password');
    const editPasswordConfirmInput = document.getElementById('edit_password_confirmation');
    const passwordConfirmationGroup = document.getElementById('password_confirmation_group');
    const toggleEditPasswordBtn = document.getElementById('toggleEditPassword');
    const toggleEditPasswordConfirmBtn = document.getElementById('toggleEditPasswordConfirm');

    // Initialize DataTable
    $('#usersTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        }
    });

    // Handle Add User Form Submit
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan saat menambah user';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    const errorMessages = Object.values(errors).flat();
                    errorMessage = errorMessages.join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage
                });
            }
        });
    });

    // Toggle password visibility
    toggleEditPasswordBtn.addEventListener('click', function() {
        const type = editPasswordInput.type === 'password' ? 'text' : 'password';
        editPasswordInput.type = type;
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    toggleEditPasswordConfirmBtn.addEventListener('click', function() {
        const type = editPasswordConfirmInput.type === 'password' ? 'text' : 'password';
        editPasswordConfirmInput.type = type;
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    // Show/hide password confirmation based on password field
    editPasswordInput.addEventListener('input', function() {
        if (this.value) {
            passwordConfirmationGroup.style.display = 'block';
            editPasswordConfirmInput.required = true;
        } else {
            passwordConfirmationGroup.style.display = 'none';
            editPasswordConfirmInput.required = false;
            editPasswordConfirmInput.value = '';
        }
    });

    // Handle edit button click
    document.querySelectorAll('.edit-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.userName;
            const userEmail = this.dataset.userEmail;
            const userRole = this.dataset.userRole;

            // Reset form and clear errors
            editUserForm.reset();
            clearErrors();

            // Set form action URL
            editUserForm.action = `{{ route('admin.users.update', '') }}/${userId}`;

            // Set values
            editNameInput.value = userName;
            editEmailInput.value = userEmail;
            editRoleSelect.value = userRole;

            // Reset password fields
            editPasswordInput.value = '';
            editPasswordConfirmInput.value = '';
            passwordConfirmationGroup.style.display = 'none';
            editPasswordConfirmInput.required = false;
        });
    });

    // Handle delete button click
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.userName;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus user "${userName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        });
    });

    // Clear error messages and states
    function clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        const errorDiv = document.getElementById('editErrorMessages');
        errorDiv.classList.add('d-none');
        errorDiv.innerHTML = '';
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }

    // Handle edit form submission
    editUserForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        clearErrors();

        // Validate password confirmation if password is set
        if (editPasswordInput.value && editPasswordInput.value !== editPasswordConfirmInput.value) {
            editPasswordInput.classList.add('is-invalid');
            editPasswordConfirmInput.classList.add('is-invalid');
            document.getElementById('edit_password_error').textContent = 'Password dan konfirmasi password tidak cocok';
            return;
        }

        try {
            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Terjadi kesalahan saat memperbarui user');
            }

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data user berhasil diperbarui',
                timer: 1500,
                showConfirmButton: false
            });

            // Reload page
            window.location.reload();
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        }
    });

    // Handle role selection change
    $('#add_role').on('change', function() {
        const role = $(this).val();

        // Hide all role-specific fields first
        $('#mahasiswa_fields, #dosen_fields').hide();

        // Show fields based on selected role
        if (role === 'mahasiswa') {
            $('#mahasiswa_fields').show();
            $('#add_nim, #add_prodi, #add_angkatan').prop('required', true);
        } else if (role === 'dosen') {
            $('#dosen_fields').show();
            $('#add_nip, #add_bidang_keahlian').prop('required', true);
        }
    });

    // Reset form and hide role-specific fields when modal is closed
    $('#addUserModal').on('hidden.bs.modal', function() {
        $('#addUserForm')[0].reset();
        $('#mahasiswa_fields, #dosen_fields').hide();
        $('#add_nim, #add_prodi, #add_angkatan, #add_nip, #add_bidang_keahlian').prop('required', false);
    });
});
</script>
@endsection
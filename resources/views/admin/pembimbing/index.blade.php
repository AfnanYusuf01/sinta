@extends('layouts.admin')

@section('title', 'Management Pembimbing')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Management Pembimbing</h1>
    
    <!-- Add Pembimbing Button -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPembimbingModal">
            <i class="fas fa-user-plus"></i> Tambah Pembimbing
        </button>
    </div>

    <!-- Pembimbing Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Pembimbing
        </div>
        <div class="card-body">
            <table id="pembimbingTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $groupedPembimbing = $pembimbings->groupBy('id_mahasiswa');
                    @endphp
                    @foreach($groupedPembimbing as $id_mahasiswa => $group)
                        @php
                            $pembimbing1 = $group->firstWhere('jenis_pembimbing', '1');
                            $pembimbing2 = $group->firstWhere('jenis_pembimbing', '2');
                            $mahasiswa = $pembimbing1 ? $pembimbing1->mahasiswa : ($pembimbing2 ? $pembimbing2->mahasiswa : null);
                        @endphp
                        @if($mahasiswa)
                        <tr>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>
                                @if($pembimbing1)
                                    <span class="badge bg-primary">
                                        {{ $pembimbing1->dosen->nama }}
                                        @if($pembimbing1->status == 'nonaktif')
                                            (Nonaktif)
                                        @endif
                                    </span>
                                @else
                                    <span class="badge bg-secondary"> - </span>
                                @endif
                            </td>
                            <td>
                                @if($pembimbing2)
                                    <span class="badge bg-info">
                                        {{ $pembimbing2->dosen->nama }}
                                        @if($pembimbing2->status == 'nonaktif')
                                            (Nonaktif)
                                        @endif
                                    </span>
                                @else
                                    <span class="badge bg-secondary"> - </span>
                                @endif
                            </td>
                            <td>
                                @if(($pembimbing1 && $pembimbing1->status == 'aktif') || ($pembimbing2 && $pembimbing2->status == 'aktif'))
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                @if($pembimbing1)
                                <button type="button" class="btn btn-sm btn-warning edit-pembimbing" 
                                        data-id="{{ $pembimbing1->id }}"
                                        data-mahasiswa-id="{{ $pembimbing1->id_mahasiswa }}"
                                        data-dosen-id="{{ $pembimbing1->id_dosen }}"
                                        data-jenis="{{ $pembimbing1->jenis_pembimbing }}"
                                        data-status="{{ $pembimbing1->status }}">
                                    <i class="fas fa-edit"></i> P1
                                </button>
                                {{-- <button type="button" class="btn btn-sm btn-danger delete-pembimbing" 
                                        data-id="{{ $pembimbing1->id }}">
                                    <i class="fas fa-trash"></i> P1
                                </button> --}}
                                @endif
                                @if($pembimbing2)
                                <button type="button" class="btn btn-sm btn-warning edit-pembimbing" 
                                        data-id="{{ $pembimbing2->id }}"
                                        data-mahasiswa-id="{{ $pembimbing2->id_mahasiswa }}"
                                        data-dosen-id="{{ $pembimbing2->id_dosen }}"
                                        data-jenis="{{ $pembimbing2->jenis_pembimbing }}"
                                        data-status="{{ $pembimbing2->status }}">
                                    <i class="fas fa-edit"></i> P2
                                </button>
                                {{-- <button type="button" class="btn btn-sm btn-danger delete-pembimbing" 
                                        data-id="{{ $pembimbing2->id }}">
                                    <i class="fas fa-trash"></i> P2
                                </button> --}}
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Pembimbing Modal -->
<div class="modal fade" id="addPembimbingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addPembimbingForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_mahasiswa" class="form-label">Mahasiswa</label>
                        <select class="form-select" id="add_mahasiswa" name="id_mahasiswa" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_dosen" class="form-label">Dosen</label>
                        <select class="form-select" id="add_dosen" name="id_dosen" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nip }} - {{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_jenis" class="form-label">Jenis Pembimbing</label>
                        <select class="form-select" id="add_jenis" name="jenis_pembimbing" required>
                            <option value="">Pilih Jenis</option>
                            <option value="1">Pembimbing 1</option>
                            <option value="2">Pembimbing 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add_status" class="form-label">Status</label>
                        <select class="form-select" id="add_status" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
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

<!-- Edit Pembimbing Modal -->
<div class="modal fade" id="editPembimbingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPembimbingForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_mahasiswa" class="form-label">Mahasiswa</label>
                        <select class="form-select" id="edit_mahasiswa" disabled>
                            @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_dosen" class="form-label">Dosen</label>
                        <select class="form-select" id="edit_dosen" name="id_dosen" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nip }} - {{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jenis" class="form-label">Jenis Pembimbing</label>
                        <select class="form-select" id="edit_jenis" disabled>
                            <option value="1">Pembimbing 1</option>
                            <option value="2">Pembimbing 2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#pembimbingTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
        },
    });

    // Setup AJAX CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Pembimbing
    $('#addPembimbingForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("admin.pembimbing.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addPembimbingModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON?.message || 'Terjadi kesalahan!',
                });
            }
        });
    });

    // Edit Pembimbing
    $('.edit-pembimbing').on('click', function() {
        const id = $(this).data('id');
        const mahasiswaId = $(this).data('mahasiswa-id');
        const dosenId = $(this).data('dosen-id');
        const jenis = $(this).data('jenis');
        const status = $(this).data('status');

        $('#edit_id').val(id);
        $('#edit_mahasiswa').val(mahasiswaId);
        $('#edit_dosen').val(dosenId);
        $('#edit_jenis').val(jenis);
        $('#edit_status').val(status);

        $('#editPembimbingModal').modal('show');
    });

    $('#editPembimbingForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#edit_id').val();

        $.ajax({
            url: `/admin/pembimbing/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#editPembimbingModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON?.message || 'Terjadi kesalahan!',
                });
            }
        });
    });

    // Delete Pembimbing
    $('.delete-pembimbing').on('click', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pembimbing akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/pembimbing/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan!',
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection 
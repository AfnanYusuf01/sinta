@extends('layouts.admin')

@section('title', 'Pengelolaan Dosen Penguji')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-danger-800">
            <i class="fas fa-user-graduate me-2"></i>
            Pengelolaan Dosen Penguji
        </h1>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any()))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Tambah Penguji Card -->
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-header py-3 d-flex align-items-center bg-danger text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-user-plus me-2"></i>
                Tambah Penguji Baru
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.penguji.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mahasiswa_id" class="form-label fw-bold text-danger">
                                <i class="fas fa-user-graduate me-1"></i>
                                Pilih Mahasiswa
                            </label>
                            <select name="mahasiswa_id" id="mahasiswa_id"
                                class="form-select select2 @error('mahasiswa_id') is-invalid @enderror"
                                required data-placeholder="Cari mahasiswa...">
                                <option value=""></option>
                                @foreach($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                                        {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih mahasiswa yang akan ditambahkan pengujinya</small>
                            @error('mahasiswa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="dosen_id" class="form-label fw-bold text-danger">
                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                Pilih Dosen Penguji
                            </label>
                            <select name="dosen_id" id="dosen_id"
                                class="form-select select2 @error('dosen_id') is-invalid @enderror"
                                required data-placeholder="Cari dosen...">
                                <option value=""></option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama }} ({{ $dosen->nip ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih dosen yang akan menjadi penguji</small>
                            @error('dosen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="submit" class="btn btn-danger w-100 py-2">
                                <i class="fas fa-plus-circle me-1"></i>
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Penguji Card -->
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-header py-3 bg-danger text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-list me-2"></i>
                Daftar Penugasan Penguji
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-danger">
                        <tr>
                            <th width="50">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Dosen Penguji</th>
                            <th width="120">Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $index => $assignment)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $assignment->mahasiswa->nim ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-danger text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            {{ substr($assignment->mahasiswa->nama ?? '', 0, 1) }}
                                        </div>
                                        <span>{{ $assignment->mahasiswa->nama ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            {{ substr($assignment->dosen->nama ?? '', 0, 1) }}
                                        </div>
                                        <span>{{ $assignment->dosen->nama ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Aktif</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.penguji.destroy', $assignment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penugasan ini?\n\nMahasiswa: {{ $assignment->mahasiswa->nama }}\nDosen Penguji: {{ $assignment->dosen->nama }}\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada penugasan penguji</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
    }

    .empty-state i {
        display: block;
        margin-bottom: 1rem;
    }

    .form-select:focus, .select2-container--default .select2-selection--single:focus {
        border-color: #e74a3b;
        box-shadow: 0 0 0 0.25rem rgba(231, 74, 59, 0.25);
    }

    .text-danger-800 {
        color: #6c1d12;
    }

    .bg-danger {
        background-color: #e74a3b !important;
    }

    .table-danger {
        background-color: #e74a3b;
        color: white;
    }

    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }

    .badge.bg-danger {
        background-color: #e74a3b !important;
    }

    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #e74a3b;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #f8d7da;
        color: #721c24;
    }

    .form-label {
        margin-bottom: 0.5rem;
    }

    .form-text {
        font-size: 0.875rem;
    }

    .btn-danger {
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            "order": [[0, "asc"]],
            "pageLength": 10,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>
@endsection
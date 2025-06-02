@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page_title', 'Dashboard Admin')

@section('styles')
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table > :not(caption) > * > * {
        padding: 0.75rem;
        vertical-align: middle;
    }
    
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
    }
    
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .table th {
        background-color: #f8f9fc;
        font-weight: 600;
    }

    /* SweetAlert2 Custom Styles */
    .swal2-popup {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .swal2-title {
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .swal2-content {
        font-size: 1rem;
    }
    
    .swal2-confirm {
        background-color: var(--primary) !important;
    }
    
    .swal2-deny {
        background-color: var(--danger) !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Admin</h1>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $totalPengajuan }}</h3>
                            <div>Total Pengajuan</div>
                        </div>
                        <div>
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $menungguCount }}</h3>
                            <div>Menunggu</div>
                        </div>
                        <div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $diterimaCount }}</h3>
                            <div>Disetujui</div>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $ditolakCount }}</h3>
                            <div>Ditolak</div>
                        </div>
                        <div>
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Pembimbing Table -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Daftar Pengajuan Pembimbing yang Menunggu Persetujuan
                </div>
                <div>
                    <span class="badge bg-warning">{{ $menungguCount }} Pengajuan Menunggu</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pengajuanTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Judul TA</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuanList as $index => $pengajuan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pengajuan->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $pengajuan->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $pengajuan->mahasiswa->nim ?? '-' }}</td>
                            <td>{{ $pengajuan->judul_ta }}</td>
                            <td>{{ $pengajuan->dosen1->nama ?? '-' }}</td>
                            <td>{{ $pengajuan->dosen2->nama ?? '-' }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" onclick="handleApprove({{ $pengajuan->id }})" title="Setujui">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="handleReject({{ $pengajuan->id }})" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Tidak ada pengajuan pembimbing yang menunggu persetujuan
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

@section('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#pengajuanTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[1, 'desc']], // Sort by tanggal pengajuan descending
            "pageLength": 10,
            "columnDefs": [
                { "orderable": false, "targets": 7 } // Disable sorting on action column
            ]
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Show error message if exists
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        @endif
    });

    async function handleApprove(id) {
        const result = await Swal.fire({
            title: 'Konfirmasi Persetujuan',
            text: 'Apakah Anda yakin ingin menyetujui pengajuan pembimbing ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            reverseButtons: true
        });

        if (result.isConfirmed) {
            try {
                const response = await fetch(`/admin/pengajuanpembimbing/approve/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    location.reload();
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan saat menyetujui pengajuan',
                    showConfirmButton: true
                });
            }
        }
    }

    async function handleReject(id) {
        const result = await Swal.fire({
            title: 'Konfirmasi Penolakan',
            text: 'Apakah Anda yakin ingin menolak pengajuan pembimbing ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            confirmButtonColor: '#dc3545'
        });

        if (result.isConfirmed) {
            try {
                const response = await fetch(`/admin/pengajuanpembimbing/reject/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    location.reload();
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan saat menolak pengajuan',
                    showConfirmButton: true
                });
            }
        }
    }
</script>
@endsection
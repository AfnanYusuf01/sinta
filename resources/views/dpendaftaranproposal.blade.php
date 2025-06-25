@extends('layouts.admin')

@section('title', 'Pendaftaran Proposal')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark mb-1">Pendaftaran Proposal</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboardadmin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pendaftaran Proposal</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            {{-- <button class="btn btn-primary" onclick="exportToExcel()">
                <i class="fas fa-download me-2"></i>Export Data
            </button> --}}
            <button class="btn btn-success" onclick="refreshData()">
                <i class="fas fa-sync-alt me-2"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Proposal</h6>
                        <h3 class="mb-0">{{ $pendaftaranProposal->count() }}</h3>
                    </div>
                    <div class="stats-icon bg-primary">
                        <i class="fas fa-file-alt text-white fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Menunggu Review</h6>
                        <h3 class="mb-0">{{ $pendaftaranProposal->where('status', 'menunggu')->count() }}</h3>
                    </div>
                    <div class="stats-icon bg-warning">
                        <i class="fas fa-clock text-white fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Proposal Diterima</h6>
                        <h3 class="mb-0">{{ $pendaftaranProposal->where('status', 'diterima')->count() }}</h3>
                    </div>
                    <div class="stats-icon bg-success">
                        <i class="fas fa-check-circle text-white fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Proposal Ditolak</h6>
                        <h3 class="mb-0">{{ $pendaftaranProposal->where('status', 'ditolak')->count() }}</h3>
                    </div>
                    <div class="stats-icon bg-danger">
                        <i class="fas fa-times-circle text-white fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card">
        <div class="card-body">
            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="statusFilter" class="form-label">Filter Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dateFilter" class="form-label">Filter Tanggal</label>
                        <input type="date" class="form-control" id="dateFilter">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="search" class="form-label">Pencarian</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" placeholder="Cari berdasarkan nama atau judul...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover" id="proposalTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Judul Proposal</th>
                            <th>Pembimbing</th>
                            <th>Status</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaranProposal as $index => $proposal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $proposal->created_at->format('d M Y') }}</td>
                            <td>{{ $proposal->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $proposal->mahasiswa->nim ?? '-' }}</td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 300px;" title="{{ $proposal->judul_ta }}">
                                    {{ $proposal->judul_ta }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <small class="text-muted">Pembimbing 1:</small>
                                    <span>{{ $proposal->dosen1->nama ?? '-' }}</span>
                                    @if($proposal->dosen2)
                                        <small class="text-muted mt-1">Pembimbing 2:</small>
                                        <span>{{ $proposal->dosen2->nama }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'menunggu' => 'bg-warning',
                                        'diterima' => 'bg-success',
                                        'ditolak' => 'bg-danger'
                                    ][$proposal->status] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($proposal->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- <button class="btn btn-sm btn-info" onclick="showDetail({{ $proposal->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                    @if($proposal->status === 'menunggu')
                                    <button class="btn btn-sm btn-success" onclick="approveProposal({{ $proposal->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectProposal({{ $proposal->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Informasi Mahasiswa</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td id="modalNama">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIM</td>
                                <td id="modalNim">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Program Studi</td>
                                <td id="modalProdi">-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Informasi Pengajuan</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="text-muted">Tanggal Pengajuan</td>
                                <td id="modalTanggal">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td id="modalStatus">-</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h6 class="text-primary mb-3">Detail Proposal</h6>
                    <div class="mb-3">
                        <label class="text-muted">Judul Proposal:</label>
                        <p id="modalJudul" class="mb-0">-</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Abstrak:</label>
                        <p id="modalAbstrak" class="mb-0">-</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="text-primary mb-3">Dosen Pembimbing</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Pembimbing 1</h6>
                                    <p class="card-text" id="modalDosen1">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Pembimbing 2</h6>
                                    <p class="card-text" id="modalDosen2">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_styles')
<style>
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .btn-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .modal-header {
        background-color: var(--primary);
        color: white;
    }

    .modal-title {
        font-weight: 600;
    }

    .btn-close {
        filter: brightness(0) invert(1);
    }

    .text-primary {
        color: var(--primary) !important;
    }

    .form-label {
        font-weight: 500;
        color: var(--gray-700);
    }
</style>
@endsection

@section('scripts')
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#proposalTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
            order: [[1, 'desc']]
        });
    });

    // Show proposal detail
    async function showDetail(id) {
        try {
            const response = await fetch(`/admin/pendaftaran-proposal/${id}`);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();

            // Update modal content
            document.getElementById('modalNama').textContent = data.mahasiswa?.nama || '-';
            document.getElementById('modalNim').textContent = data.mahasiswa?.nim || '-';
            document.getElementById('modalProdi').textContent = data.mahasiswa?.prodi || '-';
            document.getElementById('modalTanggal').textContent = new Date(data.created_at).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('modalStatus').textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
            document.getElementById('modalJudul').textContent = data.judul_ta;
            document.getElementById('modalAbstrak').textContent = data.abstrak;
            document.getElementById('modalDosen1').textContent = data.dosen1?.nama || '-';
            document.getElementById('modalDosen2').textContent = data.dosen2?.nama || '-';

            // Show modal
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data');
        }
    }

    // Approve proposal
    async function approveProposal(id) {
        if (!confirm('Apakah Anda yakin ingin menyetujui proposal ini?')) return;

        try {
            const response = await fetch(`/admin/pendaftaranproposal/approve/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Failed to approve proposal');
            
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyetujui proposal');
        }
    }

    // Reject proposal
    async function rejectProposal(id) {
        if (!confirm('Apakah Anda yakin ingin menolak proposal ini?')) return;

        try {
            const response = await fetch(`/admin/pendaftaranproposal/reject/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Failed to reject proposal');
            
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menolak proposal');
        }
    }

    // Export to Excel
    function exportToExcel() {
        // Implement export functionality
        alert('Fitur export akan segera tersedia');
    }

    // Refresh data
    function refreshData() {
        location.reload();
    }
</script>
@endsection
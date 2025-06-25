@extends('layouts.admin')

@section('title', 'Rekap Log Bimbingan')

@section('page_title', 'Rekap Log Bimbingan')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark mb-1">Rekap Log Bimbingan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboardadmin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Log Bimbingan</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            {{-- <button class="btn btn-primary" onclick="exportData()">
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
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $logs->total() }}</h3>
                            <div>Total Bimbingan</div>
                        </div>
                        <div>
                            <i class="fas fa-clipboard-list fa-2x"></i>
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
                            <h3 class="mb-0">{{ $logs->whereNotNull('nilai')->count() }}</h3>
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
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $logs->whereNull('nilai')->count() }}</h3>
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
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $dosen->count() }}</h3>
                            <div>Total Dosen</div>
                        </div>
                        <div>
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-2"></i>Daftar Log Bimbingan
                </h6>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.logbimbingan') }}" method="GET" class="mb-4">
                <div class="filters">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="form-control" name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari mahasiswa, NIM, atau dosen...">
                    </div>
                    <div>
                        <select class="form-select" name="dosen_id">
                            <option value="">Semua Dosen</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->id }}" {{ request('dosen_id') == $d->id ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="date" class="form-control" name="start_date"
                               value="{{ request('start_date') }}"
                               placeholder="Tanggal Mulai">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="logTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Dosen</th>
                            <th>Materi Bimbingan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $log->nama_mahasiswa }}</td>
                                <td>{{ $log->nim }}</td>
                                <td>{{ $log->nama_dosen }}</td>
                                <td>{{ $log->catatan }}</td>
                                <td>
                                    @if($log->nilai !== null)
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-warning">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 text-muted d-block"></i>
                                    <p class="text-muted">Tidak ada data log bimbingan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $logs->firstItem() ?? 0 }} sampai {{ $logs->lastItem() ?? 0 }}
                    dari {{ $logs->total() }} data
                </div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_styles')
<style>
    .filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-box {
        position: relative;
    }

    .search-box .form-control {
        padding-left: 35px;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .table thead th {
        background-color: var(--gray-100);
        color: var(--gray-800);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
        background-color: var(--gray-100);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        color: var(--primary);
        border-color: var(--gray-300);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .breadcrumb {
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: var(--gray-600);
    }

    .card {
        border: none;
        margin-bottom: 1.5rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
</style>
@endsection

@section('scripts')
<script>
    // Auto-submit form when date inputs change
    document.querySelectorAll('input[type="date"], select').forEach(input => {
        input.addEventListener('change', () => {
            input.closest('form').submit();
        });
    });

    // Initialize DataTable
    $(document).ready(function() {
        $('#logTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[1, 'desc']], // Sort by date descending
            "pageLength": 10,
            "searching": false, // Disable built-in search as we have our own
            "dom": '<"top"i>rt<"bottom"p><"clear">' // Only show info, table, and pagination
        });
    });

    function exportData() {
        // Add export functionality
        alert('Export functionality will be implemented here');
    }

    function refreshData() {
        location.reload();
    }
</script>
@endsection
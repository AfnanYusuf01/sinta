@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page_title', 'Dashboard Admin')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ count($mahasiswas) }}</h3>
                    <p>Total Mahasiswa</p>
                </div>
            </div>
        </div>
      </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="stat-icon">
              <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ count($dosens) }}</h3>
                    <p>Total Dosen</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ count($assignments) }}</h3>
                    <p>Penguji Ditugaskan</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card bg-warning text-white">
            <div class="card-body">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pengajuanList->where('status', 'menunggu')->count() }}</h3>
                    <p>Menunggu Persetujuan</p>
                </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rekap Pengajuan Pembimbing -->
<div class="card custom-card mb-4">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list-alt me-2"></i>
                Rekap Pengajuan Pembimbing
            </h5>
            <div class="btn-group">
                <button class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-download me-1"></i> Export
            </button>
                <button class="btn btn-primary btn-sm ms-2">
                    <i class="fas fa-plus me-1"></i> Tambah Data
            </button>
          </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover custom-table mb-0">
                <thead class="table-light">
              <tr>
                <th>Nama Mahasiswa</th>
                <th>Judul Tugas Akhir</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Status</th>
                        <th width="150">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pengajuanList as $pengajuan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary text-white rounded-circle me-2">
                                    {{ substr($pengajuan->mahasiswa->nama ?? '', 0, 2) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $pengajuan->mahasiswa->nama ?? '' }}</div>
                                    <small class="text-muted">{{ $pengajuan->mahasiswa->nim ?? '' }}</small>
                    </div>
                  </div>
                </td>
                        <td>
                            <div class="text-wrap" style="max-width: 300px;">
                                {{ $pengajuan->judul_ta }}
                            </div>
                        </td>
                <td>{{ $pengajuan->dosen1->nama ?? '' }}</td>
                <td>{{ $pengajuan->dosen2->nama ?? '-' }}</td>
                <td>
                            @if($pengajuan->status === 'menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($pengajuan->status === 'diterima')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($pengajuan->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                    @if($pengajuan->status === 'menunggu')
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-success" onclick="handleAction('approve', {{ $pengajuan->id }}, this)">
                                        <i class="fas fa-check"></i>
                        </button>
                                    <button class="btn btn-danger" onclick="handleAction('reject', {{ $pengajuan->id }}, this)">
                                        <i class="fas fa-times"></i>
                        </button>
                      </div>
                    @endif
                </td>
              </tr>
              @empty
              <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada pengajuan pembimbing</p>
                            </div>
                        </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
          </div>
          </div>

<!-- Pengelolaan Dosen Penguji Section -->
<div class="card custom-card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-user-tie me-2"></i>
                Pengelolaan Dosen Penguji
            </h5>
        </div>
      </div>

    <div class="card-body">
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

        @if($errors->any())
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

        <!-- Form Tambah Penguji -->
        <div class="card bg-light mb-4">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Penguji Baru
                </h6>
                <form action="{{ route('admin.penguji.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-5">
                        <select name="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ old('mahasiswa_id') == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mahasiswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <select name="dosen_id" class="form-select @error('dosen_id') is-invalid @enderror" required>
                            <option value="">Pilih Dosen Penguji</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
  </div>

        <!-- Tabel Daftar Penguji -->
        <div class="table-responsive">
            <table class="table table-hover custom-table mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Dosen Penguji</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments ?? [] as $index => $assignment)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-info text-white rounded-circle me-2">
                                        {{ substr($assignment->mahasiswa->nama ?? '', 0, 2) }}
                                    </div>
                                    <span>{{ $assignment->mahasiswa->nama ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('admin.penguji.update', $assignment->id ?? '') }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="dosen_id" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                        @foreach($dosens ?? [] as $dosen)
                                            <option value="{{ $dosen->id }}" {{ ($dosen->id == ($assignment->dosen_id ?? '')) ? 'selected' : '' }}>
                                                {{ $dosen->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.penguji.destroy', $assignment->id ?? '') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada penguji yang ditugaskan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_styles')
<style>
    /* Card Styles */
    .custom-card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,.08);
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 1px solid #eee;
        padding: 1rem 1.25rem;
    }

    /* Statistics Cards */
    .stat-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,.08);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-content h3 {
        font-size: 1.75rem;
        margin-bottom: 0.25rem;
    }

    .stat-content p {
        margin-bottom: 0;
        opacity: 0.9;
    }

    /* Table Styles */
    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8125rem;
        padding: 0.75rem;
    }

    .custom-table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    /* Avatar */
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    /* Empty State */
    .empty-state {
        padding: 2rem;
        text-align: center;
    }

    /* Form Controls */
    .form-select, .form-control {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }

    .form-select:focus, .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    /* Buttons */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.4rem;
    }

    /* Alert Styles */
    .alert {
        border: none;
        border-radius: 0.5rem;
        padding: 1rem;
    }

    .alert-dismissible .btn-close {
        padding: 1.25rem;
    }

    /* Badge Styles */
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
</style>
@endsection

@section('scripts')
<script>
    async function handleAction(action, id, button) {
      try {
        const confirmMessage = action === 'approve'
          ? 'Apakah anda yakin ingin menyetujui pengajuan pembimbing ini?'
          : 'Apakah anda yakin ingin menolak pengajuan pembimbing ini?';

        if (!confirm(confirmMessage)) {
          return;
        }

        button.disabled = true;
            const loadingClass = action === 'approve' ? 'btn-success' : 'btn-danger';
            const originalContent = button.innerHTML;
            button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            button.classList.add('disabled');

        const response = await fetch(`/pengajuanpembimbing/${action}/${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          }
        });

        const data = await response.json();

        if (response.ok) {
                // Show success toast
                const toast = document.createElement('div');
                toast.className = 'position-fixed bottom-0 end-0 p-3';
                toast.style.zIndex = '9999';
                toast.innerHTML = `
                    <div class="toast show align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                <i class="fas fa-check-circle me-2"></i>
                                ${data.message || 'Status berhasil diperbarui'}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);

                // Reload the page
          window.location.reload();
        } else {
          throw new Error(data.message || 'Terjadi kesalahan saat memproses pengajuan');
        }

      } catch (error) {
            // Show error toast
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            ${error.message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);

            // Reset button state
        button.disabled = false;
            button.innerHTML = originalContent;
            button.classList.remove('disabled');
        }
    }

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>
@endsection
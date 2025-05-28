@extends('layouts.admin')

@section('title', 'Rekap Log Bimbingan')

@section('page_title', 'Rekap Log Bimbingan')

@section('content')
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Rekap Log Bimbingan</h4>
    </div>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.logbimbingan') }}" method="GET">
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
          <input type="date" class="form-control" name="end_date"
                 value="{{ request('end_date') }}"
                 placeholder="Tanggal Akhir">
        </div>
        <div>
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-filter me-2"></i>Filter
          </button>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Mahasiswa</th>
            <th>NIM</th>
            <th>Dosen</th>
            <th>Materi Bimbingan</th>
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
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-4">
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
@endsection

@section('additional_styles')
<style>
  .filters {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
  }

  .form-control, .form-select {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px 12px;
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
</script>
@endsection
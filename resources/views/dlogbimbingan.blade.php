<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Log Bimbingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #E30613;
            --primary-dark: #c00511;
            --primary-light: #FF6B74;
            --secondary: #1A1A2E;
            --text-dark: #2D3748;
            --text-light: #FFFFFF;
            --bg-light: #F8F9FA;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .card-body {
            padding: 20px;
        }

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

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--primary);
            color: white;
            font-weight: 500;
        }

        .table td {
            vertical-align: middle;
        }

        .pagination {
            margin: 0;
            padding: 20px;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
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

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: #f8f9fa;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .back-button i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <a href="{{ url('/dashboardadmin') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Rekap Log Bimbingan</h4>
                    <a href="{{ route('rekap.logbimbingan.export') }}" class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Export Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('rekap.logbimbingan') }}" method="GET">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-submit form when date inputs change
        document.querySelectorAll('input[type="date"], select').forEach(input => {
            input.addEventListener('change', () => {
                input.closest('form').submit();
            });
        });
    </script>
</body>
</html>
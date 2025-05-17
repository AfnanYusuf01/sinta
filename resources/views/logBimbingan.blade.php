<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Bimbingan Tugas Akhir - SINTA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #E30613;
            --secondary-color: #c00511;
            --light-gray: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding-top: 20px;
        }
        
        /* Style untuk tombol kembali ke beranda (warna abu-abu) */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 20px;
            background-color: #f8f9fa; /* Warna abu-abu muda */
            color: #495057; /* Warna teks abu-abu gelap */
            border: 1px solid #dee2e6; /* Border abu-abu */
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .back-button i {
            margin-right: 8px;
            transition: all 0.3s ease;
            color: #6c757d; /* Warna icon abu-abu */
        }

        .back-button:hover {
            background-color: #e9ecef; /* Warna abu-abu sedikit lebih gelap saat hover */
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #ced4da;
            text-decoration: none;
        }

        .back-button:hover i {
            transform: translateX(-3px);
            color: #495057;
        }

        /* Responsive adjustments untuk tombol kembali */
        @media (max-width: 768px) {
            .back-button {
                padding: 8px 16px;
                font-size: 0.9rem;
                margin: 15px 10px;
            }
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 30px;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-outline-secondary {
            border-color: #6c757d;
        }
        
        .table th {
            background-color: var(--light-gray);
            font-weight: 600;
        }
        
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        
        .badge-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .form-label {
            font-weight: 500;
        }
        
        .riwayat-title {
            border-left: 4px solid var(--primary-color);
            padding-left: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .btn-back {
            margin-bottom: 20px;
        }
        
        .detail-content {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Kembali ke Beranda -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/') }}" class="back-button">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Log Bimbingan -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-plus-circle me-2"></i>Form Log Bimbingan
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('log-bimbingan.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal Bimbingan</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-6">
                            <label for="id_dosen" class="form-label">Dosen Pembimbing</label>
                            <select class="form-select" id="id_dosen" name="id_dosen" required>
                                <option value="" selected disabled>Pilih Dosen Pembimbing</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Materi Bimbingan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="4" required placeholder="Deskripsikan materi yang dibahas dalam bimbingan ini"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Log Bimbingan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Riwayat Bimbingan -->
        <h4 class="riwayat-title">Riwayat Bimbingan</h4>
        
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history me-2"></i>Daftar Bimbingan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Tanggal</th>
                                <th width="20%">Pembimbing</th>
                                <th width="40%">Materi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $key => $log)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}</td>
                                    <td>{{ $log->dosen->nama }}</td>
                                    <td>{{ Str::limit($log->catatan, 50) }}</td>
                                    <td>
                                        @if($log->nilai !== null)
                                            <span class="badge badge-approved badge-status">Disetujui</span>
                                        @else
                                            <span class="badge badge-pending badge-status">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="Detail" data-bs-toggle="collapse" data-bs-target="#detail{{ $log->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="p-0">
                                        <div class="collapse" id="detail{{ $log->id }}">
                                            <div class="detail-content">
                                                <h6>Detail Bimbingan</h6>
                                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}</p>
                                                <p><strong>Pembimbing:</strong> {{ $log->dosen->nama }}</p>
                                                <p><strong>Materi:</strong> {{ $log->catatan }}</p>
                                                <p><strong>Status:</strong> 
                                                    @if($log->nilai !== null)
                                                        <span class="badge badge-approved badge-status">Disetujui</span>
                                                    @else
                                                        <span class="badge badge-pending badge-status">Menunggu</span>
                                                    @endif
                                                </p>
                                                @if($log->nilai !== null)
                                                    <p><strong>Nilai:</strong> {{ $log->nilai }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada riwayat bimbingan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($logs->hasPages())
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            @if($logs->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $logs->previousPageUrl() }}">Sebelumnya</a>
                                </li>
                            @endif

                            @foreach($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $logs->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if($logs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $logs->nextPageUrl() }}">Selanjutnya</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Selanjutnya</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
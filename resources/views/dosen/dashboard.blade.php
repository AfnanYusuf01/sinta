<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #E30613;
            --primary-light: #FFEAEC;
            --primary-dark: #C00511;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: white;
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 20px;
            background-color: var(--primary);
            color: white;
        }

        .nav-link {
            color: #333;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .nav-link.active {
            background-color: var(--primary);
            color: white;
        }

        .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 8px;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .card-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #666;
            font-size: 0.9rem;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="sidebar-header">
                    <h4 class="mb-0"><i class="fas fa-user-tie me-2"></i>Dashboard Dosen</h4>
                </div>
                <div class="nav flex-column">
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link active">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                    <a href="{{ route('dosen.proposal-approval') }}" class="nav-link">
                        <i class="fas fa-file-signature"></i>Persetujuan Proposal
                    </a>
                    <a href="{{ route('nilai-bimbingan.index') }}" class="nav-link">
                        <i class="fas fa-star"></i>Nilai Bimbingan
                    </a>
                    <a href="{{ route('nilai-de.index') }}" class="nav-link">
                        <i class="fas fa-tasks"></i>Nilai Desk Evaluasi
                    </a>
                    <a href="{{ route('nilai-presentasi.index') }}" class="nav-link">
                        <i class="fas fa-presentation"></i>Nilai Presentasi
                    </a>
                    <a href="{{ route('nilai-literatur.index') }}" class="nav-link">
                        <i class="fas fa-book"></i>Nilai Literatur
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="nav-link">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 text-decoration-none text-dark">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="row mb-4">
                    <div class="col">
                        <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="text-muted">Berikut adalah ringkasan aktivitas Anda</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Proposal Card -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="position-relative d-inline-block">
                                    <i class="fas fa-file-signature card-icon"></i>
                                    @if($pendingProposals > 0)
                                        <span class="notification-badge">{{ $pendingProposals }}</span>
                                    @endif
                                </div>
                                <h5 class="card-title">Persetujuan Proposal</h5>
                                <p class="card-text">Terdapat {{ $pendingProposals }} proposal yang menunggu persetujuan</p>
                                <a href="{{ route('dosen.proposal-approval') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-right me-2"></i>Lihat Proposal
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bimbingan Card -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users card-icon"></i>
                                <h5 class="card-title">Mahasiswa Bimbingan</h5>
                                <p class="card-text">Anda membimbing {{ $totalMahasiswa }} mahasiswa</p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian Card -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-star card-icon"></i>
                                <h5 class="card-title">Penilaian</h5>
                                <p class="card-text">Terdapat {{ $pendingPenilaian }} penilaian yang belum diselesaikan</p>
                                <a href="{{ route('nilai-bimbingan.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-right me-2"></i>Input Nilai
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
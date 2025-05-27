<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD
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
=======
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #E30613;
      --primary-light: #FFEAEC;
      --primary-dark: #C00511;
      --gray-light: #f5f5f5;
      --gray-medium: #e5e5e5;
      --gray-dark: #333;
      --text: #333;
      --text-light: #666;
      --white: #fff;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: var(--text);
    }
    
    .dashboard-container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    
    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background-color: var(--white);
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar-header {
      padding: 20px;
      font-size: 1.25rem;
      font-weight: bold;
      color: var(--primary);
      border-bottom: 1px solid var(--gray-medium);
      display: flex;
      align-items: center;
    }
    
    .sidebar-header i {
      margin-right: 12px;
    }
    
    .sidebar-nav {
      padding: 10px 0;
    }
    
    .sidebar-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .sidebar-nav li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: var(--text);
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .sidebar-nav li a:hover {
      background-color: var(--primary-light);
      color: var(--primary);
    }
    
    .sidebar-nav li a i {
      margin-right: 12px;
      color: var(--text-light);
    }
    
    .sidebar-nav li a:hover i {
      color: var(--primary);
    }
    
    /* Main Content Styles */
    .main-content {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
    }
    
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
    
    .header h1 {
      font-size: 1.75rem;
      margin: 0;
    }
    
    .header h1 span {
      color: var(--primary);
    }
    
    .user-controls {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .notification-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: var(--primary-light);
      color: var(--primary);
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .notification-btn:hover {
      background-color: var(--primary);
      color: white;
    }
    
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: var(--primary-light);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    
    /* Card Styles */
    .card {
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 20px;
    }
    
    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .card-header h2 {
      font-size: 1.25rem;
      margin: 0;
    }
    
    .export-btn {
      color: var(--primary);
      font-size: 0.875rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: none;
      border: none;
      padding: 0;
    }
    
    .export-btn:hover {
      color: var(--primary-dark);
    }
    
    /* Table Styles */
    .table-container {
      overflow-x: auto;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead {
      background-color: var(--primary);
      color: white;
    }
    
    th {
      padding: 12px 16px;
      text-align: left;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    tbody tr {
      border-bottom: 1px solid var(--gray-medium);
      transition: background-color 0.3s ease;
    }
    
    tbody tr:hover {
      background-color: var(--primary-light);
    }
    
    td {
      padding: 16px;
      font-size: 0.875rem;
    }
    
    /* Pagination Styles */
    .pagination {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 16px;
      margin-top: 16px;
      border-top: 1px solid var(--gray-medium);
    }
    
    .pagination-info {
      font-size: 0.875rem;
      color: var(--text-light);
    }
    
    .pagination-info span {
      font-weight: 600;
    }
    
    .pagination-buttons {
      display: flex;
      gap: 8px;
    }
    
    .pagination-btn {
      padding: 8px 16px;
      border-radius: 6px;
      background-color: var(--primary);
      color: white;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 0.875rem;
    }
    
    .pagination-btn:hover {
      background-color: var(--primary-dark);
    }
    
    .pagination-btn:disabled {
      background-color: var(--gray-light);
      color: var(--text-light);
      cursor: not-allowed;
    }

    .dropdown {
  position: relative;
}

.dropdown-menu {
  display: none;
  position: absolute;
  left: 0;
  background-color: white;
  padding: 10px 0;
  list-style: none;
  border: 1px solid #ccc;
  z-index: 999;
  min-width: 250px;
}

.dropdown:hover .dropdown-menu {
  display: block;
}

.dropdown-menu li {
  padding: 5px 20px;
}

.dropdown-menu li a {
  text-decoration: none;
  color: #333;
  display: block;
}

.dropdown-menu li a:hover {
  background-color: #f0f0f0;
}

.user-avatar-container {
  position: relative;
  cursor: pointer;
}

.user-avatar-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: var(--white);
  border: 1px solid var(--gray-medium);
  border-radius: 4px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  z-index: 1000;
  min-width: 150px;
  margin-top: 8px;
}

.user-avatar-container:hover .user-avatar-dropdown {
  display: block;
}

.user-avatar-dropdown a {
  display: block;
  padding: 8px 16px;
  color: var(--text);
  text-decoration: none;
  transition: all 0.3s ease;
}

.user-avatar-dropdown a:hover {
  background-color: var(--primary-light);
  color: var(--primary);
}

  </style>
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <i class="fas fa-university"></i>
        <span>Admin Dashboard</span>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li>
            <a href="{{ url('/dashboardadmin') }}">
              <i class="fas fa-file-alt"></i>
              <span>Rekapan Pengajuan</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/dlogbimbingan') }}">
              <i class="fas fa-clipboard-list"></i>
              <span>Log Bimbingan</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/dpendaftaranproposal') }}">
              <i class="fas fa-file-signature"></i>
              <span>Pendaftaran Proposal</span>
            </a>
          </li>
          <li class="dropdown">
  <a href="#">
    <i class="fas fa-chalkboard-teacher"></i>
    <span>Penilaian Dosen</span>
    <i class="fas fa-caret-down"></i>
  </a>
  <ul class="dropdown-menu">
    <li><a href="{{ url('/dnilaibimprota') }}">Formulir Nilai Bimbingan Proposal TA</a></li>
    <li><a href="{{ url('/dnilaide') }}">Formulir Nilai Desk Evaluasi</a></li>
    <li><a href="{{ url('/dnilaipresentasita') }}">Formulir Nilai Presentasi Proposal TA</a></li>
    <li><a href="{{ url('/dnilailiteratur') }}">Formulir Nilai Literatur Review Proposal TA</a></li>
  </ul>
</li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="header">
        <h1>Selamat Datang, <span>Admin!</span></h1>
        <div class="user-controls">
          <button class="notification-btn">
            <i class="fas fa-bell"></i>
          </button>
          <div class="user-avatar-container">
            <div class="user-avatar">A</div>
            <div class="user-avatar-dropdown">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </div>

      <!-- Rekap Log Bimbingan -->
      <div class="card">
        <div class="card-header">
          <h2>Rekap Log Bimbingan</h2>
          <button class="export-btn">
            <i class="fas fa-download"></i>
            Export
          </button>
        </div>
        
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Mahasiswa</th>
                <th>Dosen Pembimbing</th>
                <th>Materi Bimbingan</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-05-10</td>
                <td>Andi Saputra</td>
                <td>Dr. Rina Marlina</td>
                <td>Revisi Bab 2 & 3</td>
                <td>Sudah diperbaiki dan disetujui</td>
              </tr>
              <tr>
                <td>2025-05-14</td>
                <td>Sinta Lestari</td>
                <td>Dr. Rina Marlina</td>
                <td>Diskusi Metodologi Penelitian</td>
                <td>Perlu revisi lanjutan</td>
              </tr>
              <tr>
                <td>2025-05-18</td>
                <td>Budi Santoso</td>
                <td>Dr. Rina Marlina</td>
                <td>Validasi instrumen</td>
                <td>Selesai</td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div class="pagination">
          <div class="pagination-info">
            Menampilkan <span>1</span> sampai <span>3</span> dari <span>3</span> hasil
          </div>
          <div class="pagination-buttons">
            <button class="pagination-btn" disabled>Sebelumnya</button>
            <button class="pagination-btn">Selanjutnya</button>
          </div>
        </div>
      </div>
    </main>
  </div>
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
</body>
</html>
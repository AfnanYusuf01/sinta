<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<<<<<<< HEAD
  <meta name="csrf-token" content="{{ csrf_token() }}">
=======
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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
      --success: #28a745;
      --danger: #dc3545;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: var(--text);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .dashboard-container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background-color: var(--white);
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .sidebar-header {
      padding: 20px;
      font-size: 1.25rem;
      font-weight: bold;
      color: var(--primary);
      border-bottom: 1px solid var(--gray-medium);
      display: flex;
      align-items: center;
    }
<<<<<<< HEAD

    .sidebar-header i {
      margin-right: 12px;
    }

    .sidebar-nav {
      padding: 10px 0;
    }

=======
    
    .sidebar-header i {
      margin-right: 12px;
    }
    
    .sidebar-nav {
      padding: 10px 0;
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .sidebar-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .sidebar-nav li a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: var(--text);
      text-decoration: none;
      transition: all 0.3s ease;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .sidebar-nav li a:hover {
      background-color: var(--primary-light);
      color: var(--primary);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .sidebar-nav li a i {
      margin-right: 12px;
      color: var(--text-light);
    }
<<<<<<< HEAD

    .sidebar-nav li a:hover i {
      color: var(--primary);
    }

=======
    
    .sidebar-nav li a:hover i {
      color: var(--primary);
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .badge {
      margin-left: auto;
      background-color: var(--primary);
      color: white;
      font-size: 0.75rem;
      font-weight: bold;
      padding: 2px 8px;
      border-radius: 10px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Main Content Styles */
    .main-content {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .header h1 {
      font-size: 1.75rem;
      margin: 0;
    }
<<<<<<< HEAD

    .header h1 span {
      color: var(--primary);
    }

=======
    
    .header h1 span {
      color: var(--primary);
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .user-controls {
      display: flex;
      align-items: center;
      gap: 15px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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
      position: relative;
      transition: all 0.3s ease;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .notification-btn:hover {
      background-color: var(--primary);
      color: white;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .notification-dot {
      position: absolute;
      top: 5px;
      right: 5px;
      width: 8px;
      height: 8px;
      background-color: red;
      border-radius: 50%;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Card Styles */
    .card {
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 20px;
      margin-bottom: 30px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .card-header h2 {
      font-size: 1.25rem;
      margin: 0;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .action-buttons {
      display: flex;
      gap: 10px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .btn {
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 0.875rem;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .btn-primary {
      background-color: var(--primary);
      color: white;
    }
<<<<<<< HEAD

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

=======
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .btn-outline {
      background-color: var(--primary-light);
      color: var(--primary);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .btn-outline:hover {
      background-color: var(--primary);
      color: white;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Table Styles */
    .table-container {
      overflow-x: auto;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    table {
      width: 100%;
      border-collapse: collapse;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    thead {
      background-color: var(--primary);
      color: white;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    th {
      padding: 12px 16px;
      text-align: left;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    tbody tr {
      border-bottom: 1px solid var(--gray-medium);
      transition: background-color 0.3s ease;
    }
<<<<<<< HEAD

    tbody tr:hover {
      background-color: var(--primary-light);
    }

=======
    
    tbody tr:hover {
      background-color: var(--primary-light);
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    td {
      padding: 16px;
      font-size: 0.875rem;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .user-avatar-sm {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: var(--primary-light);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      flex-shrink: 0;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .user-details {
      display: flex;
      flex-direction: column;
    }
<<<<<<< HEAD

    .user-name {
      font-weight: 600;
    }

=======
    
    .user-name {
      font-weight: 600;
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .user-id {
      font-size: 0.75rem;
      color: var(--text-light);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Action Button Styles */
    .action-btn {
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 0.75rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .approve-btn {
      background-color: var(--success);
      color: white;
    }
<<<<<<< HEAD

    .approve-btn:hover {
      background-color: #218838;
    }

=======
    
    .approve-btn:hover {
      background-color: #218838;
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .reject-btn {
      background-color: var(--danger);
      color: white;
    }
<<<<<<< HEAD

    .reject-btn:hover {
      background-color: #c82333;
    }

=======
    
    .reject-btn:hover {
      background-color: #c82333;
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .action-buttons-group {
      display: flex;
      gap: 8px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    /* Pagination Styles */
    .pagination {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 16px;
      margin-top: 16px;
      border-top: 1px solid var(--gray-medium);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .pagination-info {
      font-size: 0.875rem;
      color: var(--text-light);
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .pagination-buttons {
      display: flex;
      gap: 8px;
    }
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .pagination-btn {
      padding: 8px 16px;
      border-radius: 6px;
      background-color: var(--gray-light);
      color: var(--text);
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }
<<<<<<< HEAD

    .pagination-btn:hover {
      background-color: var(--gray-medium);
    }

=======
    
    .pagination-btn:hover {
      background-color: var(--gray-medium);
    }
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    .pagination-btn-primary {
      background-color: var(--primary);
      color: white;
    }
<<<<<<< HEAD

    .pagination-btn-primary:hover {
      background-color: var(--primary-dark);
    }

    /* Additional styles */
    .status-badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .status-menunggu {
      background-color: #fef3c7;
      color: #92400e;
    }

    .status-diterima {
      background-color: #d1fae5;
      color: #065f46;
    }

    .status-ditolak {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .action-taken {
      color: #6b7280;
      font-size: 0.875rem;
      font-style: italic;
    }
  </style>
=======
    
    .pagination-btn-primary:hover {
      background-color: var(--primary-dark);
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

/* Add this CSS inside the existing <style> tag */
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

.user-avatar-dropdown.show {
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

/* Add these styles to your existing CSS */
.status-badge {
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.status-approved {
    background-color: #d1e7dd;
    color: #0f5132;
    border: 1px solid #badbcc;
}

.status-rejected {
    background-color: #f8d7da;
    color: #842029;
    border: 1px solid #f5c2c7;
}

.status-badge i {
    font-size: 1rem;
}

.action-btn.delete-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.action-btn.delete-btn:hover {
    background-color: #bb2d3b;
}

.status-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}
  </style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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
              <span class="badge">3</span>
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
<<<<<<< HEAD
          <li>
            <a href="#">
              <i class="fas fa-chalkboard-teacher"></i>
              <span>Penilaian Dosen</span>
            </a>
          </li>
=======
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
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
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
<<<<<<< HEAD
            @if($pending_count > 0)
              <span class="notification-dot"></span>
            @endif
          </button>
          <div class="user-avatar">A</div>
=======
            <span class="notification-dot"></span>
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
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
        </div>
      </div>

      <!-- Rekap Pengajuan Pembimbing -->
      <div class="card">
        <div class="card-header">
          <h2>Rekap Pengajuan Pembimbing</h2>
          <div class="action-buttons">
<<<<<<< HEAD
            <button class="btn btn-outline" onclick="exportData()">
              <i class="fas fa-download"></i>
              Export
            </button>
          </div>
        </div>

=======
            <button class="btn btn-outline">
              <i class="fas fa-download"></i>
              Export
            </button>
            <button class="btn btn-primary">
              <i class="fas fa-plus"></i>
              Tambah Data
            </button>
          </div>
        </div>
        
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Nama Mahasiswa</th>
                <th>Judul Tugas Akhir</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Status</th>
<<<<<<< HEAD
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usulan as $item)
              <tr id="row-{{ $item->id }}">
                <td>
                  <div class="user-info">
                    <div class="user-avatar-sm">{{ substr($item->mahasiswa->nama, 0, 2) }}</div>
                    <div class="user-details">
                      <span class="user-name">{{ $item->mahasiswa->nama }}</span>
                      <span class="user-id">{{ $item->mahasiswa->nim }}</span>
                    </div>
                  </div>
                </td>
                <td>{{ $item->judul_ta }}</td>
                <td>{{ $item->dosen1->nama }}</td>
                <td>{{ $item->dosen2 ? $item->dosen2->nama : '-' }}</td>
                <td>
                  <span class="status-badge status-{{ $item->status }}">
                    {{ ucfirst($item->status) }}
                  </span>
                </td>
                <td>
                  @if($item->status === 'menunggu')
                  <div class="action-buttons-group">
                    <button class="action-btn approve-btn" onclick="updateStatus({{ $item->id }}, 'diterima')">
                      <i class="fas fa-check"></i> Setujui
                    </button>
                    <button class="action-btn reject-btn" onclick="updateStatus({{ $item->id }}, 'ditolak')">
                      <i class="fas fa-times"></i> Tolak
                    </button>
                  </div>
                  @else
                  <span class="action-taken">{{ $item->status === 'diterima' ? 'Disetujui' : 'Ditolak' }}</span>
=======
              </tr>
            </thead>
            <tbody>
              @foreach($pengajuanList ?? [] as $pengajuan)
              <tr>
                <td>
                  <div class="user-info">
                    <div class="user-avatar-sm">{{ substr($pengajuan->mahasiswa->nama ?? '', 0, 2) }}</div>
                    <div class="user-details">
                      <span class="user-name">{{ $pengajuan->mahasiswa->nama ?? '' }}</span>
                      <span class="user-id">{{ $pengajuan->mahasiswa->nim ?? '' }}</span>
                    </div>
                  </div>
                </td>
                <td>{{ $pengajuan->judul_ta }}</td>
                <td>{{ $pengajuan->dosen1->nama ?? '' }}</td>
                <td>{{ $pengajuan->dosen2->nama ?? '-' }}</td>
                <td>
                  @if($pengajuan->status === 'menunggu')
                    <div class="action-buttons-group">
                      <button class="action-btn approve-btn" type="button" data-id="{{ $pengajuan->id }}">
                        <i class="fas fa-check"></i> Setujui
                      </button>
                      <button class="action-btn reject-btn" type="button" data-id="{{ $pengajuan->id }}">
                        <i class="fas fa-times"></i> Tolak
                      </button>
                    </div>
                  @elseif($pengajuan->status === 'diterima')
                    <div class="status-badge status-approved">
                      <i class="fas fa-check-circle"></i> Disetujui
                    </div>
                  @elseif($pengajuan->status === 'ditolak')
                    <div class="status-badge status-rejected">
                      <i class="fas fa-times-circle"></i> Tidak Disetujui
                    </div>
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
<<<<<<< HEAD
=======
        
        <div class="pagination">
          <div class="pagination-info">
            Menampilkan <span>1</span> sampai <span>3</span> dari <span>3</span> hasil
          </div>
          <div class="pagination-buttons">
            <button class="pagination-btn">Sebelumnya</button>
            <button class="pagination-btn pagination-btn-primary">Selanjutnya</button>
          </div>
        </div>
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
      </div>
    </main>
  </div>

<<<<<<< HEAD
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function updateStatus(id, status) {
      if (!confirm('Apakah Anda yakin ingin ' + (status === 'diterima' ? 'menyetujui' : 'menolak') + ' pengajuan ini?')) {
        return;
      }

      $.ajax({
        url: `/dashboardadmin/update-status/${id}`,
        type: 'POST',
        data: { status: status },
        success: function(response) {
          if (response.success) {
            // Update UI
            const row = document.getElementById(`row-${id}`);
            const statusCell = row.cells[4];
            const actionCell = row.cells[5];

            statusCell.innerHTML = `<span class="status-badge status-${status}">${status === 'diterima' ? 'Diterima' : 'Ditolak'}</span>`;
            actionCell.innerHTML = `<span class="action-taken">${status === 'diterima' ? 'Disetujui' : 'Ditolak'}</span>`;

            // Show success message
            alert('Status berhasil diperbarui');

            // Reload page to update notification count
            location.reload();
          }
        },
        error: function() {
          alert('Terjadi kesalahan. Silakan coba lagi.');
        }
      });
    }

    function exportData() {
      // Implement export functionality here
      alert('Fitur export akan segera tersedia');
    }
=======
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const avatarContainer = document.querySelector('.user-avatar-container');
    const dropdown = document.querySelector('.user-avatar-dropdown');

    // Toggle dropdown on avatar click
    avatarContainer.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!avatarContainer.contains(e.target)) {
        dropdown.classList.remove('show');
      }
    });
  });
  </script>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle approve and reject actions
    const handleAction = async (action, id, button) => {
        try {
            const confirmMessage = action === 'approve' 
                ? 'Apakah anda yakin ingin menyetujui pengajuan pembimbing ini?'
                : 'Apakah anda yakin ingin menolak pengajuan pembimbing ini? Data akan dihapus dari sistem.';
                
            if (!confirm(confirmMessage)) {
                return;
            }

            // Disable the button while processing
            button.disabled = true;

            const response = await fetch(`/pengajuan-pembimbing/${action}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Terjadi kesalahan saat memproses pengajuan');
                }
                alert(data.message);
            } else {
                throw new Error('Server returned an invalid response');
            }
            
            // Reload the page to show updated status
            window.location.reload();

        } catch (error) {
            alert('Terjadi kesalahan: ' + error.message);
            // Re-enable the button if there's an error
            button.disabled = false;
        }
    };

    // Add click event listeners to approve buttons
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            handleAction('approve', id, this);
        });
    });

    // Add click event listeners to reject buttons
    document.querySelectorAll('.reject-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            handleAction('reject', id, this);
        });
    });
  });
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
  </script>
</body>
</html>
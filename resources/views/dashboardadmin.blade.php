<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    .badge {
      margin-left: auto;
      background-color: var(--primary);
      color: white;
      font-size: 0.75rem;
      font-weight: bold;
      padding: 2px 8px;
      border-radius: 10px;
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
      position: relative;
      transition: all 0.3s ease;
    }

    .notification-btn:hover {
      background-color: var(--primary);
      color: white;
    }

    .notification-dot {
      position: absolute;
      top: 5px;
      right: 5px;
      width: 8px;
      height: 8px;
      background-color: red;
      border-radius: 50%;
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
      margin-bottom: 30px;
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

    .action-buttons {
      display: flex;
      gap: 10px;
    }

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

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .btn-outline {
      background-color: var(--primary-light);
      color: var(--primary);
    }

    .btn-outline:hover {
      background-color: var(--primary);
      color: white;
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

    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }

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

    .user-details {
      display: flex;
      flex-direction: column;
    }

    .user-name {
      font-weight: 600;
    }

    .user-id {
      font-size: 0.75rem;
      color: var(--text-light);
    }

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

    .approve-btn {
      background-color: var(--success);
      color: white;
    }

    .approve-btn:hover {
      background-color: #218838;
    }

    .reject-btn {
      background-color: var(--danger);
      color: white;
    }

    .reject-btn:hover {
      background-color: #c82333;
    }

    .action-buttons-group {
      display: flex;
      gap: 8px;
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

    .pagination-buttons {
      display: flex;
      gap: 8px;
    }

    .pagination-btn {
      padding: 8px 16px;
      border-radius: 6px;
      background-color: var(--gray-light);
      color: var(--text);
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .pagination-btn:hover {
      background-color: var(--gray-medium);
    }

    .pagination-btn-primary {
      background-color: var(--primary);
      color: white;
    }

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
          <li>
            <a href="#">
              <i class="fas fa-chalkboard-teacher"></i>
              <span>Penilaian Dosen</span>
            </a>
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
            @if($pending_count > 0)
              <span class="notification-dot"></span>
            @endif
          </button>
          <div class="user-avatar">A</div>
        </div>
      </div>

      <!-- Rekap Pengajuan Pembimbing -->
      <div class="card">
        <div class="card-header">
          <h2>Rekap Pengajuan Pembimbing</h2>
          <div class="action-buttons">
            <button class="btn btn-outline" onclick="exportData()">
              <i class="fas fa-download"></i>
              Export
            </button>
          </div>
        </div>

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Nama Mahasiswa</th>
                <th>Judul Tugas Akhir</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Status</th>
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
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

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
  </script>
</body>
</html>
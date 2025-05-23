<!DOCTYPE html>
<html lang="id">
<head>
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
              <span>Rekapan Pengajuan Pembimbing</span>
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
          </button>
          <div class="user-avatar">A</div>
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
</body>
</html>
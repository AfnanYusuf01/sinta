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

    /* Eye icon styles */
    .eye-icon {
      color: var(--primary);
      cursor: pointer;
      font-size: 1.1rem;
      padding: 8px;
      display: inline-block;
    }

    .eye-icon:hover {
      color: var(--primary-dark);
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background-color: white;
      width: 80%;
      max-width: 800px;
      border-radius: 8px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      max-height: 80vh;
      overflow-y: auto;
    }

    .modal-header {
      padding: 16px 24px;
      border-bottom: 1px solid var(--gray-medium);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0;
    }

    .close-btn {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--text-light);
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: var(--primary);
    }

    .modal-body {
      padding: 24px;
    }

    .modal-table {
      width: 100%;
      border-collapse: collapse;
    }

    .modal-table thead th {
      padding: 12px 16px;
      background-color: var(--primary);
      color: white;
      text-align: left;
      font-weight: 600;
    }

    .modal-table tbody td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--gray-medium);
    }

    .modal-table tbody tr:hover {
      background-color: var(--primary-light);
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
              <span>Nilai Literatur Review Proposal TA</span>
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
          <h2>Nilai Literatur Review Proposal TA</h2>
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
                <th>Dosen Pembimbing 1</th>
                <th>Dosen Pembimbing 2</th>
                <th>Total Nilai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($nilaiLiteratur as $nilai)
              <tr>
                <td>{{ $nilai->created_at->format('Y-m-d') }}</td>
                <td>{{ $nilai->mahasiswa->nama }}</td>
                <td>{{ $nilai->dosen->nama }}</td>
                <td>{{ $nilai->total_nilai }}</td>
                <td>
                  <i class="fas fa-eye eye-icon" onclick="showNilaiLiteratur({{ $nilai->id }})"></i>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal" id="scoreModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Detail Nilai Literatur Review Proposal TA</h3>
        <button class="close-btn" onclick="hideModal()">&times;</button>
      </div>
      <div class="modal-body">
        <div style="margin-bottom: 20px;">
          <h4 style="margin: 0 0 10px 0;">Mahasiswa: <span id="modalStudentName"></span></h4>
          <p style="margin: 0; color: var(--text-light);">Tanggal: <span id="modalDate"></span></p>
          <p style="margin: 0; color: var(--text-light);">Dosen Pembimbing 1: <span id="modalLecturer"></span></p>
        </div>
        
        <div class="table-container">
          <table class="modal-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Kriteria Penilaian</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Pemahaman Literatur</td>
                <td><input type="text" id="nilai_pemahaman" readonly></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Analisis Literatur</td>
                <td><input type="text" id="nilai_analisis" readonly></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Sintesis Literatur</td>
                <td><input type="text" id="nilai_sintesis" readonly></td>
              </tr>
              <tr>
                <td>4</td>
                <td>Kesimpulan dan Rekomendasi</td>
                <td><input type="text" id="nilai_kesimpulan" readonly></td>
              </tr>
              <tr style="font-weight: bold; background-color: var(--gray-light);">
                <td colspan="2">Total Nilai</td>
                <td id="modalTotalScore"></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div style="margin-top: 20px; padding: 16px; background-color: var(--primary-light); border-radius: 6px;">
          <h4 style="margin: 0 0 10px 0; color: var(--primary);">Catatan Tambahan:</h4>
          <p style="margin: 0;" id="catatan">Mahasiswa telah menunjukkan pemahaman yang baik terhadap literatur yang dikaji, namun perlu memperhatikan aspek sintesis untuk meningkatkan kualitas review.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    async function showNilaiLiteratur(id) {
      try {
        const response = await fetch(`/nilai-literatur/${id}`);
        const data = await response.json();
        
        document.getElementById('modalStudentName').textContent = data.mahasiswa.nama;
        document.getElementById('modalDate').textContent = new Date(data.created_at).toLocaleDateString();
        document.getElementById('modalLecturer').textContent = data.dosen.nama;
        
        // Update nilai-nilai
        document.getElementById('nilai_pemahaman').textContent = data.nilai_pemahaman;
        document.getElementById('nilai_analisis').textContent = data.nilai_analisis;
        document.getElementById('nilai_sintesis').textContent = data.nilai_sintesis;
        document.getElementById('nilai_kesimpulan').textContent = data.nilai_kesimpulan;
        document.getElementById('catatan').textContent = data.catatan;
        
        // Show modal
        document.getElementById('scoreModal').classList.add('show');
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengambil data');
      }
    }

    function hideModal() {
      document.getElementById('scoreModal').classList.remove('show');
    }

    // Close modal when clicking outside of modal content
    window.onclick = function(event) {
      const modal = document.getElementById('scoreModal');
      if (event.target === modal) {
        hideModal();
      }
    }

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
</body>
</html>
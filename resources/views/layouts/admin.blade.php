<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - Admin Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  
  <style>
    :root {
      --primary: #E30613;
      --primary-light: #FFEAEC;
      --primary-lighter: #FFF1F2;
      --primary-dark: #C00511;
      --primary-darker: #A00410;
      --secondary: #2C3E50;
      --success: #2ECC71;
      --info: #3498DB;
      --warning: #F1C40F;
      --danger: #E74C3C;
      --gray-100: #f8f9fa;
      --gray-200: #e9ecef;
      --gray-300: #dee2e6;
      --gray-400: #ced4da;
      --gray-500: #adb5bd;
      --gray-600: #6c757d;
      --gray-700: #495057;
      --gray-800: #343a40;
      --gray-900: #212529;
      --white: #fff;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--gray-100);
      margin: 0;
      padding: 0;
      color: var(--gray-800);
    }

    .dashboard-container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 280px;
      background: linear-gradient(135deg, var(--secondary) 0%, var(--gray-900) 100%);
      color: var(--white);
      position: fixed;
      height: 100vh;
      z-index: 1000;
      transition: all 0.3s ease;
    }

    .sidebar-header {
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.1);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header h3 {
      color: var(--white);
      margin: 0;
      font-size: 1.5rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .sidebar-nav {
      padding: 1rem 0;
    }

    .sidebar-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-nav li {
      margin-bottom: 0.25rem;
    }

    .sidebar-nav li a {
      display: flex;
      align-items: center;
      padding: 0.875rem 1.5rem;
      color: var(--gray-400);
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
    }

    .sidebar-nav li a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: var(--white);
      border-left-color: var(--primary);
    }

    .sidebar-nav li a.active {
      background-color: rgba(255, 255, 255, 0.1);
      color: var(--white);
      border-left-color: var(--primary);
    }

    .sidebar-nav li a i {
      width: 1.5rem;
      margin-right: 1rem;
      font-size: 1.1rem;
    }

    /* Main Content Styles */
    .main-content {
      flex: 1;
      margin-left: 280px;
      padding: 2rem;
      background-color: var(--gray-100);
      min-height: 100vh;
    }

    /* Header Styles */
    .main-header {
      background-color: var(--white);
      padding: 1rem 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      position: fixed;
      top: 0;
      right: 0;
      left: 280px;
      z-index: 999;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header-title h1 {
      font-size: 1.5rem;
      color: var(--gray-800);
      margin: 0;
    }

    .header-title span {
      color: var(--primary);
      font-weight: 600;
    }

    .header-controls {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    /* Card Styles */
    .dashboard-card {
      background-color: var(--white);
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      border: none;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .card-header {
      background-color: transparent;
      border-bottom: 1px solid var(--gray-200);
      padding-bottom: 1rem;
      margin-bottom: 1rem;
    }

    .card-header h2 {
      font-size: 1.25rem;
      color: var(--gray-800);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    /* Button Styles */
    .btn-primary {
      background-color: var(--primary);
      border-color: var(--primary);
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
    }

    /* Table Styles */
    .table {
      margin-bottom: 0;
    }

    .table thead th {
      background-color: var(--gray-100);
      border-bottom: 2px solid var(--gray-200);
      color: var(--gray-700);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
      background-color: var(--gray-100);
    }

    /* Stats Card */
    .stats-card {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: var(--white);
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .stats-icon {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .stats-info h3 {
      font-size: 1.75rem;
      margin: 0;
      font-weight: 600;
    }

    .stats-info p {
      margin: 0;
      opacity: 0.9;
      font-size: 0.875rem;
    }

    /* User Controls */
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: var(--primary-light);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .user-avatar:hover {
      background-color: var(--primary);
      color: var(--white);
    }

    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--danger);
      color: var(--white);
      border-radius: 50%;
      width: 18px;
      height: 18px;
      font-size: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Dropdown Menu */
    .dropdown-menu {
      border: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
      padding: 0.5rem 0;
    }

    .dropdown-item {
      padding: 0.5rem 1rem;
      color: var(--gray-700);
      transition: all 0.2s ease;
    }

    .dropdown-item:hover {
      background-color: var(--primary-lighter);
      color: var(--primary);
    }

    .dropdown-item i {
      margin-right: 0.5rem;
      width: 1.25rem;
      text-align: center;
    }

    /* Alert Styles */
    .alert {
      margin: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .alert-success {
      background-color: #d1e7dd;
      border-color: #badbcc;
      color: #0f5132;
    }

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c2c7;
      color: #842029;
    }

    .alert-dismissible .btn-close {
      padding: 1.25rem;
    }

    .alert ul {
      padding-left: 1.5rem;
    }
  </style>

  @yield('additional_styles')
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <h3>
          <i class="fas fa-university"></i>
          Admin Dashboard
        </h3>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li>
            <a href="{{ route('admin.dashboardadmin') }}" class="{{ request()->routeIs('admin.dashboardadmin') ? 'active' : '' }}">
              <i class="fas fa-home"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <span>User Management</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.logbimbingan') }}" class="{{ request()->routeIs('admin.logbimbingan') ? 'active' : '' }}">
              <i class="fas fa-clipboard-list"></i>
              <span>Log Bimbingan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.pendaftaranproposal') }}" class="{{ request()->routeIs('admin.pendaftaranproposal') ? 'active' : '' }}">
              <i class="fas fa-file-signature"></i>
              <span>Pendaftaran Proposal</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.penguji') }}" class="{{ request()->routeIs('admin.penguji') ? 'active' : '' }}">
              <i class="fas fa-user-check"></i>
              <span>Pengelolaan Penguji</span>
            </a>
          </li>
          <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown">
              <i class="fas fa-star"></i>
              <span>Penilaian Dosen</span>
              <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('admin.nilaibimprota') }}">Nilai Bimbingan Proposal</a></li>
              <li><a class="dropdown-item" href="{{ route('admin.nilaide') }}">Nilai Desk Evaluasi</a></li>
              <li><a class="dropdown-item" href="{{ route('admin.nilaipresentasita') }}">Nilai Presentasi</a></li>
              <li><a class="dropdown-item" href="{{ route('admin.nilailiteratur') }}">Nilai Literatur Review</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Header -->
      <header class="main-header">
        <div class="header-title">
          <h1>@yield('page_title', 'Selamat Datang, ') <span>Admin!</span></h1>
        </div>
        <div class="header-controls">
          <div class="dropdown">
            <button class="btn btn-link position-relative" type="button" data-bs-toggle="dropdown">
              <i class="fas fa-bell text-muted fs-5"></i>
              @if(isset($pending_count) && $pending_count > 0)
                <span class="notification-badge">{{ $pending_count }}</span>
              @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end">
              <h6 class="dropdown-header">Notifikasi</h6>
              <a class="dropdown-item" href="#">Tidak ada notifikasi baru</a>
            </div>
          </div>
          <div class="dropdown">
            <div class="user-avatar" data-bs-toggle="dropdown">
              A
            </div>
            <div class="dropdown-menu dropdown-menu-end">
              <h6 class="dropdown-header">Menu Admin</h6>
              <a class="dropdown-item" href="#">
                <i class="fas fa-user"></i> Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <div class="content-wrapper" style="margin-top: 5rem;">
        <!-- Alert Messages -->
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
          <i class="fas fa-exclamation-triangle me-2"></i>
          <strong>Terjadi kesalahan:</strong>
          <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Main Content -->
        @yield('content')
      </div>
    </main>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>

  <!-- Core Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize all dropdowns
      var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
      dropdowns.map(function (dropdownToggle) {
        return new bootstrap.Dropdown(dropdownToggle)
      });

      // Add active class to current menu item
      var currentLocation = window.location.href;
      var menuItems = document.querySelectorAll('.sidebar-nav a');
      menuItems.forEach(function(item) {
        if (item.href === currentLocation) {
          item.classList.add('active');
        }
      });
    });
  </script>

  @yield('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - Admin Dashboard</title>
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

    /* Dropdown Styles */
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

    /* User Avatar Dropdown */
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

    @yield('additional_styles')
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
            <a href="{{ route('admin.dashboardadmin') }}">
              <i class="fas fa-file-alt"></i>
              <span>Rekapan Pengajuan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.logbimbingan') }}">
              <i class="fas fa-clipboard-list"></i>
              <span>Log Bimbingan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.pendaftaranproposal') }}">
              <i class="fas fa-file-signature"></i>
              <span>Pendaftaran Proposal</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.penguji') }}">
              <i class="fas fa-user-check"></i>
              <span>Pengelolaan Penguji</span>
            </a>
          </li>
          <li class="dropdown">
            <a href="#">
              <i class="fas fa-chalkboard-teacher"></i>
              <span>Penilaian Dosen</span>
              <i class="fas fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('admin.nilaibimprota') }}">Formulir Nilai Bimbingan Proposal TA</a></li>
              <li><a href="{{ route('admin.nilaide') }}">Formulir Nilai Desk Evaluasi</a></li>
              <li><a href="{{ route('admin.nilaipresentasita') }}">Formulir Nilai Presentasi Proposal TA</a></li>
              <li><a href="{{ route('admin.nilailiteratur') }}">Formulir Nilai Literatur Review Proposal TA</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="header">
        <h1>@yield('page_title', 'Selamat Datang'), <span>Admin!</span></h1>
        <div class="user-controls">
          <button class="notification-btn">
            <i class="fas fa-bell"></i>
            @if(isset($pending_count) && $pending_count > 0)
              <span class="notification-dot"></span>
            @endif
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

      @yield('content')
    </main>
  </div>

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

  @yield('scripts')
</body>
</html>
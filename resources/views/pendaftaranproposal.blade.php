<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pendaftaran Proposal</title>
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
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      --card-bg: rgba(255, 255, 255, 0.98);
      --shadoww: 0 8px 30px rgba(15, 23, 42, 0.12);
      --glow: 0 0 15px rgba(227, 6, 19, 0.2);
      --accent: #E30613;
    }

    body {
      font-family: 'Segoe UI', 'Poppins', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 40px 20px;
      background-image: 
        radial-gradient(circle at 20% 30%, rgba(227, 6, 19, 0.05) 0%, transparent 25%),
        radial-gradient(circle at 80% 70%, rgba(227, 6, 19, 0.05) 0%, transparent 25%);
    }

    .logo {
            width: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(var(--glow));
        }

    .form-container {
      max-width: 800px;
      margin: 0 auto;
      background: white;
      border-radius: 16px;
      box-shadow: var(--shadow);
      overflow: hidden;
      position: relative;
    }

    .form-header {
      background: var(--text-light);
      color: #1E293B;
      padding: 25px 40px;
      position: relative;
    }

    .form-header h1 {
      margin: 0;
      font-size: 1.8rem;
      font-weight: 700;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .subtitle {
            color: var(--primary);
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 30px;
            display: block;
        }

    form {
      padding: 30px 40px;
    }

    .form-section {
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }

    .form-section:last-child {
      border-bottom: none;
    }

    .section-title {
      color: var(--primary);
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .section-title i {
      margin-right: 10px;
      font-size: 1.1rem;
    }

    label {
      display: block;
      margin-top: 20px;
      font-weight: 600;
      color: var(--secondary);
      font-size: 0.95rem;
    }

    label.required::after {
      content: ' *';
      color: var(--primary);
    }

    input:not([type="file"]), 
    textarea, 
    select {
      width: 100%;
      padding: 12px 16px;
      margin-top: 8px;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      font-family: inherit;
      font-size: 0.95rem;
      transition: var(--transition);
    }

    input:focus, 
    textarea:focus, 
    select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    .file-upload {
      position: relative;
      margin-top: 8px;
    }

    .file-upload input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px dashed #E2E8F0;
      border-radius: 8px;
      background-color: var(--bg-light);
    }

    .file-upload::after {
      content: 'Pilih File';
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--primary);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 500;
      pointer-events: none;
    }

    .file-hint {
      font-size: 0.85rem;
      color: #718096;
      margin-top: 6px;
      display: block;
    }

    .submit-btn {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      padding: 14px 28px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: var(--transition);
      width: 100%;
      margin-top: 30px;
      font-size: 1rem;
      box-shadow: 0 4px 12px rgba(227, 6, 19, 0.2);
      position: relative;
      overflow: hidden;
    }

    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(227, 6, 19, 0.3);
    }

    .submit-btn:active {
      transform: translateY(1px);
    }

    .submit-btn::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
    }

    .submit-btn:hover::after {
      left: 100%;
    }

    @media (max-width: 768px) {
      body {
        padding: 20px 15px;
      }

      .form-container {
        border-radius: 12px;
      }

      .form-header {
        padding: 20px;
      }

      .form-header h1 {
        font-size: 1.5rem;
      }

      form {
        padding: 25px;
      }
    }

    @media (max-width: 480px) {
      .form-header h1 {
        font-size: 1.3rem;
      }

      form {
        padding: 20px 15px;
      }
    }

    .container {
      background: var(--card-bg);
      max-width: 800px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 16px;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.4);
    }
    
    .container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 5px;
      height: 100%;
      background: linear-gradient(to bottom, var(--primary), var(--accent));
    }

    header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

  </style>
</head>
<body>
  <div class="container">
    <div class="logo" style="height: 40px; background: var(--border); display: flex; align-items: center; justify-content: center;">
                    <img src="assets/img/logo.jpeg" alt="Logo FIF" style="height: 100%; object-fit: contain;">
                </div>
    <div class="form-header">
      <h1><i class="fas"></i> Form Pendaftaran Proposal</h1>
      <span class="subtitle">Fakultas Informatika</span>
    </div>

    <form action="#" method="post" enctype="multipart/form-data">
      <!-- Data Pribadi -->
      <div class="form-section">
        <div class="section-title">
          <i class="fas fa-user-graduate"></i> Data Pribadi
        </div>

        <label for="nama" class="required">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" required>

        <label for="nim" class="required">NIM</label>
        <input type="text" id="nim" name="nim" required>

        <label for="prodi" class="required">Program Studi</label>
        <input type="text" id="prodi" name="prodi" required>

        <label for="email" class="required">Email Aktif</label>
        <input type="email" id="email" name="email" required>

        <label for="hp" class="required">Nomor HP</label>
        <input type="tel" id="hp" name="hp" required>
      </div>

      <!-- Informasi Tugas Akhir -->
      <div class="form-section">
        <div class="section-title">
          <i class="fas fa-file-alt"></i> Informasi Tugas Akhir
        </div>

        <label for="judul" class="required">Judul Skripsi/Tugas Akhir</label>
        <textarea id="judul" name="judul" required></textarea>

        <label for="pembimbing" class="required">Nama Dosen Pembimbing</label>
        <input type="text" id="pembimbing" name="pembimbing" required>

        <label for="abstrak">Abstrak (Opsional)</label>
        <textarea id="abstrak" name="abstrak"></textarea>
      </div>

      <!-- Upload Dokumen -->
      <div class="form-section">
        <div class="section-title">
          <i class="fas fa-file-upload"></i> Upload Dokumen
        </div>

        <label for="draft" class="required">Draft Skripsi</label>
        <div class="file-upload">
          <input type="file" id="draft" name="draft" accept=".pdf" required>
        </div>
        <span class="file-hint">Format: PDF (maks. 10MB)</span>

        <label for="persetujuan" class="required">Lembar Persetujuan Pembimbing</label>
        <div class="file-upload">
          <input type="file" id="persetujuan" name="persetujuan" accept=".pdf" required>
        </div>
        <span class="file-hint">Format: PDF (maks. 5MB)</span>

        <label for="bukti_bebas" class="required">Bukti Bebas Perpustakaan/Administrasi</label>
        <div class="file-upload">
          <input type="file" id="bukti_bebas" name="bukti_bebas" accept=".pdf" required>
        </div>
        <span class="file-hint">Format: PDF (maks. 5MB)</span>

        <label for="transkrip" class="required">Transkrip Nilai Sementara</label>
        <div class="file-upload">
          <input type="file" id="transkrip" name="transkrip" accept=".pdf" required>
        </div>
        <span class="file-hint">Format: PDF (maks. 5MB)</span>
      </div>

      <!-- Submit -->
      <button type="submit" class="submit-btn">
        <i class="fas fa-paper-plane"></i> Daftar Proposal
      </button>
    </form>
  </div>
</body>
</html>
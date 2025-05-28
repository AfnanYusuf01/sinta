<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pendaftaran Proposal</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #E30613;
      --primary-light: rgba(227, 6, 19, 0.1);
      --primary-lighter: rgba(227, 6, 19, 0.05);
      --primary-dark: #c00511;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      border-top: 4px solid var(--primary-color);
    }

    .back-button {
      display: inline-flex;
      align-items: center;
      color: var(--primary-color);
      text-decoration: none;
      margin-bottom: 1.5rem;
      font-weight: 500;
      transition: all 0.3s;
    }

    .back-button:hover {
      color: var(--primary-dark);
      transform: translateX(-3px);
    }

    .back-button i {
      margin-right: 8px;
    }

    .form-header {
      margin-bottom: 2rem;
      text-align: center;
      position: relative;
      padding-bottom: 1rem;
    }

    .form-header h1 {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .form-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background-color: var(--primary-color);
    }

    .subtitle {
      color: #666;
      font-size: 0.9rem;
    }

    form {
      margin-top: 2rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #444;
    }

    label.required::after {
      content: ' *';
      color: var(--primary-color);
    }

    textarea, select {
      width: 100%;
      padding: 0.75rem 1rem;
      margin-bottom: 1.5rem;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.3s;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    textarea:focus, select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.15);
    }

    .submit-btn {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.75rem 2rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s;
      margin-top: 1rem;
    }

    .submit-btn:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
    }

    .alert {
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
    }

    .alert-success {
      background-color: rgba(25, 135, 84, 0.1);
      border-left: 4px solid #198754;
    }

    .alert-danger {
      background-color: rgba(220, 53, 69, 0.1);
      border-left: 4px solid #dc3545;
    }

    .status-card {
      padding: 1.5rem;
      border-radius: 8px;
      margin-bottom: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .status-card i {
      margin-right: 8px;
      font-size: 1.2rem;
    }

    .status-waiting {
      border-left: 4px solid #ffc107;
    }

    .status-approved {
      border-left: 4px solid #28a745;
    }

    .status-rejected {
      border-left: 4px solid #dc3545;
    }

    .dosen-info {
      background-color: #f8f9fa;
      padding: 1rem;
      border-radius: 6px;
      margin-top: 1rem;
    }

    .dosen-info h5 {
      color: #333;
      margin-bottom: 0.5rem;
    }

    .dosen-info p {
      margin-bottom: 0.5rem;
    }

    .dosen-info strong {
      color: #555;
    }

    .form-disabled {
      opacity: 0.6;
      pointer-events: none;
    }

    @media (max-width: 768px) {
      .container {
        padding: 1.5rem;
        margin: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ url('/') }}" class="back-button">
      <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
      </div>
    @endif

    @if(isset($pendaftaran))
      @if($pendaftaran->status == 'menunggu')
        <div class="status-card status-waiting">
          <div class="d-flex align-items-center">
            <div class="status-icon text-warning me-3">
              <i class="fas fa-clock"></i>
            </div>
            <div>
              <h3 class="status-title">Menunggu Persetujuan</h3>
              <p>Pendaftaran proposal Anda sedang dalam proses peninjauan oleh dosen pembimbing.</p>
              <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
              <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
              <p><strong>Diajukan pada:</strong> {{ $pendaftaran->created_at->format('d F Y H:i') }}</p>

              <div class="dosen-info mt-3">
                <h5>Dosen Pembimbing 1</h5>
                <p><strong>Nama:</strong> {{ $pendaftaran->dosen1->nama }}</p>
                <p><strong>NIDN:</strong> {{ $pendaftaran->dosen1->nidn }}</p>
              </div>

              @if($pendaftaran->dosen2)
                <div class="dosen-info mt-3">
                  <h5>Dosen Pembimbing 2</h5>
                  <p><strong>Nama:</strong> {{ $pendaftaran->dosen2->nama }}</p>
                  <p><strong>NIDN:</strong> {{ $pendaftaran->dosen2->nidn }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      @elseif($pendaftaran->status == 'diterima')
        <div class="status-card status-approved">
          <div class="d-flex align-items-center">
            <div class="status-icon text-success me-3">
              <i class="fas fa-check-circle"></i>
            </div>
            <div>
              <h3 class="status-title">Proposal Diterima</h3>
              <p>Selamat! Proposal Anda telah disetujui oleh dosen pembimbing.</p>
              <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
              <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
              <p><strong>Disetujui pada:</strong> {{ $pendaftaran->updated_at->format('d F Y H:i') }}</p>

              <div class="dosen-info mt-3">
                <h5><i class="fas fa-user-graduate me-2"></i>Dosen Pembimbing 1</h5>
                <p><strong>Nama:</strong> {{ $pendaftaran->dosen1->nama }}</p>
                <p><strong>NIDN:</strong> {{ $pendaftaran->dosen1->nidn }}</p>
              </div>

              @if($pendaftaran->dosen2)
                <div class="dosen-info mt-3">
                  <h5><i class="fas fa-user-graduate me-2"></i>Dosen Pembimbing 2</h5>
                  <p><strong>Nama:</strong> {{ $pendaftaran->dosen2->nama }}</p>
                  <p><strong>NIDN:</strong> {{ $pendaftaran->dosen2->nidn }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      @elseif($pendaftaran->status == 'ditolak')
        <div class="status-card status-rejected">
          <div class="d-flex align-items-center">
            <div class="status-icon text-danger me-3">
              <i class="fas fa-times-circle"></i>
            </div>
            <div>
              <h3 class="status-title">Proposal Ditolak</h3>
              <p>Mohon maaf, proposal Anda belum dapat disetujui. Silakan ajukan proposal baru dengan perbaikan yang diperlukan.</p>
              <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
              <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
              <p><strong>Ditolak pada:</strong> {{ $pendaftaran->updated_at->format('d F Y H:i') }}</p>
            </div>
          </div>
        </div>
      @endif
    @endif

    @if(!isset($pendaftaran) || $pendaftaran->status == 'ditolak')
      <div class="form-header">
        <h1><i class="fas fa-file-alt me-2"></i>Form Pendaftaran Proposal</h1>
        <span class="subtitle">Fakultas Informatika</span>
      </div>

      <form action="{{ route('pendaftaranproposal.store') }}" method="POST">
        @csrf

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="form-group">
          <label for="judul_ta" class="required">
            <i class="fas fa-heading"></i> Judul Tugas Akhir
          </label>
          <textarea id="judul_ta" name="judul_ta" rows="3" required placeholder="Masukkan judul tugas akhir Anda">{{ old('judul_ta') }}</textarea>
        </div>

        <div class="form-group">
          <label for="dosen1" class="required">
            <i class="fas fa-user-graduate"></i> Dosen Pembimbing 1
          </label>
          <select id="dosen1" name="dosen1" required>
            <option value="">-- Pilih Dosen Pembimbing 1 --</option>
            @foreach($dosenList as $dosen)
              <option value="{{ $dosen->id }}" {{ old('dosen1') == $dosen->id ? 'selected' : '' }}>
                {{ $dosen->nama }} ({{ $dosen->nidn }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="dosen2">
            <i class="fas fa-user-graduate"></i> Dosen Pembimbing 2 (Opsional)
          </label>
          <select id="dosen2" name="dosen2">
            <option value="">-- Pilih Dosen Pembimbing 2 --</option>
            @foreach($dosenList as $dosen)
              <option value="{{ $dosen->id }}" {{ old('dosen2') == $dosen->id ? 'selected' : '' }}>
                {{ $dosen->nama }} ({{ $dosen->nidn }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="abstrak" class="required">
            <i class="fas fa-align-left"></i> Abstrak
          </label>
          <textarea id="abstrak" name="abstrak" rows="5" required placeholder="Masukkan abstrak proposal Anda">{{ old('abstrak') }}</textarea>
        </div>

        <button type="submit" class="submit-btn">
          <i class="fas fa-paper-plane me-2"></i>
          Kirim Pengajuan
        </button>
      </form>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
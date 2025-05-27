<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pendaftaran Proposal</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
      position: relative;
      overflow: hidden;
      border-left: 4px solid;
    }
    
    .status-card i {
      margin-right: 8px;
      font-size: 1.2rem;
    }
    
    .status-waiting {
      background-color: rgba(255, 193, 7, 0.1);
      border-left-color: #ffc107;
      color: #856404;
    }
    
    .status-approved {
      background-color: rgba(40, 167, 69, 0.1);
      border-left-color: #28a745;
      color: #155724;
    }
    
    .status-rejected {
      background-color: rgba(220, 53, 69, 0.1);
      border-left-color: #dc3545;
      color: #721c24;
    }
    
    .dosen-info {
      background-color: white;
      padding: 1rem;
      border-radius: 8px;
      margin-top: 1rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .dosen-info h5 {
      color: var(--primary-color);
      margin-bottom: 1rem;
      font-weight: 600;
      border-bottom: 1px solid #eee;
      padding-bottom: 0.5rem;
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
          <i class="fas fa-clock"></i> Menunggu Persetujuan
          <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
          <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
          <p><strong>Dosen Pembimbing 1:</strong> {{ $pendaftaran->dosen1->nama }}</p>
          @if($pendaftaran->id_dosen_2)
            <p><strong>Dosen Pembimbing 2:</strong> {{ $pendaftaran->dosen2->nama }}</p>
          @endif
          <p><strong>Diajukan pada:</strong> {{ $pendaftaran->created_at->format('d F Y H:i') }}</p>
        </div>
      @elseif($pendaftaran->status == 'diterima')
        <div class="status-card status-approved">
          <i class="fas fa-check-circle"></i> Pengajuan Diterima
          <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
          <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
          <p><strong>Disetujui pada:</strong> {{ $pendaftaran->updated_at->format('d F Y H:i') }}</p>

          <div class="dosen-info">
            <h5><i class="fas fa-user-graduate me-2"></i>Dosen Pembimbing 1</h5>
            <p><strong>Nama:</strong> {{ $pendaftaran->dosen1->nama }}</p>
          </div>

          @if($pendaftaran->id_dosen_2)
            <div class="dosen-info">
              <h5><i class="fas fa-user-graduate me-2"></i>Dosen Pembimbing 2</h5>
              <p><strong>Nama:</strong> {{ $pendaftaran->dosen2->nama }}</p>
            </div>
          @endif
        </div>
      @elseif($pendaftaran->status == 'ditolak')
        <div class="status-card status-rejected">
          <i class="fas fa-times-circle"></i> Proposal Ditolak
          <p><strong>Judul TA:</strong> {{ $pendaftaran->judul_ta }}</p>
          <p><strong>Abstrak:</strong> {{ $pendaftaran->abstrak }}</p>
          <p><strong>Ditolak pada:</strong> {{ $pendaftaran->updated_at->format('d F Y H:i') }}</p>
          <div class="mt-3">
            <a href="{{ route('pendaftaranproposal.edit', $pendaftaran->id) }}" class="btn btn-sm btn-primary">
              <i class="fas fa-edit me-1"></i> Revisi Proposal
            </a>
          </div>
        </div>
      @endif
    @endif

    @if(!isset($pendaftaran) || ($pendaftaran->status == 'ditolak' && !request()->is('pendaftaranproposal/*/edit')))
    <div class="form-header">
      <h1><i class="fas fa-file-alt me-2"></i>Form Pendaftaran Proposal</h1>
      <span class="subtitle">Fakultas Informatika</span>
    </div>

    <form action="{{ isset($pendaftaran) && $pendaftaran->status == 'ditolak' ? route('pendaftaranproposal.update', $pendaftaran->id) : route('pendaftaranproposal.store') }}" method="POST">
      @csrf
      @if(isset($pendaftaran) && $pendaftaran->status == 'ditolak')
        @method('PUT')
      @endif

      <label for="judul_ta" class="required">Judul Skripsi/Tugas Akhir</label>
      <textarea id="judul_ta" name="judul_ta" placeholder="Masukkan judul proposal Anda..." required>{{ old('judul_ta', isset($pendaftaran) ? $pendaftaran->judul_ta : '') }}</textarea>

      <label for="dosen1" class="required">Dosen Pembimbing 1</label>
      <select id="dosen1" name="dosen1" required>
        @foreach ($dosenList as $dosen)
          <option value="{{ $dosen->id }}" {{ (isset($pendaftaran) && $pendaftaran->dosen1 == $dosen->id) ? 'selected' : '' }}>
            {{ $dosen->nama }}
          </option>
        @endforeach
      </select>

      <label for="dosen2">Dosen Pembimbing 2 (Opsional)</label>
      <select id="dosen2" name="dosen2">
        <option value="">Pilih jika ada</option>
        @foreach ($dosenList as $dosen)
          <option value="{{ $dosen->id }}" {{ (isset($pendaftaran) && $pendaftaran->dosen2 == $dosen->id) ? 'selected' : '' }}>
            {{ $dosen->nama }}
          </option>
        @endforeach
      </select>


      <label for="abstrak" class="required">Abstrak</label>
      <textarea id="abstrak" name="abstrak" placeholder="Masukkan abstrak proposal Anda..." required>{{ old('abstrak', isset($pendaftaran) ? $pendaftaran->abstrak : '') }}</textarea>


      <button type="submit" class="submit-btn">
        <i class="fas fa-paper-plane me-2"></i>
        {{ isset($pendaftaran) && $pendaftaran->status == 'ditolak' ? 'Ajukan Revisi' : 'Kirim Pengajuan' }}
      </button>
    </form>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Disable form jika sudah ada pendaftaran yang aktif
    document.addEventListener('DOMContentLoaded', function() {
      @if(isset($pendaftaran) && $pendaftaran->status != 'ditolak')
        const form = document.querySelector('form');
        if(form) {
          form.classList.add('form-disabled');
        }
      @endif
    });
  </script>
</body>
</html>
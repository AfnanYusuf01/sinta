<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penilaian Desk Evaluation S1 Informatika</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #d32f2f;
      --primary-dark: #b71c1c;
      --primary-light: #ff6659;
      --secondary: #f5f5f5;
      --text: #333333;
      --text-light: #757575;
      --border: #e0e0e0;
      --white: #ffffff;
      --success: #388e3c;
      --warning: #ffa000;
      --error: #d32f2f;
    }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: var(--text);
      background-color: #f9f9f9;
      line-height: 1.6;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px;
      background-color: var(--white);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      border-radius: 8px;
      margin-top: 30px;
      margin-bottom: 30px;
      border-top: 5px solid var(--primary);
    }
    
    .logo {
      height: 60px;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      border-radius: 8px;
      padding: 10px;
    }
    
    h1 {
      color: var(--primary);
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 5px;
    }
    
    .subtitle {
      display: block;
      color: var(--text-light);
      font-size: 16px;
      margin-bottom: 30px;
      font-weight: 500;
    }
    
    .section-title {
      font-size: 20px;
      font-weight: 600;
      color: var(--primary);
      margin: 25px 0 15px;
      padding-bottom: 8px;
      border-bottom: 2px solid var(--primary);
    }
    
    .evaluation-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 15px;
      margin-bottom: 30px;
    }
    
    .evaluation-item {
      background-color: var(--secondary);
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      font-weight: 500;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
      border-left: 4px solid var(--primary);
    }
    
    .evaluation-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .evaluation-btn {
      display: inline-block;
      padding: 12px 20px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: left;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .evaluation-btn:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .evaluation-btn.completed {
      background-color: var(--success);
    }
    
    .evaluation-btn.completed:hover {
      background-color: #2e7d32;
    }
    
    .add-btn {
      display: inline-block;
      padding: 12px 25px;
      background-color: var(--white);
      color: var(--primary);
      border: 2px solid var(--primary);
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 15px;
    }
    
    .add-btn:hover {
      background-color: var(--primary);
      color: var(--white);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--text);
    }
    
    .form-group label.required::after {
      content: " *";
      color: var(--error);
    }
    
    .form-control, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-family: inherit;
      transition: border 0.3s ease;
    }
    
    .form-control:focus, textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
    }
    
    textarea {
      min-height: 100px;
      resize: vertical;
    }
    
    .file-upload-wrapper {
      position: relative;
      margin-bottom: 5px;
    }
    
    .file-upload-wrapper input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px dashed var(--border);
      border-radius: 6px;
      background-color: var(--secondary);
    }
    
    .file-hint {
      font-size: 13px;
      color: var(--text-light);
    }
    
    .btn-primary {
      background-color: var(--primary);
      border-color: var(--primary);
      padding: 10px 20px;
      font-weight: 600;
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
    }
    
    .btn-secondary {
      padding: 10px 20px;
      font-weight: 600;
    }
    
    .modal-header {
      border-bottom: 1px solid var(--border);
      padding: 20px;
    }
    
    .modal-title {
      color: var(--primary);
      font-weight: 700;
    }
    
    .modal-content {
      border-radius: 10px;
      overflow: hidden;
      border: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .modal-body {
      padding: 20px;
    }
    
    .modal-footer {
      border-top: 1px solid var(--border);
      padding: 15px 20px;
    }
    
    .remove-btn {
      background: var(--error);
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-left: 10px;
    }
    
    .remove-btn:hover {
      background: #c62828;
      transform: translateY(-2px);
    }
    
    .evaluation-item-wrapper {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
      .container {
        padding: 20px;
        margin-top: 15px;
      }
      
      h1 {
        font-size: 24px;
      }
      
      .evaluation-grid {
        grid-template-columns: 1fr;
      }
      
      .evaluation-item-wrapper {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .remove-btn {
        margin-left: 0;
        margin-top: 10px;
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="logo">
    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo FIF" style="height: 100%; object-fit: contain;">
  </div>
  <h1>Penilaian Desk Evaluation Prodi S1 Informatika</h1>
  <span class="subtitle">Fakultas Informatika</span>

  <div class="section-title">Aspek Penilaian</div>
  <div class="evaluation-grid">
    <div class="evaluation-item">Latar Belakang</div>
    <div class="evaluation-item">Motivasi</div>
    <div class="evaluation-item">Kontribusi / Dampak</div>
    <div class="evaluation-item">Rumusan Masalah</div>
    <div class="evaluation-item">Tujuan</div>
    <div class="evaluation-item">Metode yang digunakan</div>
    <div class="evaluation-item">Kelayakan Waktu</div>
    <div class="evaluation-item">Kelayakan Dana</div>
    <div class="evaluation-item">Novelty / Kebaruan</div>
    <div class="evaluation-item">Link Road Tridharma</div>
  </div>

  <div class="section-title">Desk Evaluation</div>
  
  <!-- List of existing evaluations -->
  @foreach($evaluations as $index => $evaluation)
    <div class="evaluation-item-wrapper">
      <button 
        class="evaluation-btn completed"
        data-bs-toggle="modal" 
        data-bs-target="#evaluationModal"
        data-evaluation-id="{{ $evaluation->id_desk_evaluasi }}"
        data-dosen-id="{{ $evaluation->id_dosen }}"
        data-judul-ta="{{ $evaluation->judul_ta }}"
      >
        Desk Evaluation {{ $index + 1 }} ({{ $evaluation->dosen->nama }})
      </button>
      {{-- <form action="{{ route('desk-evaluation.destroy', $evaluation->id_desk_evaluasi) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="remove-btn">Hapus</button>
      </form> --}}
    </div>
  @endforeach
  
  <!-- Add new evaluation button -->
  <button class="add-btn mt-3" id="addEvaluationBtn">
    + Tambah Desk Evaluation Baru
  </button>
</div>

<!-- Evaluation Modal -->
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="evaluationModalLabel">Form Desk Evaluation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="evaluationForm" method="POST" action="{{ route('desk-evaluation.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="evaluation_id" id="evaluationId">
        
        <div class="modal-body">
          <div class="form-group">
            <label for="id_dosen" class="required">Dosen</label>
            <select id="id_dosen" name="id_dosen" class="form-control" required>
              <option value="">-- Pilih Dosen --</option>
              @foreach($allDosen as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="judul_ta" class="required">Judul Penelitian</label>
            <textarea id="judul_ta" name="judul_ta" class="form-control" rows="4" required></textarea>
          </div>

          <div class="form-group">
            <label for="file" class="required">Upload Form Desk Evaluation</label>
            <div class="file-upload-wrapper">
              <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx" required>
            </div>
            <span class="file-hint">Format file: PDF, DOC, DOCX (maks. 10MB)</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Kirim Penilaian</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const evaluationModal = document.getElementById('evaluationModal');
    const evaluationForm = document.getElementById('evaluationForm');
    
    evaluationModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const evaluationId = button.getAttribute('data-evaluation-id');
      const dosenId = button.getAttribute('data-dosen-id');
      const judulTa = button.getAttribute('data-judul-ta');
      
      document.getElementById('evaluationId').value = evaluationId || '';
      document.getElementById('id_dosen').value = dosenId || '';
      document.getElementById('judul_ta').value = judulTa || '';
      
      // Clear file input for existing evaluations
      if (evaluationId) {
        document.getElementById('file').required = false;
      } else {
        document.getElementById('file').required = true;
      }
    });
    
    // Add new evaluation button
    const addEvaluationBtn = document.getElementById('addEvaluationBtn');
    if (addEvaluationBtn) {
      addEvaluationBtn.addEventListener('click', function() {
        // Reset form
        evaluationForm.reset();
        document.getElementById('file').required = true;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('evaluationModal'));
        modal.show();
      });
    }
    
    // Reset form when modal is hidden
    evaluationModal.addEventListener('hidden.bs.modal', function() {
      evaluationForm.reset();
    });
  });
</script>
</body>
</html>
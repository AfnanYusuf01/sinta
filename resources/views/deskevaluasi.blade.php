<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penilaian Desk Evaluation S1 Informatika</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #E30613;
      --primary-dark: #C00511;
      --primary-light: #FF4757;
      --secondary: #0F172A;
      --text-dark: #1E293B;
      --text-light: #F8FAFC;
      --bg-light: #F1F5F9;
      --border: #E2E8F0;
      --card-bg: rgba(255, 255, 255, 0.98);
      --shadow: 0 8px 30px rgba(15, 23, 42, 0.12);
      --glow: 0 0 15px rgba(227, 6, 19, 0.2);
      --accent: #E30613;
    }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-dark);
      line-height: 1.6;
      margin: 0;
      padding: 40px 20px;
      background-image: 
        radial-gradient(circle at 20% 30%, rgba(227, 6, 19, 0.03) 0%, transparent 25%),
        radial-gradient(circle at 80% 70%, rgba(227, 6, 19, 0.03) 0%, transparent 25%);
    }
    
    .logo {
            width: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(var(--));
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
    
    h1 {
      font-size: 28px;
      color: var(--secondary);
      text-align: center;
      margin-bottom: 25px;
      font-weight: 700;
      letter-spacing: -0.5px;
      position: relative;
      padding-bottom: 15px;
    }
    
    h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      border-radius: 3px;
    }
    
    .section-title {
      color: var(--primary);
      margin: 30px 0 15px;
      font-size: 18px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .evaluation-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 12px;
      margin: 20px 0 30px;
    }
    
    .evaluation-item {
      background: rgba(241, 245, 249, 0.6);
      padding: 12px 15px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-dark);
      border-left: 3px solid var(--primary);
      transition: all 0.3s ease;
    }
    
    .evaluation-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(227, 6, 19, 0.1);
      background: white;
    }
    
    form {
      margin-top: 30px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--secondary);
      font-size: 15px;
    }
    
    label.required::after {
      content: '*';
      color: var(--primary);
      margin-left: 4px;
    }
    
    input, textarea, select {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      background-color: rgba(255, 255, 255, 0.9);
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
    }
    
    textarea {
      min-height: 120px;
      resize: vertical;
    }
    
    .file-upload-wrapper {
      position: relative;
    }
    
    .file-upload-wrapper input[type="file"] {
      padding: 12px;
      border: 1px dashed var(--border);
      background-color: rgba(241, 245, 249, 0.5);
    }
    
    .file-upload-wrapper::after {
      content: 'Pilih File';
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--primary);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      pointer-events: none;
    }
    
    .file-hint {
      font-size: 13px;
      color: #64748B;
      margin-top: 6px;
      display: block;
    }
    
    button {
      margin-top: 30px;
      padding: 16px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 6px rgba(227, 6, 19, 0.15);
      position: relative;
      overflow: hidden;
      letter-spacing: 0.5px;
    }
    
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(227, 6, 19, 0.25);
    }
    
    button::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
    }
    
    button:hover::after {
      left: 100%;
    }
    
    @media (max-width: 768px) {
      .container {
        padding: 30px 20px;
      }
      
      .evaluation-grid {
        grid-template-columns: 1fr;
      }
      
      h1 {
        font-size: 24px;
      }
    }
.subtitle {
            color: var(--primary);
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 30px;
            display: block;
        }

  </style>
</head>
<body>

<div class="container">
  <div class="logo" style="height: 40px; background: var(--border); display: flex; align-items: center; justify-content: center;">
                    <img src="assets/img/logo.jpeg" alt="Logo FIF" style="height: 100%; object-fit: contain;">
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

  <form>
    <div class="form-group">
      <label for="dosen" class="required">Dosen</label>
      <select id="dosen" name="dosen" required>
        <option value="">-- Pilih Dosen --</option>
        <option value="dosen1">Dr. Ahmad Fauzi, S.Kom., M.Kom.</option>
        <option value="dosen2">Prof. Budi Santoso, S.T., M.Sc., Ph.D.</option>
        <option value="dosen3">Dr. Citra Dewi, S.Si., M.T.</option>
        <option value="dosen4">Dr. Dian Pratama, S.Kom., M.Sc.</option>
        <option value="dosen5">Dr. Eka Wijaya, S.T., M.Eng.</option>
        <option value="dosen6">Dr. Fitri Ayu, S.Kom., M.Kom.</option>
        <option value="dosen7">Dr. Guntur Setiawan, S.T., M.T.</option>
        <option value="dosen8">Dr. Hana Lestari, S.Si., M.Kom.</option>
      </select>
    </div>

    <div class="form-group">
      <label for="judulPenelitian" class="required">Judul Penelitian</label>
      <textarea id="judulPenelitian" name="judulPenelitian" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <label for="formDeskEvaluation" class="required">Upload Form Desk Evaluation</label>
      <div class="file-upload-wrapper">
        <input type="file" id="formDeskEvaluation" name="formDeskEvaluation" accept=".pdf,.doc,.docx" required>
      </div>
      <span class="file-hint">Format file: PDF, DOC, DOCX (maks. 10MB)</span>
    </div>

    <button type="submit">
      Kirim Penilaian
    </button>
  </form>
</div>

</body>
</html>
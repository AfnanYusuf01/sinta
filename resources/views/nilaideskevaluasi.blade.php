<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Nilai Desk Evaluasi</title>
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
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      font-family: 'Segoe UI', 'Poppins', sans-serif;
      background-color: #f5f5f5;
      padding: 5px 20px;
      color: var(--text-dark);
      background-image: 
        radial-gradient(circle at 20% 30%, rgba(227, 6, 19, 0.05) 0%, transparent 25%),
        radial-gradient(circle at 80% 70%, rgba(227, 6, 19, 0.05) 0%, transparent 25%);
    }

    .form-container {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow);
      padding: 30px;
      position: relative;
      overflow: hidden;
    }

    .form-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 5px;
      height: 100%;
      background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
    }

    h2 {
      color: var(--secondary);
      text-align: center;
      margin-bottom: 25px;
      font-weight: 700;
      position: relative;
      padding-bottom: 10px;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--primary);
      border-radius: 3px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin: 20px 0;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }

    th {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: var(--text-light);
      padding: 15px;
      text-align: left;
      font-weight: 600;
      position: sticky;
      top: 0;
    }

    td {
      padding: 15px;
      border-bottom: 1px solid #eee;
      background-color: white;
      transition: var(--transition);
    }

    tr:hover td {
      background-color: rgba(227, 6, 19, 0.03);
    }

    .number-cell {
      text-align: center;
      font-weight: 600;
      color: var(--primary);
    }

    .max-score-cell {
      background-color: rgba(227, 6, 19, 0.05);
      text-align: center;
      font-weight: 600;
    }

    .aspect-title {
      font-weight: 600;
      color: var(--secondary);
      margin-bottom: 5px;
    }

    .aspect-desc {
      color: #4A5568;
      font-size: 0.9rem;
      line-height: 1.5;
      margin-left: 5px;
    }

    .aspect-desc li {
      margin-bottom: 3px;
    }

    input[type="number"] {
      width: 80px;
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 0.95rem;
      transition: var(--transition);
      text-align: center;
    }

    input[type="text"] {
      width: 35%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 1rem;
      transition: var(--transition);
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
    }

    textarea {
      width: 100%;
      height: 150px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-family: inherit;
      font-size: 0.95rem;
      resize: vertical;
      transition: var(--transition);
    }

    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
    }

    .notes-header {
      background: linear-gradient(135deg, var(--secondary), #2D3748) !important;
    }

    .total-row {
      background-color: rgba(227, 6, 19, 0.05);
    }

    .total-row td {
      font-weight: 700;
    }

    .total-row input {
      background-color: rgba(227, 6, 19, 0.1);
      font-weight: 600;
      color: var(--primary);
    }

    .submit-btn {
      display: block;
      margin: 30px auto 0;
      padding: 12px 30px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 4px 12px rgba(227, 6, 19, 0.2);
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(227, 6, 19, 0.3);
    }

    .name-input {
      margin-bottom: 20px;
    }

    .name-input label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--secondary);
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 20px 15px;
      }

      table {
        display: block;
        overflow-x: auto;
      }

      th, td {
        min-width: 150px;
      }
    }

    /* Style untuk tombol kembali ke beranda (warna abu-abu) */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 20px;
            background-color: #f8f9fa; /* Warna abu-abu muda */
            color: #1A1A2E; /* Warna teks abu-abu gelap */
            border: 1px solid #dee2e6; /* Border abu-abu */
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

  </style>
</head>
<body>

  <div class="container">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('penilaiandosen') }}" class="back-button">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

  <div class="form-container">
    <h2><i class="fas fa-clipboard-check"></i> Form Nilai Desk Evaluasi</h2>

    <div class="name-input">
      <label for="nama"><i class="fas fa-user"></i> Nama Mahasiswa</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan nama mahasiswa">
    </div>

    <table>
      <tr>
        <th style="width: 50px;">No.</th>
        <th>Aspek Penilaian</th>
        <th style="width: 100px;">Nilai Maks</th>
        <th style="width: 120px;">Nilai</th>
      </tr>
      <tr>
        <td rowspan="2" class="number-cell">1</td>
        <td>
          <div class="aspect-title">Latar Belakang</div>
          <ul class="aspect-desc">
            <li>Motivasi</li>
            <li>Kemanfaatan / Dampak</li>
          </ul>
        </td>
        <td class="max-score-cell">25</td>
        <td><input type="number" max="25" min="0"></td>
      </tr>
      <tr>
        <td>
          <div class="aspect-title">Formulasi Masalah</div>
          <ul class="aspect-desc">
            <li>Tujuan</li>
            <li>Batasan/Asumsi yang digunakan</li>
            <li>Kelayakan waktu dan sarana pendukung</li>
          </ul>
        </td>
        <td class="max-score-cell">30</td>
        <td><input type="number" max="30" min="0"></td>
      </tr>
      <tr>
        <td class="number-cell">3</td>
        <td>
          <div class="aspect-title">Teori Pendukung / Penelusuran Literatur</div>
        </td>
        <td class="max-score-cell">30</td>
        <td><input type="number" max="30" min="0"></td>
      </tr>
      <tr>
        <td class="number-cell">4</td>
        <td>
          <div class="aspect-title">Ide/Metode Penyelesaian Masalah</div>
        </td>
        <td class="max-score-cell">15</td>
        <td><input type="number" max="15" min="0"></td>
      </tr>
      <tr class="total-row">
        <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
        <td class="max-score-cell"><strong>100</strong></td>
        <td><input type="number" readonly></td>
      </tr>
    </table>
{{-- 
    <table>
      <tr>
        <th class="notes-header"><i class="fas fa-comment-dots"></i> CATATAN REVIEWER / USULAN PERBAIKAN</th>
      </tr>
      <tr>
        <td><textarea placeholder="Tulis catatan evaluasi dan usulan perbaikan di sini..."></textarea></td>
      </tr>
    </table> --}}

    <button type="submit" class="submit-btn">
      <i class="fas fa-paper-plane"></i> Submit Evaluasi
    </button>
  </div>

  <script>
    // Calculate total score automatically
    const scoreInputs = document.querySelectorAll('input[type="number"]:not([readonly])');
    const totalInput = document.querySelector('.total-row input');
    
    function calculateTotal() {
      let total = 0;
      scoreInputs.forEach(input => {
        const value = parseFloat(input.value) || 0;
        total += value;
      });
      totalInput.value = total;
    }
    
    scoreInputs.forEach(input => {
      input.addEventListener('input', calculateTotal);
    });
  </script>
</body>
</html>
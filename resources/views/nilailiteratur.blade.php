<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Nilai Literatur Review Proposal TA</title>
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
      max-width: 900px;
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
      text-align: center;
      font-weight: 600;
      position: sticky;
      top: 0;
    }

    td {
      padding: 15px;
      border-bottom: 1px solid #eee;
      background-color: white;
      transition: var(--transition);
      text-align: center;
    }

    tr:hover td {
      background-color: rgba(227, 6, 19, 0.03);
    }

    .left {
      text-align: left !important;
    }

    .criteria {
      color: #4A5568;
      font-size: 0.95rem;
      line-height: 1.5;
    }

    .max-score {
      background-color: rgba(227, 6, 19, 0.05);
      font-weight: 600;
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

    input[type="number"]:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
    }

    input[readonly] {
      background-color: rgba(227, 6, 19, 0.05);
      font-weight: 600;
      color: var(--primary);
    }

    .total-row {
      background-color: rgba(227, 6, 19, 0.05);
    }

    .total-row td {
      font-weight: 700;
    }

    .average-row {
      background-color: rgba(41, 128, 185, 0.05);
    }

    .average-row td {
      font-weight: 700;
      color: var(--secondary);
    }

    .note {
      font-size: 0.85rem;
      color: #718096;
      margin-top: 5px;
      text-align: center;
    }

    .reviewer-box {
      background: linear-gradient(135deg, var(--secondary), #2D3748);
      color: white;
      padding: 12px 15px;
      font-weight: 600;
      border-radius: 8px 8px 0 0;
      margin-top: 30px;
    }

    .reviewer-box i {
      margin-right: 8px;
    }

    textarea {
      width: 100%;
      height: 120px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 0 0 8px 8px;
      font-family: inherit;
      font-size: 0.95rem;
      resize: vertical;
      transition: var(--transition);
      border-top: none;
    }

    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
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
                <a href="{{ url('/penilaiandosen') }}" class="back-button">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

  <div class="form-container">
    <h2><i class="fas fa-book-open"></i> Form Nilai Literatur Review Proposal TA</h2>

    <div class="name-input">
      <label for="nama"><i class="fas fa-user"></i> Nama Mahasiswa</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan nama mahasiswa">
    </div>

    <table>
      <tr>
        <th rowspan="2" style="min-width: 300px;">Aspek Penilaian</th>
        <th rowspan="2" style="width: 100px;">Nilai Maks</th>
        <th colspan="2">Nilai</th>
      </tr>
      <tr>
        <th style="width: 120px;">Calon Pembimbing I<br><small>(60%)</small></th>
        <th style="width: 120px;">Calon Pembimbing II<br><small>(40%)</small></th>
      </tr>

      <tr>
        <td class="left criteria">Kualitas pustaka sebagai referensi utama</td>
        <td class="max-score">10</td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.4"></td>
      </tr>
      <tr>
        <td class="left criteria">Konten pustaka mengenai rumusan masalah</td>
        <td class="max-score">10</td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.4"></td>
      </tr>
      <tr>
        <td class="left criteria">Analisis pustaka terkait tujuan atau ide pokok</td>
        <td class="max-score">10</td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.4"></td>
      </tr>
      <tr>
        <td class="left criteria">Kelengkapan kajian teori mengenai metode atau algoritma</td>
        <td class="max-score">10</td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="10" class="score-input" data-weight="0.4"></td>
      </tr>
      <tr>
        <td class="left criteria">Kelebihan dan kekurangan penelitian</td>
        <td class="max-score">40</td>
        <td><input type="number" min="0" max="40" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="40" class="score-input" data-weight="0.4"></td>
      </tr>
      <tr>
        <td class="left criteria">Relasi teori terhadap topik proposal</td>
        <td class="max-score">20</td>
        <td><input type="number" min="0" max="20" class="score-input" data-weight="0.6"></td>
        <td><input type="number" min="0" max="20" class="score-input" data-weight="0.4"></td>
      </tr>

      <tr class="total-row">
        <td><strong>Jumlah</strong></td>
        <td><strong>100</strong></td>
        <td><input type="number" readonly id="total1"></td>
        <td><input type="number" readonly id="total2"></td>
      </tr>
      <tr class="average-row">
        <td colspan="2"><strong>Rata-rata nilai Calon Pembimbing</strong></td>
        <td colspan="2"><input type="number" readonly id="average"></td>
      </tr>
    </table>
{{-- 
    <p class="note">*) Diisi bila presentasi dilakukan kepada dua orang calon pembimbing</p>

    <div class="reviewer-box">
      <i class="fas fa-comment-dots"></i> CATATAN REVIEWER / USULAN PERBAIKAN
    </div>
    <textarea placeholder="Masukkan catatan evaluasi dan usulan perbaikan di sini..."></textarea> --}}

    <button type="submit" class="submit-btn">
      <i class="fas fa-paper-plane"></i> Submit Penilaian
    </button>
  </div>

  <script>
    // Calculate weighted scores
    const scoreInputs = document.querySelectorAll('.score-input');
    const total1 = document.getElementById('total1');
    const total2 = document.getElementById('total2');
    const average = document.getElementById('average');

    function calculateScores() {
      let sum1 = 0;
      let sum2 = 0;
      
      // Get all inputs for supervisor 1 (60%)
      const inputs1 = document.querySelectorAll('td:nth-child(3) input.score-input');
      inputs1.forEach(input => {
        const weight = parseFloat(input.dataset.weight);
        sum1 += (parseFloat(input.value) || 0) * weight;
      });
      
      // Get all inputs for supervisor 2 (40%)
      const inputs2 = document.querySelectorAll('td:nth-child(4) input.score-input');
      inputs2.forEach(input => {
        const weight = parseFloat(input.dataset.weight);
        sum2 += (parseFloat(input.value) || 0) * weight;
      });
      
      total1.value = Math.round(sum1);
      total2.value = Math.round(sum2);
      average.value = ((sum1 + sum2) / 2).toFixed(2);
    }

    // Add event listeners to all input fields
    scoreInputs.forEach(input => {
      input.addEventListener('input', calculateScores);
    });
  </script>
</body>
</html>
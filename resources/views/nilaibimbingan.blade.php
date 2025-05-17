<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Penilaian Proposal</title>
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
      padding: 30px 20px;
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
      margin-top: 20px;
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

    th:first-child {
      border-top-left-radius: 8px;
    }

    th:last-child {
      border-top-right-radius: 8px;
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

    tr:last-child td {
      border-bottom: none;
    }

    tr:last-child td:first-child {
      border-bottom-left-radius: 8px;
    }

    tr:last-child td:last-child {
      border-bottom-right-radius: 8px;
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

    input[type="number"]:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
    }

    .criteria-title {
      font-weight: 600;
      color: var(--secondary);
      margin-bottom: 5px;
    }

    .criteria-desc {
      color: #4A5568;
      font-size: 0.9rem;
      line-height: 1.5;
    }

    .total-row {
      background-color: rgba(227, 6, 19, 0.05);
    }

    .total-row td {
      font-weight: 700;
    }

    #total {
      color: var(--primary);
      font-size: 1.1rem;
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

    .submit-btn:active {
      transform: translateY(1px);
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
  </style>
</head>
<body>
  <div class="form-container">
    <h2><i class="fas fa-file-signature"></i> Form Penilaian Proposal</h2>

    <table>
      <thead>
        <tr>
          <th>Komponen Penilaian</th>
          <th>Kriteria Penilaian</th>
          <th>Nilai Maks</th>
          <th>Nilai</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="5">Pembuatan Proposal</td>
          <td>
            <div class="criteria-title">Pemilihan Tema</div>
            <div class="criteria-desc">Kemampuan memilih dan menjustifikasi Tema yang akan diangkat dari sisi <strong>Latar Belakang</strong> dan <strong>Rumusan Masalah</strong></div>
          </td>
          <td>15</td>
          <td><input type="number" name="nilai1" min="0" max="15"></td>
        </tr>
        <tr>
          <td>
            <div class="criteria-title">Pertanyaan Penelitian</div>
            <div class="criteria-desc">Cara menyajikan pertanyaan penelitian/problem statement untuk membangun Rumusan Masalah dan Tujuan</div>
          </td>
          <td>15</td>
          <td><input type="number" name="nilai2" min="0" max="15"></td>
        </tr>
        <tr>
          <td>
            <div class="criteria-title">Kajian Pustaka</div>
            <div class="criteria-desc">Ide/gagasan/strategi untuk menyelesaikan masalah</div>
          </td>
          <td>10</td>
          <td><input type="number" name="nilai3" min="0" max="10"></td>
        </tr>
        <tr>
          <td>
            <div class="criteria-title">Kajian Pustaka</div>
            <div class="criteria-desc">Justifikasi pemilihan model/metode/teori baik model simulasi, komputasi, atau model pembangunan aplikasi/perangkat lunak dengan studi literatur</div>
          </td>
          <td>10</td>
          <td><input type="number" name="nilai4" min="0" max="10"></td>
        </tr>
        <tr>
          <td>
            <div class="criteria-title">Rencana Implementasi / Simulasi / Komputasi</div>
            <div class="criteria-desc">Penjelasan tentang bagaimana membangun Implementasi / Simulasi / Komputasi yang diturunkan dari pemodelan</div>
          </td>
          <td>10</td>
          <td><input type="number" name="nilai5" min="0" max="10"></td>
        </tr>
        <tr>
          <td><em>Expert Judgement</em></td>
          <td>Kemandirian mahasiswa dalam penyusunan proposal</td>
          <td>20</td>
          <td><input type="number" name="nilai6" min="0" max="20"></td>
        </tr>
        <tr>
          <td>Proses Bimbingan</td>
          <td></td>
          <td>20</td>
          <td><input type="number" name="nilai7" min="0" max="20"></td>
        </tr>
        <tr class="total-row">
          <td colspan="2"><strong>Jumlah</strong></td>
          <td><strong>100</strong></td>
          <td><strong id="total">0</strong></td>
        </tr>
      </tbody>
    </table>

    <button type="submit" class="submit-btn">
      <i class="fas fa-paper-plane"></i> Submit Penilaian
    </button>
  </div>

  <script>
    const inputs = document.querySelectorAll('input[type="number"]');
    const totalDisplay = document.getElementById('total');

    function updateTotal() {
      let total = 0;
      inputs.forEach(input => {
        const value = parseFloat(input.value);
        if (!isNaN(value)) total += value;
      });
      totalDisplay.textContent = total;
    }

    inputs.forEach(input => {
      input.addEventListener('input', updateTotal);
    });
  </script>
</body>
</html>
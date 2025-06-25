<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Nilai Presentasi Proposal TA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .name-input {
      margin-bottom: 20px;
    }

    .name-input label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--secondary);
    }

    /* Improved dropdown styling */
    .select-wrapper {
      position: relative;
      width: 100%;
    }

    select.form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.3s ease;
      cursor: pointer;
      background-color: white;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1em;
      padding-right: 2.5em;
    }

    select.form-control:hover {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
    }

    select.form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.2);
    }

    select.form-control option {
      padding: 12px;
      background-color: white;
      color: var(--text-dark);
      cursor: pointer;
    }

    select.form-control option:hover {
      background-color: var(--primary-light);
      color: white;
    }

    .select-wrapper::after {
      content: '';
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }

    textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 1rem;
      transition: var(--transition);
      min-height: 120px;
    }

    textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
    }

    .history-table {
      margin-top: 40px;
    }

    .history-table th {
      background: linear-gradient(135deg, var(--secondary), #2a2a40);
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
      background-color: #f8f9fa;
      color: #1A1A2E;
      border: 1px solid #dee2e6;
      border-radius: 30px;
      font-weight: 500;
      text-decoration: none;
      transition: var(--transition);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .back-button:hover {
      background-color: #e9ecef;
    }

    .alert {
      padding: 12px 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 4px solid transparent;
    }

    .alert-success {
      background-color: #f0fff4;
      border-color: #38a169;
      color: #2f855a;
    }

    .alert-danger {
      background-color: #fff5f5;
      border-color: #e53e3e;
      color: #c53030;
    }

    .alert-info {
      background-color: #ebf8ff;
      border-color: #3182ce;
      color: #2b6cb0;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <a href="{{ url('/dosen/penilaiandosen') }}" class="back-button">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="form-container">
      <h2><i class="fas fa-chalkboard-teacher mr-2"></i>Form Nilai Presentasi Proposal TA</h2>

      <form action="{{ route('nilai-presentasi.store') }}" method="POST" id="formNilai">
        @csrf

        <div class="name-input mb-4">
          <label for="id_mahasiswa" class="form-label">Pilih Mahasiswa:</label>
          <div class="select-wrapper">
            <select name="id_mahasiswa" id="id_mahasiswa" class="form-control" required>
              <option value="">Pilih Mahasiswa</option>
              @foreach($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}" {{ old('id_mahasiswa') == $mhs->id ? 'selected' : '' }}>
                  {{ $mhs->nama }} - {{ $mhs->nim }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        @if($mahasiswa->isEmpty())
          <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i>
            Semua mahasiswa bimbingan Anda sudah dinilai.
          </div>
        @else
          <div class="mb-3 text-muted">
            <small>Jumlah mahasiswa yang belum dinilai: {{ $mahasiswa->count() }}</small>
          </div>
        @endif

        <table class="table table-bordered">
          <thead class="table-primary">
            <tr>
              <th width="5%">No</th>
              <th>Kriteria Penilaian</th>
              <th width="15%">Nilai (0-100)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>
                <div class="criteria-title">Penguasaan Materi Proposal</div>
                <div class="criteria-desc">- Menjawab latar belakang permasalahan, perumusan masalah, tujuan dan metodologi secara restruktur</div>
                <div class="criteria-desc">- Nilai Maksimal: 25</div>
              </td>
              <td><input type="number" name="nilai_penyajian" class="form-control" min="0" max="100" value="{{ old('nilai_penyajian') }}" required></td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="criteria-desc">- Menguasai Teori Pendukung TA</div>
                <div class="criteria-desc">- Nilai Maksimal: 15</div>
              </td>
              <td><input type="number" name="nilai_tingkat_penguasaan" class="form-control" min="0" max="100" value="{{ old('nilai_tingkat_penguasaan') }}" required></td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="criteria-desc">- Menguasai materi terkait dengan tools pemodelan, simulasi ataupun implementasi</div>
                <div class="criteria-desc">- Nilai Maksimal: 15</div>
              </td>
              <td><input type="number" name="nilai_kualitas_jawaban" class="form-control" min="0" max="100" value="{{ old('nilai_kualitas_jawaban') }}" required></td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="criteria-title">Expert Judgement</div>
                <div class="criteria-desc">- Pemaparan/cara menjawab</div>
                <div class="criteria-desc">- Komunikasi interpersonal</div>
                <div class="criteria-desc">- Nilai Maksimal: 50</div>
              </td>
              <td><input type="number" name="nilai_sikap" class="form-control" min="0" max="100" value="{{ old('nilai_sikap') }}" required></td>
            </tr>
            <tr class="table-info">
              <td colspan="2" class="text-end"><strong>Rata-rata Nilai:</strong></td>
              <td><strong id="total">0</strong></td>
            </tr>
          </tbody>
        </table>

        <div class="form-group mt-4">
          <label for="catatan" class="criteria-title">Catatan/Komentar:</label>
          <textarea name="catatan" id="catatan" class="form-control">{{ old('catatan') }}</textarea>
        </div>

        <button type="submit" class="submit-btn">
          <i class="fas fa-save mr-2"></i> Simpan Penilaian
        </button>
      </form>

      @if($nilaiPresentasis->isNotEmpty())
        <div class="history-table">
          <h3 class="mt-5 mb-4" style="color: var(--secondary); border-bottom: 2px solid var(--primary); padding-bottom: 8px;">
            <i class="fas fa-history mr-2"></i>Riwayat Penilaian
          </h3>
          <table class="table table-bordered">
            <thead class="table-primary">
              <tr>
                <th>Mahasiswa</th>
                <th>Penyajian</th>
                <th>Penguasaan</th>
                <th>Jawaban</th>
                <th>Sikap</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($nilaiPresentasis as $nilai)
                <tr>
                  <td>{{ $nilai->mahasiswa->nama }} ({{ $nilai->mahasiswa->nim }})</td>
                  <td>{{ $nilai->nilai_penyajian }}</td>
                  <td>{{ $nilai->nilai_tingkat_penguasaan }}</td>
                  <td>{{ $nilai->nilai_kualitas_jawaban }}</td>
                  <td>{{ $nilai->nilai_sikap }}</td>
                  <td>{{ $nilai->catatan }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script>
    // Function to calculate total
    function hitungTotal() {
      let total = 0;
      let count = 0;

      const nilai1 = parseFloat($('input[name="nilai_penyajian"]').val()) || 0;
      const nilai2 = parseFloat($('input[name="nilai_tingkat_penguasaan"]').val()) || 0;
      const nilai3 = parseFloat($('input[name="nilai_kualitas_jawaban"]').val()) || 0;
      const nilai4 = parseFloat($('input[name="nilai_sikap"]').val()) || 0;

      total = nilai1 + nilai2 + nilai3 + nilai4;
      const rata = total / 4;
      
      $('#total').text(rata.toFixed(2));
      return rata;
    }

    // Add input event listeners
    $('input[type="number"]').on('input', hitungTotal);

    // Calculate on page load if there are existing values
    $(document).ready(function() {
      hitungTotal();
    });
  </script>
</body>
</html>
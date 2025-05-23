<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Penilaian Desk Evaluation</title>
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
      text-decoration: none;
      color: #1A1A2E;
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
    }

    td {
      padding: 15px;
      border-bottom: 1px solid #eee;
      background-color: white;
    }

    tr:hover td {
      background-color: rgba(227, 6, 19, 0.03);
    }

    input[type="number"] {
      width: 80px;
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
      font-size: 0.95rem;
      text-align: center;
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
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(227, 6, 19, 0.3);
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

    .select-wrapper {
      position: relative;
      width: 100%;
      margin-bottom: 20px;
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
    }

    select.form-control:hover {
      border-color: var(--primary);
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 8px;
    }

    .alert-success {
      color: #0f5132;
      background-color: #d1e7dd;
      border-color: #badbcc;
    }

    .alert-danger {
      color: #842029;
      background-color: #f8d7da;
      border-color: #f5c2c7;
    }

    .alert-info {
      color: #055160;
      background-color: #cff4fc;
      border-color: #b6effb;
    }

    .select-wrapper select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      cursor: pointer;
    }

    .select-wrapper select:focus {
      outline: none;
      border-color: #E30613;
      box-shadow: 0 0 0 2px rgba(227, 6, 19, 0.1);
    }

    .form-select {
      display: block;
      width: 100%;
      padding: 0.375rem 2.25rem 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 16px 12px;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    .form-select:focus {
      border-color: var(--primary);
      outline: 0;
      box-shadow: 0 0 0 0.25rem rgba(227, 6, 19, 0.25);
    }

    .nilai-input {
      width: 100px !important;
    }

    .debug-info {
      background: #f8f9fa;
      padding: 15px;
      margin: 15px 0;
      border-radius: 5px;
      border: 1px solid #dee2e6;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <a href="{{ url('penilaiandosen') }}" class="back-button">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Debug Info -->

    <div class="form-container">
      <h2>Form Penilaian Desk Evaluation</h2>

      <form action="{{ route('nilai-de.store') }}" method="POST" id="formNilai">
        @csrf

        <div class="form-group">
          <label for="mahasiswa_id" class="form-label">Pilih Mahasiswa:</label>
          <select name="mahasiswa_id" id="mahasiswa_id" class="form-select" required>
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswa as $mhs)
              <option value="{{ $mhs->id }}">
                {{ $mhs->nama }} ({{ $mhs->nim }})
              </option>
            @endforeach
          </select>
        </div>

        @if($mahasiswa->isEmpty())
          <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Semua mahasiswa sudah dinilai.
          </div>
        @else
          <div class="mb-3 text-muted">
            <small>Jumlah mahasiswa yang belum dinilai: {{ $mahasiswa->count() }}</small>
          </div>

          <table class="table table-bordered mt-4">
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
                  <div class="criteria-title">Orisinalitas</div>
                  <div class="criteria-desc">Keaslian dan keunikan ide penelitian</div>
                </td>
                <td>
                  <input type="number" name="nilai_1" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>
                  <div class="criteria-title">Kebaruan/Novelty</div>
                  <div class="criteria-desc">Kontribusi baru terhadap bidang penelitian</div>
                </td>
                <td>
                  <input type="number" name="nilai_2" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>
                  <div class="criteria-title">Urgensi Penelitian</div>
                  <div class="criteria-desc">Tingkat kepentingan dan dampak penelitian</div>
                </td>
                <td>
                  <input type="number" name="nilai_3" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>
                  <div class="criteria-title">Metodologi</div>
                  <div class="criteria-desc">Kesesuaian dan kelayakan metode penelitian</div>
                </td>
                <td>
                  <input type="number" name="nilai_4" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td>
                  <div class="criteria-title">Tinjauan Pustaka</div>
                  <div class="criteria-desc">Kualitas dan relevansi referensi</div>
                </td>
                <td>
                  <input type="number" name="nilai_5" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>6</td>
                <td>
                  <div class="criteria-title">Kontribusi Penelitian</div>
                  <div class="criteria-desc">Potensi kontribusi terhadap pengembangan ilmu</div>
                </td>
                <td>
                  <input type="number" name="nilai_6" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr>
                <td>7</td>
                <td>
                  <div class="criteria-title">Kelayakan Tim Peneliti</div>
                  <div class="criteria-desc">Kemampuan dan kesiapan peneliti</div>
                </td>
                <td>
                  <input type="number" name="nilai_7" class="form-control nilai-input" min="0" max="100" required>
                </td>
              </tr>
              <tr class="table-info">
                <td colspan="2" class="text-end"><strong>Rata-rata Nilai:</strong></td>
                <td><strong id="total">0</strong></td>
              </tr>
            </tbody>
          </table>

          <button type="submit" class="submit-btn">Simpan Penilaian</button>
        @endif
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      console.log('Document ready');

      // Debug: Log mahasiswa data
      const mahasiswaData = @json($mahasiswa);
      console.log('Mahasiswa data:', mahasiswaData);

      // Handle select change
      $('#mahasiswa_id').on('change', function() {
        console.log('Select changed:', this.value);
        const selectedId = $(this).val();
        if (selectedId) {
          loadNilaiMahasiswa(selectedId);
        } else {
          resetForm();
        }
      });

      // Debug: Test select functionality
      $('#mahasiswa_id').click(function() {
        console.log('Select clicked');
      });

      function loadNilaiMahasiswa(mahasiswaId) {
        console.log('Loading nilai for mahasiswa:', mahasiswaId);
        // ... rest of the function
      }

      function resetForm() {
        $('#formNilai')[0].reset();
        $('#total').text('0');
      }

      // Add this to check if jQuery is working
      console.log('jQuery version:', $.fn.jquery);
    });
  </script>
</body>
</html>
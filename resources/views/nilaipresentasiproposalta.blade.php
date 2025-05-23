<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Nilai Presentasi Proposal TA</title>
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
      padding: 20px;
      color: var(--text-dark);
    }

    .form-container {
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow);
      padding: 30px;
    }

    h2 {
      color: var(--secondary);
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--text-dark);
    }

    select, input[type="number"], textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
      margin-bottom: 10px;
    }

    input[type="number"] {
      width: 100%;
    }

    .alert {
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
    }

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }

    .btn-submit {
      background: var(--primary);
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      width: 100%;
      margin-top: 20px;
    }

    .btn-submit:hover {
      background: var(--primary-dark);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: var(--primary);
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    .back-button {
      display: inline-block;
      padding: 10px 20px;
      margin-bottom: 20px;
      background-color: #f8f9fa;
      color: var(--text-dark);
      text-decoration: none;
      border-radius: 6px;
      border: 1px solid #ddd;
    }

    .back-button:hover {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>
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
    <h2><i class="fas fa-chalkboard-teacher"></i> Form Nilai Presentasi Proposal TA</h2>

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

    <form action="{{ route('nilai-presentasi.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="id_mahasiswa">Pilih Mahasiswa:</label>
        <select name="id_mahasiswa" id="id_mahasiswa" required>
          <option value="">-- Pilih Mahasiswa --</option>
          @foreach($mahasiswa as $mhs)
            <option value="{{ $mhs->id }}" {{ old('id_mahasiswa') == $mhs->id ? 'selected' : '' }}>
              {{ $mhs->nama }} ({{ $mhs->nim }})
            </option>
          @endforeach
        </select>
        @error('id_mahasiswa')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <table>
        <tr>
          <th style="width: 60%">Komponen Penilaian</th>
          <th style="width: 40%">Nilai (0-100)</th>
        </tr>
        <tr>
          <td>
            <strong>Penyajian Materi</strong>
            <br>
            <small>Penilaian terhadap cara penyajian dan kelengkapan materi presentasi</small>
          </td>
          <td>
            <input type="number" name="nilai_penyajian" min="0" max="100"
              value="{{ old('nilai_penyajian') }}" required>
            @error('nilai_penyajian')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </td>
        </tr>
        <tr>
          <td>
            <strong>Tingkat Penguasaan Materi</strong>
            <br>
            <small>Penilaian terhadap pemahaman dan penguasaan materi yang dipresentasikan</small>
          </td>
          <td>
            <input type="number" name="nilai_tingkat_penguasaan" min="0" max="100"
              value="{{ old('nilai_tingkat_penguasaan') }}" required>
            @error('nilai_tingkat_penguasaan')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </td>
        </tr>
        <tr>
          <td>
            <strong>Kualitas Jawaban</strong>
            <br>
            <small>Penilaian terhadap ketepatan dan kejelasan dalam menjawab pertanyaan</small>
          </td>
          <td>
            <input type="number" name="nilai_kualitas_jawaban" min="0" max="100"
              value="{{ old('nilai_kualitas_jawaban') }}" required>
            @error('nilai_kualitas_jawaban')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </td>
        </tr>
        <tr>
          <td>
            <strong>Sikap dan Perilaku</strong>
            <br>
            <small>Penilaian terhadap sikap profesional dan etika selama presentasi</small>
          </td>
          <td>
            <input type="number" name="nilai_sikap" min="0" max="100"
              value="{{ old('nilai_sikap') }}" required>
            @error('nilai_sikap')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </td>
        </tr>
      </table>

      <div class="form-group">
        <label for="catatan">Catatan/Komentar:</label>
        <textarea name="catatan" id="catatan" rows="4">{{ old('catatan') }}</textarea>
        @error('catatan')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn-submit">
        <i class="fas fa-save"></i> Simpan Nilai
      </button>
    </form>

    @if($nilaiPresentasis->isNotEmpty())
      <h3 style="margin-top: 40px;">Riwayat Penilaian</h3>
      <table>
        <thead>
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
    @endif
  </div>
</body>
</html>
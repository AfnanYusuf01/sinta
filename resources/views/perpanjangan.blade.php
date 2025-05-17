<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulir Perpanjangan Tugas Akhir</title>
  <style>
    :root {
      --primary-color: #E30613;
      --primary-dark: #B30510;
      --primary-light: #FFE6E8;
      --text-color: #333333;
      --light-gray: #f8f9fa;
      --border-color: #ddd;
      --accent: #E30613;
      --shadow: 0 8px 30px rgba(15, 23, 42, 0.12);
      --card-bg: rgba(255, 255, 255, 0.98);
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 40px 20px;
      background: var(--light-gray);
      color: var(--text-color);
      line-height: 1.6;
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
      background: linear-gradient(to bottom, var(--primary-color), var(--accent));
    }

    header {
      background-color: var(--primary-color);
      color: white;
      padding: 20px 0;
      text-align: center;
      border-radius: 8px 8px 0 0;
      margin-bottom: -1px;
    }

    .logo {
            width: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(var(--glow));
        }
    
    header h2 {
      margin: 0;
      font-weight: 600;
    }
    
    form {
      background: #ffffff;
      padding: 30px;
      border-radius: 0 0 8px 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--text-color);
    }
    
    label:after {
      content: " *";
      color: var(--primary-color);
      opacity: 0;
      transition: opacity 0.2s;
    }
    
    label.required:after {
      opacity: 1;
    }
    
    input, select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: 4px;
      font-family: inherit;
      font-size: 15px;
      transition: border 0.3s, box-shadow 0.3s;
    }
    
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px var(--primary-light);
    }
    
    select {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 16px;
    }
    
    button {
      display: block;
      width: 100%;
      padding: 14px;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 30px;
    }
    
    button:hover {
      background-color: var(--primary-dark);
    }
    
    .form-row {
      display: flex;
      gap: 20px;
    }
    
    .form-row .form-group {
      flex: 1;
    }
    
    @media (max-width: 600px) {
      .form-row {
        flex-direction: column;
        gap: 0;
      }
      
      .container {
        padding: 0 15px;
      }
      
      form {
        padding: 20px;
      }
    }

    .subtitle {
            color: var(--primary-color);
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
  <div class="logo" style="height: 40px; background: var(--secondary); display: flex; align-items: center; justify-content: center;">
                    <img src="assets/img/logo.jpeg" alt="Logo FIF" style="height: 100%; object-fit: contain;">
                </div>
    <h2 style="text-align: center" >Formulir Perpanjangan Tugas Akhir</h2>
    <span class="subtitle">Fakultas Informatika</span>
  
  
  <form>
    <div class="form-group">
      <label for="email" class="required">Email</label>
      <input type="email" id="email" name="email" required placeholder="contoh@email.com">
    </div>
    
    <div class="form-group">
      <label for="jenisPerpanjangan" class="required">Jenis Perpanjangan</label>
      <select id="jenisPerpanjangan" name="jenisPerpanjangan" required>
        <option value="">-- Pilih Jenis Perpanjangan --</option>
        <option value="TA1">Tugas Akhir 1</option>
        <option value="TA2">Tugas Akhir 2</option>
      </select>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="namaLengkap" class="required">Nama Lengkap</label>
        <input type="text" id="namaLengkap" name="namaLengkap" required placeholder="Nama lengkap sesuai KTM">
      </div>
      
      <div class="form-group">
        <label for="nim" class="required">NIM</label>
        <input type="text" id="nim" name="nim" required placeholder="Nomor Induk Mahasiswa">
      </div>
    </div>
    
    <div class="form-group">
      <label for="programStudi" class="required">Program Studi</label>
      <select id="programStudi" name="programStudi" required>
        <option value="">-- Pilih Program Studi --</option>
        <option value="S1 TI">S1 Teknik Informatika</option>
        <option value="S1 SI">S1 Sistem Informasi</option>
        <option value="S1 RPL">S1 Rekayasa Perangkat Lunak</option>
        <option value="S1 SD">S1 Sains Data</option>
      </select>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="telepon" class="required">No Telepon/WhatsApp</label>
        <input type="text" id="telepon" name="telepon" required placeholder="Nomor aktif yang bisa dihubungi">
      </div>
      
      <div class="form-group">
        <label for="teleponOrtu" class="required">No Telepon/WhatsApp Orangtua</label>
        <input type="text" id="teleponOrtu" name="teleponOrtu" required placeholder="Nomor orangtua yang bisa dihubungi">
      </div>
    </div>
    
    <div class="form-group">
      <label for="judulTA" class="required">Judul Tugas Akhir</label>
      <input type="text" id="judulTA" name="judulTA" required placeholder="Judul lengkap tugas akhir">
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="progresTA" class="required">Progres Pengerjaan TA</label>
        <select id="progresTA" name="progresTA" required>
          <option value="">-- Pilih Progres --</option>
          <option value="BAB I">BAB I</option>
          <option value="BAB II">BAB II</option>
          <option value="BAB III">BAB III</option>
          <option value="BAB IV">BAB IV</option>
          <option value="BAB V">BAB V</option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="ipk" class="required">IPK</label>
        <input type="text" id="ipk" name="ipk" required placeholder="Indeks Prestasi Kumulatif">
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="sks" class="required">Total SKS</label>
        <input type="number" id="sks" name="sks" required placeholder="Total SKS yang telah diambil">
      </div>
      
      <div class="form-group">
        <label for="tak" class="required">Jumlah TAK</label>
        <input type="number" id="tak" name="tak" required placeholder="Total TAK yang telah diperoleh">
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="sertifikatKompetensi" class="required">Sertifikat Kompetensi</label>
        <select id="sertifikatKompetensi" name="sertifikatKompetensi" required>
          <option value="">-- Pilih --</option>
          <option value="Sudah Ada">Sudah Ada</option>
          <option value="Belum Ada">Belum Ada</option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="sertifikatToefl" class="required">Sertifikat TOEFL</label>
        <select id="sertifikatToefl" name="sertifikatToefl" required>
          <option value="">-- Pilih --</option>
          <option value="Sudah Ada">Sudah Ada</option>
          <option value="Belum Ada">Belum Ada</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label for="alasanPerpanjangan" class="required">Alasan Perpanjangan TA</label>
      <textarea id="alasanPerpanjangan" name="alasanPerpanjangan" rows="4" required placeholder="Jelaskan alasan mengajukan perpanjangan"></textarea>
    </div>
    
    <div class="form-group">
      <label for="kendalaTA" class="required">Kendala Pengerjaan TA</label>
      <textarea id="kendalaTA" name="kendalaTA" rows="4" required placeholder="Jelaskan kendala yang dihadapi"></textarea>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="dosenWali" class="required">Nama Dosen Wali</label>
        <input type="text" id="dosenWali" name="dosenWali" required placeholder="Nama lengkap dosen wali">
      </div>
      
      <div class="form-group">
        <label for="dosenPembimbing1" class="required">Nama Dosen Pembimbing 1</label>
        <input type="text" id="dosenPembimbing1" name="dosenPembimbing1" required placeholder="Nama lengkap pembimbing 1">
      </div>
    </div>
    
    <div class="form-group">
      <label for="dosenPembimbing2" class="required">Nama Dosen Pembimbing 2</label>
      <input type="text" id="dosenPembimbing2" name="dosenPembimbing2" required placeholder="Nama lengkap pembimbing 2">
    </div>
    
    <button type="submit">Kirim Permohonan</button>
  </form>
</div>

</body>
</html>
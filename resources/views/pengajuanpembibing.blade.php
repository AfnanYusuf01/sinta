<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Pembimbing Tugas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding: 5px;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(227, 6, 19, 0.05) 0%, transparent 25%),
                radial-gradient(circle at 80% 70%, rgba(227, 6, 19, 0.05) 0%, transparent 25%);
        }

        /* Style untuk tombol kembali ke beranda (warna abu-abu) */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 20px;
            background-color: #f8f9fa; /* Warna abu-abu muda */
            color: #495057; /* Warna teks abu-abu gelap */
            border: 1px solid #dee2e6; /* Border abu-abu */
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .back-button i {
            margin-right: 8px;
            transition: var(--transition);
            color: #6c757d; /* Warna icon abu-abu */
        }

        .back-button:hover {
            background-color: #e9ecef; /* Warna abu-abu sedikit lebih gelap saat hover */
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #ced4da;
        }

        .back-button:hover i {
            transform: translateX(-3px);
            color: #495057;
        }

        .status-card {
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .status-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
        }

        .status-waiting {
            background-color: #FFF3CD;
            border-left: 5px solid #FFC107;
        }

        .status-approved {
            background-color: #D1E7DD;
            border-left: 5px solid #198754;
        }

        .status-rejected {
            background-color: #F8D7DA;
            border-left: 5px solid #DC3545;
        }

        .status-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .status-title {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
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

        .form-header {
            padding: 25px 30px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .form-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .form-body {
            padding: 25px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(227, 6, 19, 0.3);
        }

        .form-footer {
            margin-top: 30px;
        }

        .dosen-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .dosen-info h5 {
            margin-bottom: 10px;
            color: var(--secondary);
        }

        .dosen-info p {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 15px;
            }
            
            .form-header, .form-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('/') }}" class="back-button">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="text-center mb-4">Pengajuan Pembimbing Tugas Akhir</h1>

        @if(isset($usulan))
            @if($usulan->status == 'menunggu')
                <div class="status-card status-waiting">
                    <div class="d-flex align-items-center">
                        <div class="status-icon text-warning me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3 class="status-title">Menunggu Persetujuan</h3>
                            <p>Usulan pembimbing Anda sedang dalam proses peninjauan oleh administrasi.</p>
                            <p><strong>Judul TA:</strong> {{ $usulan->judul_ta }}</p>
                            <p><strong>Diajukan pada:</strong> {{ $usulan->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            @elseif($usulan->status == 'diterima')
                <div class="status-card status-approved">
                    <div class="d-flex align-items-center">
                        <div class="status-icon text-success me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="status-title">Usulan Diterima</h3>
                            <p>Selamat! Usulan pembimbing Anda telah disetujui.</p>
                            <p><strong>Judul TA:</strong> {{ $usulan->judul_ta }}</p>
                            <p><strong>Disetujui pada:</strong> {{ $usulan->updated_at->format('d F Y H:i') }}</p>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="dosen-info">
                                        <h5>Dosen Pembimbing 1</h5>
                                        <p><strong>Nama:</strong> {{ $usulan->dosen1->nama }}</p>
                                        <p><strong>NIDN:</strong> {{ $usulan->dosen1->nidn }}</p>
                                        <p><strong>Email:</strong> {{ $usulan->dosen1->email }}</p>
                                    </div>
                                </div>
                                @if($usulan->id_dosen_2)
                                <div class="col-md-6">
                                    <div class="dosen-info">
                                        <h5>Dosen Pembimbing 2</h5>
                                        <p><strong>Nama:</strong> {{ $usulan->dosen2->nama }}</p>
                                        <p><strong>NIDN:</strong> {{ $usulan->dosen2->nidn }}</p>
                                        <p><strong>Email:</strong> {{ $usulan->dosen2->email }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($usulan->status == 'ditolak')
                <div class="status-card status-rejected">
                    <div class="d-flex align-items-center">
                        <div class="status-icon text-danger me-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <h3 class="status-title">Usulan Ditolak</h3>
                            <p>Maaf, usulan pembimbing Anda ditolak. Silakan ajukan ulang dengan data yang sesuai.</p>
                            <p><strong>Judul TA:</strong> {{ $usulan->judul_ta }}</p>
                            <p><strong>Ditolak pada:</strong> {{ $usulan->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if(!isset($usulan) || $usulan->status == 'ditolak')
            <div class="form-container">
                <div class="form-header">
                    <h2><i class="fas fa-file-signature"></i> Form Usulan Pembimbing Tugas Akhir</h2>
                    <p>Silakan lengkapi formulir berikut untuk mengajukan pembimbing tugas akhir Anda</p>
                </div>
              
                <div class="form-body">
                    <form action="{{ route('pengajuanpembimbing.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul_ta">
                                <i class="fas fa-heading"></i> Usulan Judul Tugas Akhir
                            </label>
                            <div class="input-wrapper">
                                <textarea id="judul_ta" name="judul_ta" rows="3" required placeholder="Tuliskan usulan judul tugas akhir Anda">{{ old('judul_ta', $usulan->judul_ta ?? '') }}</textarea>
                            </div>
                        </div>
                  
                        <div class="form-group">
                            <label for="dosen1">
                                <i class="fas fa-chalkboard-teacher"></i> Calon Dosen Pembimbing 1
                            </label>
                            <div class="input-wrapper">
                                <select id="dosen1" name="dosen1" required>
                                    <option value="">-- Pilih Dosen Pembimbing 1 --</option>
                                    @foreach($dosenList as $dosen)
                                        <option value="{{ $dosen->id }}" {{ old('dosen1', isset($usulan) && $usulan->id_dosen_1 == $dosen->id ? 'selected' : '') }}>
                                            {{ $dosen->nama }} ({{ $dosen->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                  
                        <div class="form-group">
                            <label for="dosen2">
                                <i class="fas fa-chalkboard-teacher"></i> Calon Dosen Pembimbing 2 (Opsional)
                            </label>
                            <div class="input-wrapper">
                                <select id="dosen2" name="dosen2">
                                    <option value="">-- Pilih Dosen Pembimbing 2 --</option>
                                    @foreach($dosenList as $dosen)
                                        <option value="{{ $dosen->id }}" {{ old('dosen2', isset($usulan) && $usulan->id_dosen_2 == $dosen->id ? 'selected' : '') }}>
                                            {{ $dosen->nama }} ({{ $dosen->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                  
                        <div class="form-footer">
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i> Kirim Usulan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
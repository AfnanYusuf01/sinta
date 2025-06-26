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

        /* Navigation */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 20px;
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .back-button i {
            margin-right: 8px;
            transition: var(--transition);
            color: #6c757d;
        }

        .back-button:hover {
            background-color: #e9ecef;
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #ced4da;
        }

        .back-button:hover i {
            transform: translateX(-3px);
            color: #495057;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .page-header h1 {
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .page-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            border-radius: 2px;
        }

        .page-header p {
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.05rem;
        }

        /* Status Cards */
        .status-container {
            max-width: 800px;
            margin: 0 auto 40px;
        }

        .status-card {
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            border-left: 5px solid transparent;
            transition: var(--transition);
        }

        .status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
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
            background-color: #FFF8E6;
            border-left-color: #FFC107;
        }

        .status-approved {
            background-color: #E8F5E9;
            border-left-color: #4CAF50;
        }

        .status-rejected {
            background-color: #FFEBEE;
            border-left-color: #F44336;
        }

        .status-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .status-title {
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--secondary);
        }

        .status-detail {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .status-detail-item {
            display: flex;
            margin-bottom: 8px;
        }

        .status-detail-item strong {
            min-width: 120px;
            color: var(--text-dark);
        }

        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            transition: var(--transition);
        }

        .form-container:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
            position: relative;
            overflow: hidden;
        }

        .form-header::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .form-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
        }

        .form-header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .form-body {
            padding: 30px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 25px;
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

        .form-group label i {
            color: var(--primary);
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
            padding: 12px 15px 12px 40px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: #f8fafc;
        }

        textarea {
            padding-left: 15px;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
            background-color: white;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Dosen Info */
        .dosen-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .dosen-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-top: 3px solid var(--primary);
            transition: var(--transition);
        }

        .dosen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .dosen-card h5 {
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dosen-card h5 i {
            font-size: 1.2rem;
        }

        .dosen-info-item {
            display: flex;
            margin-bottom: 10px;
        }

        .dosen-info-item strong {
            min-width: 80px;
            color: var(--text-dark);
        }

        /* Buttons */
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
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(227, 6, 19, 0.3);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        /* Alerts */
        .alert-custom {
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-left: 4px solid transparent;
        }

        .alert-custom i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                margin: 15px;
            }

            .form-header, .form-body {
                padding: 20px;
            }

            .status-card {
                padding: 20px;
            }

            .dosen-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.8rem;
            }

            .status-detail-item {
                flex-direction: column;
            }

            .status-detail-item strong {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('/') }}" class="back-button">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1>Pengajuan Pembimbing Tugas Akhir</h1>
            <p class="lead">Ajukan dosen pembimbing untuk tugas akhir Anda melalui form berikut</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Status Section -->
        @if(isset($usulan))
            <div class="status-container">
                @if($usulan->status == 'menunggu')
                    <div class="status-card status-waiting">
                        <div class="d-flex align-items-start">
                            <div class="status-icon text-warning me-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="status-title">Menunggu Persetujuan</h3>
                                <p>Usulan pembimbing Anda sedang dalam proses peninjauan oleh administrasi. Anda akan menerima notifikasi ketika status berubah.</p>

                                <div class="status-detail">
                                    <div class="status-detail-item">
                                        <strong>Judul TA:</strong>
                                        <span>{{ $usulan->judul_ta }}</span>
                                    </div>
                                    <div class="status-detail-item">
                                        <strong>Tanggal Pengajuan:</strong>
                                        <span>{{ $usulan->created_at->format('d F Y, H:i') }}</span>
                                    </div>
                                    <div class="status-detail-item">
                                        <strong>Pembimbing 1:</strong>
                                        <span>{{ $usulan->dosen1->nama ?? 'Belum ditentukan' }}</span>
                                    </div>
                                    @if($usulan->dosen2)
                                        <div class="status-detail-item">
                                            <strong>Pembimbing 2:</strong>
                                            <span>{{ $usulan->dosen2->nama }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($usulan->status == 'diterima')
                    <div class="status-card status-approved">
                        <div class="d-flex align-items-start">
                            <div class="status-icon text-success me-4">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h3 class="status-title">Usulan Diterima</h3>
                                <p>Selamat! Usulan pembimbing Anda telah disetujui. Berikut detail pembimbing yang telah ditetapkan:</p>

                                <div class="status-detail">
                                    <div class="status-detail-item">
                                        <strong>Judul TA:</strong>
                                        <span>{{ $usulan->judul_ta }}</span>
                                    </div>
                                    <div class="status-detail-item">
                                        <strong>Tanggal Disetujui:</strong>
                                        <span>{{ $usulan->updated_at->format('d F Y, H:i') }}</span>
                                    </div>
                                </div>

                                <div class="dosen-container mt-4">
                                    @foreach ($dosenPembimbing as $dosen)
                                        @php
                                            $jenis = '-';
                                            if ($dosen->relationLoaded('pembimbing') && $dosen->pembimbing) {
                                                $jenis = optional($dosen->pembimbing->first())->jenis_pembimbing ?? '-';
                                            }
                                        @endphp

                                        <div class="dosen-card">
                                            <h5>
                                                <i class="fas fa-user-tie"></i>
                                                Dosen Pembimbing {{ $jenis }}
                                            </h5>
                                            <div class="dosen-info-item">
                                                <strong>Nama:</strong>
                                                <span>{{ $dosen->nama }}</span>
                                            </div>
                                            <div class="dosen-info-item">
                                                <strong>NIP:</strong>
                                                <span>{{ $dosen->nip }}</span>
                                            </div>
                                            <div class="dosen-info-item">
                                                <strong>Email:</strong>
                                                <span>{{ $dosen->user->email ?? '-' }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($usulan->status == 'ditolak')
                    <div class="status-card status-rejected">
                        <div class="d-flex align-items-start">
                            <div class="status-icon text-danger me-4">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div>
                                <h3 class="status-title">Usulan Ditolak</h3>
                                <p>Maaf, usulan pembimbing Anda ditolak. Silakan periksa alasan penolakan dan ajukan ulang dengan data yang sesuai.</p>

                                <div class="status-detail">
                                    <div class="status-detail-item">
                                        <strong>Judul TA:</strong>
                                        <span>{{ $usulan->judul_ta }}</span>
                                    </div>
                                    <div class="status-detail-item">
                                        <strong>Tanggal Penolakan:</strong>
                                        <span>{{ $usulan->updated_at->format('d F Y, H:i') }}</span>
                                    </div>
                                    @if($usulan->catatan)
                                        <div class="status-detail-item">
                                            <strong>Catatan:</strong>
                                            <span class="text-danger">{{ $usulan->catatan }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Form Section -->
        @if(!isset($usulan) || $usulan->status == 'ditolak')
            <div class="form-container">
                <div class="form-header">
                    <h2><i class="fas fa-file-signature"></i> Form Usulan Pembimbing Tugas Akhir</h2>
                    @if(isset($usulan) && $usulan->status == 'ditolak')
                        <p>Silakan perbaiki dan kirim ulang usulan pembimbing Anda</p>
                    @else
                        <p>Lengkapi form berikut untuk mengajukan dosen pembimbing tugas akhir</p>
                    @endif
                </div>

                <div class="form-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-custom">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengajuanpembimbing.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="judul_ta">
                                <i class="fas fa-heading"></i> Usulan Judul Tugas Akhir
                            </label>
                            <div class="input-wrapper">
                                <textarea id="judul_ta" name="judul_ta" rows="3" required placeholder="Masukkan judul tugas akhir yang diajukan">{{ old('judul_ta', $usulan->judul_ta ?? '') }}</textarea>
                                <small class="text-muted">Pastikan judul jelas dan mencerminkan konten penelitian</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosen1">
                                        <i class="fas fa-chalkboard-teacher"></i> Calon Pembimbing Utama
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user-graduate"></i>
                                        <select id="dosen1" name="dosen1" required class="form-select">
                                            <option value="">-- Pilih Dosen Pembimbing 1 --</option>
                                            @foreach($dosenList as $dosen)
                                                <option value="{{ $dosen->id }}" {{ old('dosen1', isset($usulan) ? $usulan->id_dosen_1 : '') == $dosen->id ? 'selected' : '' }}>
                                                    {{ $dosen->gelar_depan }} {{ $dosen->nama }}, {{ $dosen->gelar_belakang }} ({{ $dosen->nidn }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosen2">
                                        <i class="fas fa-chalkboard-teacher"></i> Calon Pembimbing Pendamping (Opsional)
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user-graduate"></i>
                                        <select id="dosen2" name="dosen2" class="form-select">
                                            <option value="">-- Pilih Dosen Pembimbing 2 --</option>
                                            @foreach($dosenList as $dosen)
                                                <option value="{{ $dosen->id }}" {{ old('dosen2', isset($usulan) ? $usulan->id_dosen_2 : '') == $dosen->id ? 'selected' : '' }}>
                                                    {{ $dosen->gelar_depan }} {{ $dosen->nama }}, {{ $dosen->gelar_belakang }} ({{ $dosen->nidn }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer mt-4">
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i>
                                {{ isset($usulan) && $usulan->status == 'ditolak' ? 'Kirim Ulang Usulan' : 'Ajukan Pembimbing' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-info alert-custom">
                <h4><i class="fas fa-info-circle"></i> Status Pengajuan Pembimbing</h4>
                <p>Anda sudah memiliki pengajuan pembimbing dengan status: <strong class="text-capitalize">{{ $usulan->status }}</strong></p>
                <p class="mb-0">Silakan tunggu proses persetujuan dari administrasi atau hubungi koordinator TA jika membutuhkan bantuan.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation to form elements on focus
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = 'var(--primary)';
            });

            element.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#718096';
            });
        });
    </script>
</body>
</html>
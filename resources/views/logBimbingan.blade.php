<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Bimbingan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Add jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <style>
        :root {
            --primary-color: #E30613;
            --primary-light: rgba(227, 6, 19, 0.1);
            --primary-lighter: rgba(227, 6, 19, 0.05);
            --primary-dark: #c00511;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            margin-bottom: 2rem;
            border: none;
            border-radius: 10px;
            overflow: hidden;
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

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        .card-header h4 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-header i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .table th {
            background-color: var(--primary-lighter);
            color: var(--primary-color);
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table tr:hover {
            background-color: var(--primary-lighter);
        }

        .badge {
            font-size: 0.875em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-pdf {
            background-color: #d32f2f;
            border-color: #d32f2f;
            color: white;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-pdf:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
            color: white;
            transform: translateY(-2px);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(227, 6, 19, 0.25);
        }

        .alert {
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-left-color: #dc3545;
            color: #721c24;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-link {
            color: var(--primary-color);
        }

        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .table-responsive {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .card {
                margin-top: 1rem;
                margin-bottom: 1rem;
            }
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

    <!-- Page Header -->
        <div class="page-header">
            <h1>Log Bimbingan</h1>
            <p class="lead">Input log bimbingan setelah melakukan dengan dosen pembimbing</p>
        </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Input Log Bimbingan</h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Input Log Bimbingan -->
                        <form action="{{ route('log-bimbingan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-medium">Tanggal Bimbingan</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}">
                            </div>

                            <div class="mb-3">
                                <label for="id_dosen" class="form-label fw-medium">Dosen Pembimbing</label>
                                <select class="form-select" id="id_dosen" name="id_dosen" required>
                                    <option value="">Pilih Dosen Pembimbing</option>
                                    @foreach($dosen as $d)
                                        <option value="{{ $d->id }}" {{ old('id_dosen') == $d->id ? 'selected' : '' }}>
                                            {{ $d->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label fw-medium">Catatan Bimbingan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="4" required placeholder="Masukkan catatan bimbingan Anda...">{{ old('catatan') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Log Bimbingan
                            </button>
                        </form>

                        <!-- Tabel Riwayat Log Bimbingan -->
                        <div class="mt-5">
                            <h5 class="section-title">
                                <span><i class="fas fa-history me-2"></i>Riwayat Log Bimbingan</span>
                                <button id="downloadPdf" class="btn btn-pdf btn-sm">
                                    <i class="fas fa-file-pdf me-1"></i>Download PDF
                                </button>
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="logTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="20%">Dosen Pembimbing</th>
                                            <th>Catatan</th>
                                            <th width="15%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $index => $log)
                                            <tr>
                                                <td>{{ $logs->firstItem() + $index }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $log->dosen->nama }}</td>
                                                <td>{{ $log->catatan }}</td>
                                                <td class="text-center">
                                                    @if($log->nilai !== null)
                                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Disetujui</span>
                                                    @else
                                                        <span class="badge bg-warning"><i class="fas fa-clock me-1"></i>Menunggu</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <i class="fas fa-info-circle me-2"></i>Belum ada log bimbingan
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // PDF Download functionality
            document.getElementById('downloadPdf').addEventListener('click', function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Add title
                doc.setFontSize(18);
                doc.setTextColor(40);
                doc.text('Riwayat Log Bimbingan', 105, 15, { align: 'center' });

                // Add student info if available
                @if(auth()->user()->mahasiswa)
                doc.setFontSize(12);
                doc.text(`Nama: {{ auth()->user()->mahasiswa->nama }}`, 14, 25);
                doc.text(`NIM: {{ auth()->user()->mahasiswa->nim }}`, 14, 32);
                @endif

                // Add date
                doc.setFontSize(12);
                doc.text(`Dicetak pada: ${new Date().toLocaleDateString()}`, 105, 25, { align: 'center' });

                // Add table using autoTable plugin
                doc.autoTable({
                    html: '#logTable',
                    startY: 40,
                    theme: 'grid',
                    headStyles: {
                        fillColor: [227, 6, 19],
                        textColor: 255,
                        fontStyle: 'bold'
                    },
                    alternateRowStyles: {
                        fillColor: [245, 245, 245]
                    },
                    columnStyles: {
                        0: { cellWidth: 10 },
                        1: { cellWidth: 20 },
                        2: { cellWidth: 30 },
                        3: { cellWidth: 'auto' },
                        4: { cellWidth: 20 }
                    },
                    didParseCell: function(data) {
                        // Format status badges
                        if (data.column.index === 4) {
                            if (data.cell.text.includes('Disetujui')) {
                                data.cell.styles.fillColor = [40, 167, 69];
                                data.cell.styles.textColor = 255;
                            } else if (data.cell.text.includes('Menunggu')) {
                                data.cell.styles.fillColor = [255, 193, 7];
                                data.cell.styles.textColor = 0;
                            }
                        }
                    }
                });

                // Save the PDF
                doc.save('Riwayat_Log_Bimbingan.pdf');
            });
        });
    </script>
</body>
</html>
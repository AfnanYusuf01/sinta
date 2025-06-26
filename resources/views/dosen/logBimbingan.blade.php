<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Log Bimbingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 2rem;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 1.25rem 1.5rem;
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header i {
            font-size: 1.25rem;
            margin-right: 10px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table th {
            background-color: var(--primary-lighter);
            color: var(--primary-color);
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
        }

        .table tr:hover {
            background-color: var(--primary-lighter);
        }

        .badge {
            font-size: 0.85em;
            font-weight: 500;
            padding: 0.4em 0.7em;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
            color: #fff;
        }

        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.375rem 1rem;
            font-weight: 500;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .btn-pdf {
            background-color: #d32f2f;
            border-color: #d32f2f;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
            color: white;
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

        .modal-header {
            background-color: var(--primary-lighter);
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .card {
                margin-top: 1rem;
            }

            .table-responsive {
                border: none;
            }
        }

        /* Style untuk tombol kembali ke beranda (warna abu-abu) */
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
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <i class="fas fa-clipboard-check me-2"></i>Penilaian Log Bimbingan
                            </div>
                            <button id="downloadPdf" class="btn btn-pdf btn-sm">
                                <i class="fas fa-file-pdf me-1"></i>Download PDF
                            </button>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="logTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="12%">Tanggal</th>
                                            <th width="20%">Mahasiswa</th>
                                            <th width="15%">NIM</th>
                                            <th>Materi Bimbingan</th>
                                            <th width="10%">Status</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $index => $log)
                                            <tr>
                                                <td>{{ $logs->firstItem() + $index }}</td>
                                                <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $log->user->mahasiswa->nama }}</td>
                                                <td>{{ $log->user->mahasiswa->nim }}</td>
                                                <td>{{ $log->catatan }}</td>
                                                <td class="text-center">
                                                    @if($log->nilai !== null)
                                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Disetujui</span>
                                                    @else
                                                        <span class="badge bg-warning"><i class="fas fa-clock me-1"></i>Belum disetujui</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($log->nilai === null)
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal{{ $log->id }}">
                                                            <i class="fas fa-check me-1"></i>Setujui
                                                        </button>
                                                    @else
                                                        <span class="text-muted">Telah disetujui</span>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Modal Approve -->
                                            <div class="modal fade" id="approveModal{{ $log->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $log->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="approveModalLabel{{ $log->id }}"><i class="fas fa-check-circle me-2"></i>Setujui Log Bimbingan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('dosen.log-bimbingan.nilai', $log->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="nilai" value="100">
                                                            <div class="modal-body">
                                                                <div class="alert alert-success">
                                                                    <i class="fas fa-info-circle me-2"></i>Dengan menyetujui, log bimbingan ini akan mendapatkan nilai sempurna (100).
                                                                </div>
                                                                <div class="bg-light p-3 rounded">
                                                                    <h6 class="fw-bold mb-3" style="color: var(--primary-color);"><i class="fas fa-info-circle me-2"></i>Detail Bimbingan</h6>
                                                                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}</p>
                                                                    <p><strong>Mahasiswa:</strong> {{ $log->user->mahasiswa->nama }} ({{ $log->user->mahasiswa->nim }})</p>
                                                                    <p><strong>Materi:</strong> {{ $log->catatan }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                                                                <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i>Setujui</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="empty-state">
                                                    <i class="fas fa-inbox"></i>
                                                    <h5 class="mt-2">Tidak ada log bimbingan yang perlu disetujui</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                doc.text('Laporan Log Bimbingan', 105, 15, { align: 'center' });

                // Add date
                doc.setFontSize(12);
                doc.text(`Dicetak pada: ${new Date().toLocaleDateString()}`, 105, 22, { align: 'center' });

                // Add table using autoTable plugin
                doc.autoTable({
                    html: '#logTable',
                    startY: 30,
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
                        3: { cellWidth: 25 },
                        4: { cellWidth: 'auto' },
                        5: { cellWidth: 20 },
                        6: { cellWidth: 25 }
                    },
                    didParseCell: function(data) {
                        // Skip the action column (index 6)
                        if (data.column.index === 6) {
                            data.cell.text = '';
                        }

                        // Format status badges
                        if (data.column.index === 5) {
                            if (data.cell.text.includes('Disetujui')) {
                                data.cell.styles.fillColor = [40, 167, 69];
                                data.cell.styles.textColor = 255;
                            } else if (data.cell.text.includes('Belum disetujui')) {
                                data.cell.styles.fillColor = [255, 193, 7];
                                data.cell.styles.textColor = 0;
                            }
                        }
                    }
                });

                // Save the PDF
                doc.save('Laporan_Log_Bimbingan.pdf');
            });
        });
    </script>
</body>
</html>
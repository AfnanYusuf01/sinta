<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Persetujuan Proposal - Dosen</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #E30613;
            --primary-light: #FFEAEC;
            --primary-dark: #C00511;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: var(--primary);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem;
        }

        .table th {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .status-menunggu {
            background-color: #ffc107;
            color: #000;
        }

        .status-diterima {
            background-color: #28a745;
            color: white;
        }

        .status-ditolak {
            background-color: #dc3545;
            color: white;
        }

        .abstract-text {
            max-height: 100px;
            overflow: hidden;
            position: relative;
        }

        .abstract-text.expanded {
            max-height: none;
        }

        .read-more {
            color: var(--primary);
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-file-signature me-2"></i>Persetujuan Proposal Mahasiswa</h4>
                <a href="{{ url('/') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
            <div class="card-body">
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

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mahasiswa</th>
                                <th>Judul TA</th>
                                <th>Abstrak</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proposals as $proposal)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>{{ $proposal->mahasiswa->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $proposal->mahasiswa->nim }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $proposal->judul_ta }}</td>
                                    <td>
                                        <div class="abstract-text" id="abstract-{{ $proposal->id }}">
                                            {{ $proposal->abstrak }}
                                        </div>
                                        <span class="read-more" onclick="toggleAbstract({{ $proposal->id }})">Baca selengkapnya</span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $proposal->status }}">
                                            {{ ucfirst($proposal->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $proposal->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($proposal->status === 'menunggu')
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-approve btn-sm" onclick="handleAction('approve', {{ $proposal->id }})">
                                                    <i class="fas fa-check me-1"></i>Setujui
                                                </button>
                                                <button class="btn btn-reject btn-sm" onclick="handleAction('reject', {{ $proposal->id }})">
                                                    <i class="fas fa-times me-1"></i>Tolak
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x mb-3 text-muted d-block"></i>
                                        <p class="text-muted">Belum ada proposal yang perlu disetujui</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAbstract(id) {
            const abstract = document.getElementById(`abstract-${id}`);
            abstract.classList.toggle('expanded');
            const readMore = abstract.nextElementSibling;
            readMore.textContent = abstract.classList.contains('expanded') ? 'Sembunyikan' : 'Baca selengkapnya';
        }

        function handleAction(action, id) {
            const confirmMessage = action === 'approve'
                ? 'Apakah Anda yakin ingin menyetujui proposal ini?'
                : 'Apakah Anda yakin ingin menolak proposal ini?';

            if (confirm(confirmMessage)) {
                fetch(`/dosen/proposal/${action}/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat memproses permintaan');
                });
            }
        }
    </script>
</body>
</html>
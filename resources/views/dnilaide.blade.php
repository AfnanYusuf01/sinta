@extends('layouts.admin')

@section('title', 'Nilai Desk Evaluasi')

@section('page_title', 'Nilai Desk Evaluasi')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark mb-1">Nilai Desk Evaluasi</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboardadmin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Nilai Desk Evaluasi</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" onclick="exportData()">
                <i class="fas fa-download me-2"></i>Export Data
            </button>
            <button class="btn btn-success" onclick="refreshData()">
                <i class="fas fa-sync-alt me-2"></i>Refresh
    </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $nilaiDeskEvaluasi->groupBy('id_mahasiswa')->count() }}</h3>
                            <div>Total Mahasiswa</div>
                        </div>
                        <div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @php
                            $avgNilai = $nilaiDeskEvaluasi->groupBy('id_mahasiswa')
                                ->map(function($nilai) {
                                    return $nilai->avg('total_nilai') / 7;
                                })->avg() ?? 0;
                            @endphp
                            <h3 class="mb-0">{{ number_format($avgNilai, 2) }}</h3>
                            <div>Rata-rata Nilai</div>
                        </div>
                        <div>
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @php
                            $lulusCount = $nilaiDeskEvaluasi->groupBy('id_mahasiswa')
                                ->filter(function($nilai) {
                                    return ($nilai->avg('total_nilai') / 7) >= 70;
                                })->count();
                            @endphp
                            <h3 class="mb-0">{{ $lulusCount }}</h3>
                            <div>Lulus</div>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @php
                            $perbaikanCount = $nilaiDeskEvaluasi->groupBy('id_mahasiswa')
                                ->filter(function($nilai) {
                                    return ($nilai->avg('total_nilai') / 7) < 70;
                                })->count();
                            @endphp
                            <h3 class="mb-0">{{ $perbaikanCount }}</h3>
                            <div>Perlu Perbaikan</div>
                        </div>
                        <div>
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>

    <!-- Main Content Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-2"></i>Daftar Nilai Desk Evaluasi
                </h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="nilaiTable">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nama Mahasiswa</th>
                            <th>NIM</th>
          <th>Dosen Penguji</th>
                            <th>Nilai</th>
                            <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
                        @foreach($nilaiDeskEvaluasi->groupBy('id_mahasiswa') as $idMahasiswa => $nilaiGroup)
                        @php
                            $mahasiswa = $nilaiGroup->first()->mahasiswa;
                            $avgNilai = $nilaiGroup->avg('total_nilai') / 7;
                        @endphp
        <tr>
                            <td>{{ $nilaiGroup->max('created_at')->format('d/m/Y') }}</td>
                            <td>{{ $mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $mahasiswa->nim ?? '-' }}</td>
                            <td>
                                @foreach($nilaiGroup as $nilai)
                                    <div class="mb-1">
                                        {{ $nilai->dosen->nama ?? '-' }}
                                        <small class="d-block text-muted">
                                            Nilai: {{ number_format($nilai->total_nilai / 7, 2) }}
                                        </small>
                                    </div>
                                @endforeach
                            </td>
                            <td class="text-center fw-bold">{{ number_format($avgNilai, 2) }}</td>
                            <td class="text-center">
                                @if($avgNilai >= 70)
                                    <span class="badge bg-success">Lulus</span>
                                @else
                                    <span class="badge bg-warning">Perlu Perbaikan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info" onclick="showNilaiDeskEvaluasi({{ json_encode($nilaiGroup->pluck('id')) }})" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
  </div>
</div>

<!-- Modal Detail Nilai -->
<div class="modal fade" id="scoreModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
  <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Detail Nilai Desk Evaluasi</h5>
                <button type="button" class="btn-close btn-close-white" onclick="hideModal()"></button>
    </div>
    <div class="modal-body">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Mahasiswa</h6>
                            <p class="h5" id="modalStudentName"></p>
                            <p class="text-muted mb-0" id="modalStudentNim"></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Tanggal Evaluasi</h6>
                            <p class="h5" id="modalDate"></p>
                        </div>
                    </div>
                </div>

                <div id="nilaiContainer">
                    <!-- Nilai cards will be inserted here dynamically -->
      </div>

                <div class="card bg-light mt-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="card-title mb-0">Nilai Akhir Desk Evaluasi</h6>
                                <p class="text-muted small mb-0">Rata-rata dari semua nilai</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <h3 class="mb-0" id="finalScore"></h3>
                                <span class="badge" id="finalStatus"></span>
                            </div>
                        </div>
                    </div>
      </div>

                <div class="alert alert-danger mt-4">
                    <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Catatan:</h6>
                    <p class="mb-0">Nilai akhir merupakan rata-rata dari semua penilaian. Mahasiswa dinyatakan lulus jika nilai akhir ≥ 70.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideModal()">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('additional_styles')
<style>
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .btn-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
      justify-content: center;
    }

    .modal-header {
        border-radius: 6px 6px 0 0;
    }

    .table th {
        background-color: var(--gray-100);
      font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table-sm td {
        padding: 0.5rem;
        font-size: 0.875rem;
    }
  </style>
@endsection

@section('scripts')
@parent
  <script>
    $(document).ready(function() {
        $('#nilaiTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[0, 'desc']],
            "pageLength": 10
        });
    });

    async function showNilaiDeskEvaluasi(nilaiIds) {
      try {
            const responses = await Promise.all(nilaiIds.map(id => 
                fetch(`/admin/nilai-de/${id}`).then(res => res.json())
            ));

            if (responses.length === 0) {
                throw new Error('Tidak ada data nilai yang ditemukan');
      }

            const firstResponse = responses[0];
            document.getElementById('modalStudentName').textContent = firstResponse.mahasiswa?.nama || '-';
            document.getElementById('modalStudentNim').textContent = firstResponse.mahasiswa?.nim || '-';
            document.getElementById('modalDate').textContent = new Date(Math.max(...responses.map(r => new Date(r.created_at))))
                .toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

            const nilaiContainer = document.getElementById('nilaiContainer');
            nilaiContainer.innerHTML = '';

            let totalNilai = 0;

            responses.forEach((nilai, index) => {
                const nilaiSum = (nilai.nilai_1 + nilai.nilai_2 + nilai.nilai_3 + 
                                nilai.nilai_4 + nilai.nilai_5 + nilai.nilai_6 + 
                                nilai.nilai_7);
                const avgNilai = nilaiSum / 7;
                totalNilai += avgNilai;

                const card = document.createElement('div');
                card.className = 'card mb-4';
                card.innerHTML = `
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0">Nilai dari ${nilai.dosen?.nama || '-'}</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>1. Penguasaan Dasar Teori</td>
                                    <td width="60px">${nilai.nilai_1}</td>
                                </tr>
                                <tr>
                                    <td>2. Tingkat Penguasaan Materi</td>
                                    <td>${nilai.nilai_2}</td>
                                </tr>
                                <tr>
                                    <td>3. Tinjauan Pustaka</td>
                                    <td>${nilai.nilai_3}</td>
                                </tr>
                                <tr>
                                    <td>4. Kontribusi Praktis</td>
                                    <td>${nilai.nilai_4}</td>
                                </tr>
                                <tr>
                                    <td>5. Kontribusi Teoritis</td>
                                    <td>${nilai.nilai_5}</td>
                                </tr>
                                <tr>
                                    <td>6. Metodologi</td>
                                    <td>${nilai.nilai_6}</td>
                                </tr>
                                <tr>
                                    <td>7. Teknik Penulisan</td>
                                    <td>${nilai.nilai_7}</td>
                                </tr>
                                <tr class="table-light fw-bold">
                                    <td>Rata-rata</td>
                                    <td>${avgNilai.toFixed(2)}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
                nilaiContainer.appendChild(card);
            });

            const finalAvg = totalNilai / responses.length;
            document.getElementById('finalScore').textContent = finalAvg.toFixed(2);
            
            const finalStatus = document.getElementById('finalStatus');
            if (finalAvg >= 70) {
                finalStatus.className = 'badge bg-success';
                finalStatus.textContent = 'Lulus';
            } else {
                finalStatus.className = 'badge bg-warning';
                finalStatus.textContent = 'Perlu Perbaikan';
            }

            new bootstrap.Modal(document.getElementById('scoreModal')).show();
      } catch (error) {
            console.error('Error in showNilaiDeskEvaluasi:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal mengambil data nilai. Silakan coba lagi.'
            });
      }
    }

    function hideModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('scoreModal'));
        if (modal) {
            modal.hide();
        }
    }

    function exportData() {
        Swal.fire({
            icon: 'info',
            title: 'Ekspor Data',
            text: 'Fitur ekspor data akan segera tersedia.'
        });
    }

    function refreshData() {
        location.reload();
    }
  </script>
@endsection
@extends('layouts.admin')

@section('title', 'Nilai Literatur Review')

@section('page_title', 'Nilai Literatur Review')

@section('content')
<div class="row">
  <!-- Statistik Card -->
  <div class="col-md-3">
    <div class="card bg-primary text-white mb-4">
      <div class="card-body">
        <h5 class="card-title">Total Mahasiswa</h5>
        <h2 class="mb-0">{{ $nilaiLiteratur->groupBy('id_mahasiswa')->count() }}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-success text-white mb-4">
      <div class="card-body">
        <h5 class="card-title">Lulus</h5>
        <h2 class="mb-0">
          {{ $nilaiLiteratur->groupBy('id_mahasiswa')->filter(function($group) {
            $avgNilai = $group->avg(function($nilai) {
              return ($nilai->nilai_pemahaman + $nilai->nilai_analisis + 
                      $nilai->nilai_sintesis + $nilai->nilai_kesimpulan) / 4;
            });
            return $avgNilai >= 70;
          })->count() }}
        </h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-warning text-white mb-4">
      <div class="card-body">
        <h5 class="card-title">Perlu Perbaikan</h5>
        <h2 class="mb-0">
          {{ $nilaiLiteratur->groupBy('id_mahasiswa')->filter(function($group) {
            $avgNilai = $group->avg(function($nilai) {
              return ($nilai->nilai_pemahaman + $nilai->nilai_analisis + 
                      $nilai->nilai_sintesis + $nilai->nilai_kesimpulan) / 4;
            });
            return $avgNilai < 70;
          })->count() }}
        </h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-info text-white mb-4">
      <div class="card-body">
        <h5 class="card-title">Rata-rata Nilai</h5>
        <h2 class="mb-0">
          {{ number_format($nilaiLiteratur->avg(function($nilai) {
            return ($nilai->nilai_pemahaman + $nilai->nilai_analisis + 
                    $nilai->nilai_sintesis + $nilai->nilai_kesimpulan) / 4;
          }), 2) }}
        </h2>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h2 class="mb-0">Nilai Literatur Review</h2>
    <button class="btn btn-primary">
      <i class="fas fa-download me-1"></i>
      Export
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="nilaiTable">
        <thead class="table-primary">
          <tr>
            <th>Tanggal</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Pembimbing 1</th>
            <th>Pembimbing 2</th>
            <th>Nilai Rata-rata</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nilaiLiteratur->groupBy('id_mahasiswa') as $idMahasiswa => $nilaiGroup)
          @php
              $mahasiswa = $nilaiGroup->first()->mahasiswa;
              
              // Get pembimbing information from pembimbing table
              $pembimbing = $mahasiswa->pembimbing()->where('status', 'aktif')->get();
              $pembimbing1 = $pembimbing->where('jenis_pembimbing', 1)->first();
              $pembimbing2 = $pembimbing->where('jenis_pembimbing', 2)->first();
              
              // Get nilai for each pembimbing
              $nilaiP1 = $nilaiGroup->where('id_dosen', optional($pembimbing1)->id_dosen)->first();
              $nilaiP2 = $nilaiGroup->where('id_dosen', optional($pembimbing2)->id_dosen)->first();
              
              // Calculate average scores
              $totalNilai = 0;
              $pembimbingCount = 0;
              
              if ($nilaiP1) {
                  $nilaiP1Avg = ($nilaiP1->nilai_pemahaman + $nilaiP1->nilai_analisis + 
                             $nilaiP1->nilai_sintesis + $nilaiP1->nilai_kesimpulan) / 4;
                  $totalNilai += $nilaiP1Avg;
                  $pembimbingCount++;
              }
              
              if ($nilaiP2) {
                  $nilaiP2Avg = ($nilaiP2->nilai_pemahaman + $nilaiP2->nilai_analisis + 
                             $nilaiP2->nilai_sintesis + $nilaiP2->nilai_kesimpulan) / 4;
                  $totalNilai += $nilaiP2Avg;
                  $pembimbingCount++;
              }
              
              $avgNilai = $pembimbingCount > 0 ? $totalNilai / $pembimbingCount : 0;
          @endphp
          <tr>
            <td>{{ $nilaiGroup->max('created_at')->format('d/m/Y') }}</td>
            <td>{{ $mahasiswa->nama ?? '-' }}</td>
            <td>{{ $mahasiswa->nim ?? '-' }}</td>
            <td>
              @if($pembimbing1)
                <div class="d-flex flex-column">
                  <span>{{ optional($pembimbing1->dosen)->nama ?? '-' }}</span>
                  @if($nilaiP1)
                    <small class="text-muted">
                      Nilai: {{ number_format($nilaiP1Avg, 2) }}
                    </small>
                  @else
                    <small class="text-danger">Belum dinilai</small>
                  @endif
                </div>
              @else
                -
              @endif
            </td>
            <td>
              @if($pembimbing2)
                <div class="d-flex flex-column">
                  <span>{{ optional($pembimbing2->dosen)->nama ?? '-' }}</span>
                  @if($nilaiP2)
                    <small class="text-muted">
                      Nilai: {{ number_format($nilaiP2Avg, 2) }}
                    </small>
                  @else
                    <small class="text-danger">Belum dinilai</small>
                  @endif
                </div>
              @else
                -
              @endif
            </td>
            <td class="text-center">
              <span class="fw-bold">{{ number_format($avgNilai, 2) }}</span>
            </td>
            <td class="text-center">
              @if($avgNilai >= 70)
                <span class="badge bg-success">Lulus</span>
              @else
                <span class="badge bg-warning">Perlu Perbaikan</span>
              @endif
            </td>
            <td class="text-center">
              <button class="btn btn-sm btn-danger" onclick="showNilaiLiteratur([
                {{ $nilaiP1 ? $nilaiP1->id : 'null' }}, 
                {{ $nilaiP2 ? $nilaiP2->id : 'null' }}
              ])">
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

<!-- Modal -->
<div class="modal fade" id="scoreModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Detail Nilai Literatur Review</h5>
        <button type="button" class="btn-close btn-close-white" onclick="hideModal()"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-1">Mahasiswa</h6>
              <p class="mb-0 h5" id="modalStudentName">-</p>
              <small class="text-muted" id="modalStudentNim">-</small>
            </div>
            <div class="col-md-6 text-md-end">
              <h6 class="mb-1">Tanggal Penilaian</h6>
              <p class="mb-0" id="modalDate">-</p>
            </div>
          </div>
        </div>

        <div id="nilaiContainer">
          <!-- Nilai cards will be inserted here -->
        </div>

        <div class="card bg-light mt-4">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="card-title mb-0">Nilai Akhir Literatur Review</h5>
                <small class="text-muted">Rata-rata dari semua penilaian</small>
              </div>
              <div class="col-md-4 text-end">
                <h3 class="mb-0" id="finalScore">-</h3>
                <span class="badge" id="finalStatus">-</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('additional_styles')
<style>
  .modal-header .btn-close {
    padding: 0.5rem;
    margin: -0.5rem -0.5rem -0.5rem auto;
  }

  .nilai-card {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
  }

  .nilai-card:last-child {
    margin-bottom: 0;
  }

  .nilai-card-header {
    background-color: #dc3545;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 0.375rem 0.375rem 0 0;
  }

  .nilai-card-body {
    padding: 1rem;
  }

  .table th {
    background-color: #f8f9fa;
  }

  .badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
  }

  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  .btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
  }

  .modal.fade .modal-dialog {
    transition: transform .3s ease-out;
    transform: translate(0, -50px);
  }

  .modal.show .modal-dialog {
    transform: none;
  }
</style>
@endsection

@section('scripts')
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

  async function showNilaiLiteratur(nilaiIds) {
    try {
      const responses = await Promise.all(nilaiIds.map(id => {
        if (id === null) return Promise.resolve(null);
        return fetch(`/admin/nilai-literatur/${id}`).then(res => res.json());
      }));

      const validResponses = responses.filter(r => r !== null);
      if (validResponses.length === 0) {
        throw new Error('Tidak ada data nilai yang ditemukan');
      }

      const firstResponse = validResponses[0];
      document.getElementById('modalStudentName').textContent = firstResponse.mahasiswa?.nama || '-';
      document.getElementById('modalStudentNim').textContent = firstResponse.mahasiswa?.nim || '-';
      document.getElementById('modalDate').textContent = new Date(Math.max(...validResponses.map(r => new Date(r.created_at))))
        .toLocaleDateString('id-ID', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });

      const nilaiContainer = document.getElementById('nilaiContainer');
      nilaiContainer.innerHTML = '';

      let totalNilai = 0;
      let pembimbingCount = 0;

      validResponses.forEach((nilai, index) => {
        const nilaiAvg = (nilai.nilai_pemahaman + nilai.nilai_analisis + 
                         nilai.nilai_sintesis + nilai.nilai_kesimpulan) / 4;
        totalNilai += nilaiAvg;
        pembimbingCount++;

        const card = document.createElement('div');
        card.className = 'nilai-card';
        card.innerHTML = `
          <div class="nilai-card-header">
            <h6 class="mb-0">Nilai dari ${nilai.dosen?.nama || '-'}</h6>
          </div>
          <div class="nilai-card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered mb-0">
                <tbody>
                  <tr>
                    <td style="width: 60%">1. Pemahaman Literatur</td>
                    <td class="text-center">${nilai.nilai_pemahaman}</td>
                  </tr>
                  <tr>
                    <td>2. Analisis Literatur</td>
                    <td class="text-center">${nilai.nilai_analisis}</td>
                  </tr>
                  <tr>
                    <td>3. Sintesis Literatur</td>
                    <td class="text-center">${nilai.nilai_sintesis}</td>
                  </tr>
                  <tr>
                    <td>4. Kesimpulan</td>
                    <td class="text-center">${nilai.nilai_kesimpulan}</td>
                  </tr>
                  <tr class="table-light fw-bold">
                    <td>Rata-rata</td>
                    <td class="text-center">${nilaiAvg.toFixed(2)}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            ${nilai.catatan ? `
              <div class="mt-3">
                <h6 class="mb-2">Catatan:</h6>
                <p class="mb-0">${nilai.catatan}</p>
              </div>
            ` : ''}
          </div>
        `;
        nilaiContainer.appendChild(card);
      });

      const finalAvg = pembimbingCount > 0 ? totalNilai / pembimbingCount : 0;
      document.getElementById('finalScore').textContent = finalAvg.toFixed(2);
      
      const finalStatus = document.getElementById('finalStatus');
      if (finalAvg >= 70) {
        finalStatus.className = 'badge bg-success';
        finalStatus.textContent = 'Lulus';
      } else {
        finalStatus.className = 'badge bg-warning';
        finalStatus.textContent = 'Perlu Perbaikan';
      }

      $('#scoreModal').modal('show');
    } catch (error) {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
    }
  }

  function hideModal() {
    $('#scoreModal').modal('hide');
  }
</script>
@endsection
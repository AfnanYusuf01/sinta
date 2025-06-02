@extends('layouts.admin')

@section('title', 'Nilai Bimbingan Proposal TA')

@section('page_title', 'Nilai Bimbingan Proposal TA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nilai Bimbingan Tugas Akhir</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Nilai Bimbingan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Pembimbing 1</th>
                            <th>Nilai Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Nilai Pembimbing 2</th>
                            <th>Rata-rata Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilaiBimbingan as $index => $nilai)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $nilai['mahasiswa']->nama ?? '-' }}</td>
                                <td>{{ $nilai['mahasiswa']->nim ?? '-' }}</td>
                                <td>{{ $nilai['pembimbing1']->nama ?? '-' }}</td>
                                <td>{{ $nilai['nilai_pembimbing1'] ?? '-' }}</td>
                                <td>{{ $nilai['pembimbing2']->nama ?? '-' }}</td>
                                <td>{{ $nilai['nilai_pembimbing2'] ?? '-' }}</td>
                                <td>{{ $nilai['rata_rata'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="scoreModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">Detail Nilai Bimbingan Proposal TA</h3>
      <button class="close-btn" onclick="hideModal()">&times;</button>
    </div>
    <div class="modal-body">
      <div style="margin-bottom: 20px;">
        <h4 style="margin: 0 0 10px 0;">Mahasiswa: <span id="modalStudentName"></span></h4>
        <p style="margin: 0; color: var(--text-light);">Tanggal: <span id="modalDate"></span></p>
      </div>

      <div class="table-container">
        <table class="modal-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kriteria Penilaian</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Penguasaan Dasar Teori</td>
              <td><span id="nilai1"></span></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Tingkat Penguasaan Materi</td>
              <td><span id="nilai2"></span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Tinjauan Pustaka</td>
              <td><span id="nilai3"></span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Kontribusi Praktis</td>
              <td><span id="nilai4"></span></td>
            </tr>
            <tr>
              <td>5</td>
              <td>Kontribusi Teoritis</td>
              <td><span id="nilai5"></span></td>
            </tr>
            <tr>
              <td>6</td>
              <td>Teknis Penulisan</td>
              <td><span id="nilai6"></span></td>
            </tr>
            <tr>
              <td>7</td>
              <td>Format Penulisan</td>
              <td><span id="nilai7"></span></td>
            </tr>
            <tr style="font-weight: bold; background-color: var(--gray-light);">
              <td colspan="2">Nilai Rata-rata</td>
              <td><span id="modalTotalScore"></span></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="margin-top: 20px; padding: 16px; background-color: var(--primary-light); border-radius: 6px;">
        <h4 style="margin: 0 0 10px 0; color: var(--primary);">Catatan Tambahan:</h4>
        <p style="margin: 0;">Mahasiswa telah menunjukkan penguasaan materi yang baik, namun perlu memperhatikan teknis penulisan untuk meningkatkan kualitas proposal.</p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('additional_styles')
<style>
    .eye-icon {
      color: var(--primary);
      cursor: pointer;
      font-size: 1.1rem;
      padding: 8px;
      display: inline-block;
    }

    .eye-icon:hover {
      color: var(--primary-dark);
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background-color: white;
      width: 80%;
      max-width: 800px;
      border-radius: 8px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      max-height: 80vh;
      overflow-y: auto;
    }

    .modal-header {
      padding: 16px 24px;
      border-bottom: 1px solid var(--gray-medium);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0;
    }

    .close-btn {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--text-light);
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: var(--primary);
    }

    .modal-body {
      padding: 24px;
    }

    .modal-table {
      width: 100%;
      border-collapse: collapse;
    }

    .modal-table thead th {
      padding: 12px 16px;
      background-color: var(--primary);
      color: white;
      text-align: left;
      font-weight: 600;
    }

    .modal-table tbody td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--gray-medium);
    }

    .modal-table tbody tr:hover {
      background-color: var(--primary-light);
    }
  </style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});

async function showNilaiBimbingan(id) {
  try {
  const response = await fetch(`/admin/nilai-bimbingan/${id}`);
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
    const data = await response.json();

    document.getElementById('modalStudentName').textContent = data.mahasiswa.nama;
    document.getElementById('modalDate').textContent = new Date(data.created_at).toLocaleDateString();
    document.getElementById('modalLecturer').textContent = data.dosen.nama;

    // Update nilai-nilai
    const nilaiElements = {
      'nilai1': data.nilai_1,
      'nilai2': data.nilai_2,
      'nilai3': data.nilai_3,
      'nilai4': data.nilai_4,
      'nilai5': data.nilai_5,
      'nilai6': data.nilai_6,
      'nilai7': data.nilai_7
    };

    for (const [key, value] of Object.entries(nilaiElements)) {
      document.getElementById(key).textContent = value;
    }

    document.getElementById('modalTotalScore').textContent = data.total_nilai;

    // Show modal
    document.getElementById('scoreModal').classList.add('show');
  } catch (error) {
    console.error('Error:', error);
  alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
  }
}

function hideModal() {
  document.getElementById('scoreModal').classList.remove('show');
}

// Close modal when clicking outside of modal content
window.onclick = function(event) {
  const modal = document.getElementById('scoreModal');
  if (event.target === modal) {
    hideModal();
  }
}
</script>
@endsection
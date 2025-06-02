@extends('layouts.admin')

@section('title', 'Nilai Literatur Review')

@section('page_title', 'Nilai Literatur Review')

@section('content')
<div class="card">
  <div class="card-header">
    <h2>Nilai Literatur Review</h2>
    <button class="export-btn">
      <i class="fas fa-download"></i>
      Export
    </button>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nama Mahasiswa</th>
          <th>Dosen Pembimbing 1</th>
          <th>Dosen Pembimbing 2</th>
          <th>Nilai Rata-rata</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($nilaiLiteratur as $nilai)
        <tr>
          <td>{{ $nilai->created_at->format('Y-m-d') }}</td>
          <td>{{ $nilai->mahasiswa->nama ?? '-' }}</td>
          <td>{{ $nilai->dosen->nama ?? '-' }}</td>
          <td>{{ $nilai->dosen->nama ?? '-' }}</td>
          <td>{{ $nilai->total_nilai ?? '-' }}</td>
          <td>
            <i class="fas fa-eye eye-icon" onclick="showNilaiLiteratur({{ $nilai->id }})"></i>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="scoreModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">Detail Nilai Literatur Review</h3>
      <button class="close-btn" onclick="hideModal()">&times;</button>
    </div>
    <div class="modal-body">
      <p style="margin: 0; color: var(--text-light);">Dosen Penguji: <span id="modalLecturer"></span></p>
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
    <td>Pemahaman Literatur</td>
    <td><span id="nilai_pemahaman"></span></td>
  </tr>
  <tr>
    <td>2</td>
    <td>Analisis Literatur</td>
    <td><span id="nilai_analisis"></span></td>
  </tr>
  <tr>
    <td>3</td>
    <td>Sintesis Literatur</td>
    <td><span id="nilai_sintesis"></span></td>
  </tr>
  <tr>
    <td>4</td>
    <td>Kesimpulan</td>
    <td><span id="nilai_kesimpulan"></span></td>
  </tr>
  <tr style="font-weight: bold; background-color: var(--gray-light);">
    <td colspan="2">Total Nilai</td>
    <td><span id="modalTotalScore"></span></td>
  </tr>
</tbody>

        </table>
      </div>

      <div style="margin-top: 20px; padding: 16px; background-color: var(--primary-light); border-radius: 6px;">
        <h4 style="margin: 0 0 10px 0; color: var(--primary);">Catatan Tambahan:</h4>
       <p style="margin: 0;" id="modalCatatan"></p>

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
    async function showNilaiLiteratur(id) {
      try {
      const response = await fetch(`/admin/nilai-literatur/${id}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
        const data = await response.json();

        document.getElementById('modalStudentName').textContent = data.mahasiswa.nama;
        document.getElementById('modalDate').textContent = new Date(data.created_at).toLocaleDateString();
        document.getElementById('modalLecturer').textContent = data.dosen.nama;

       document.getElementById('nilai_pemahaman').textContent = data.nilai_pemahaman;
document.getElementById('nilai_analisis').textContent = data.nilai_analisis;
document.getElementById('nilai_sintesis').textContent = data.nilai_sintesis;
document.getElementById('nilai_kesimpulan').textContent = data.nilai_kesimpulan;

      document.getElementById('modalTotalScore').textContent = data.total_nilai;
      document.getElementById('modalCatatan').textContent = data.catatan || '-';


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
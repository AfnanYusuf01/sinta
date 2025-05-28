@extends('layouts.admin')

@section('title', 'Pendaftaran Proposal')

@section('page_title', 'Pendaftaran Proposal')

@section('content')
<div class="card">
  <div class="card-header">
    <h2>Pendaftaran Proposal</h2>
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
          <th>Judul Proposal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pendaftaranProposal as $proposal)
        <tr>
          <td>{{ $proposal->created_at->format('Y-m-d') }}</td>
          <td>{{ $proposal->mahasiswa->nama ?? '-' }}</td>
          <td>{{ $proposal->judul ?? '-' }}</td>
          <td>
            <span class="status-badge {{ strtolower($proposal->status) }}">
              {{ $proposal->status }}
            </span>
          </td>
          <td>
            <i class="fas fa-eye eye-icon" onclick="showProposalDetail({{ $proposal->id }})"></i>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="proposalModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">Detail Pendaftaran Proposal</h3>
      <button class="close-btn" onclick="hideModal()">&times;</button>
    </div>
    <div class="modal-body">
      <div class="proposal-info">
        <div class="info-group">
          <label>Nama Mahasiswa:</label>
          <span id="modalStudentName"></span>
        </div>
        <div class="info-group">
          <label>NIM:</label>
          <span id="modalNIM"></span>
        </div>
        <div class="info-group">
          <label>Program Studi:</label>
          <span id="modalProdi"></span>
        </div>
        <div class="info-group">
          <label>Tanggal Pengajuan:</label>
          <span id="modalDate"></span>
        </div>
      </div>

      <div class="proposal-detail">
        <h4>Detail Proposal</h4>
        <div class="info-group">
          <label>Judul Proposal:</label>
          <p id="modalTitle"></p>
        </div>
        <div class="info-group">
          <label>Deskripsi:</label>
          <p id="modalDescription"></p>
        </div>
        <div class="info-group">
          <label>Bidang Penelitian:</label>
          <p id="modalResearchField"></p>
        </div>
      </div>

      <div class="document-section">
        <h4>Dokumen Pendukung</h4>
        <div class="document-list" id="modalDocuments">
          <!-- Documents will be inserted here -->
        </div>
      </div>

      <div class="status-section">
        <h4>Status Pengajuan</h4>
        <div class="status-info">
          <div class="current-status">
            <label>Status Saat Ini:</label>
            <span id="modalStatus" class="status-badge"></span>
          </div>
          <div class="status-update">
            <label>Update Status:</label>
            <select id="statusUpdate" class="form-select">
              <option value="pending">Pending</option>
              <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
            </select>
            <button onclick="updateStatus()" class="btn btn-primary">
              Update Status
            </button>
          </div>
        </div>
      </div>

      <div class="notes-section">
        <h4>Catatan Admin</h4>
        <textarea id="adminNotes" class="form-control" rows="4" placeholder="Tambahkan catatan untuk mahasiswa..."></textarea>
        <button onclick="saveNotes()" class="btn btn-primary mt-2">
          Simpan Catatan
        </button>
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

  .status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: 500;
  }

  .status-badge.pending {
    background-color: #FFF3CD;
    color: #856404;
  }

  .status-badge.approved {
    background-color: #D4EDDA;
    color: #155724;
  }

  .status-badge.rejected {
    background-color: #F8D7DA;
    color: #721C24;
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

  .proposal-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }

  .info-group {
    margin-bottom: 16px;
  }

  .info-group label {
    display: block;
    font-weight: 500;
    color: var(--text-light);
    margin-bottom: 4px;
  }

  .info-group p {
      margin: 0;
    }

  .proposal-detail {
    background-color: var(--gray-light);
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
  }

  .proposal-detail h4 {
    margin: 0 0 16px 0;
      color: var(--primary);
    }

  .document-section {
    margin-bottom: 24px;
  }

  .document-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
  }

  .document-item {
    background-color: var(--gray-light);
    padding: 12px;
    border-radius: 6px;
      display: flex;
      align-items: center;
    gap: 8px;
  }

  .document-item i {
    color: var(--primary);
  }

  .status-section {
      background-color: var(--primary-light);
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
  }

  .status-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
    gap: 24px;
  }

  .status-update {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .form-select {
    padding: 8px 12px;
    border: 1px solid var(--gray-medium);
    border-radius: 4px;
    background-color: white;
    }

    .btn {
      padding: 8px 16px;
    border-radius: 4px;
    border: none;
      cursor: pointer;
    font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-dark);
    }

  .notes-section textarea {
      width: 100%;
    padding: 12px;
    border: 1px solid var(--gray-medium);
    border-radius: 4px;
    resize: vertical;
  }

  .mt-2 {
    margin-top: 8px;
  }
</style>
@endsection

@section('scripts')
<script>
  async function showProposalDetail(id) {
    try {
      const response = await fetch(`/admin/pendaftaran-proposal/${id}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();

      // Update modal content
      document.getElementById('modalStudentName').textContent = data.mahasiswa.nama;
      document.getElementById('modalNIM').textContent = data.mahasiswa.nim;
      document.getElementById('modalProdi').textContent = data.mahasiswa.prodi;
      document.getElementById('modalDate').textContent = new Date(data.created_at).toLocaleDateString();
      document.getElementById('modalTitle').textContent = data.judul;
      document.getElementById('modalDescription').textContent = data.deskripsi;
      document.getElementById('modalResearchField').textContent = data.bidang_penelitian;
      document.getElementById('modalStatus').textContent = data.status;
      document.getElementById('modalStatus').className = `status-badge ${data.status.toLowerCase()}`;
      document.getElementById('statusUpdate').value = data.status.toLowerCase();
      document.getElementById('adminNotes').value = data.catatan_admin || '';

      // Update documents list
      const documentsList = document.getElementById('modalDocuments');
      documentsList.innerHTML = '';
      data.documents.forEach(doc => {
        const docItem = document.createElement('div');
        docItem.className = 'document-item';
        docItem.innerHTML = `
          <i class="fas fa-file-pdf"></i>
          <span>${doc.name}</span>
          <a href="${doc.url}" target="_blank" class="btn btn-sm btn-primary">
            <i class="fas fa-download"></i>
          </a>
        `;
        documentsList.appendChild(docItem);
      });

      // Show modal
      document.getElementById('proposalModal').classList.add('show');
    } catch (error) {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
    }
  }

  async function updateStatus() {
    const proposalId = currentProposalId; // You need to store this when opening the modal
    const newStatus = document.getElementById('statusUpdate').value;

    try {
      const response = await fetch(`/admin/pendaftaran-proposal/${proposalId}/status`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: newStatus })
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      // Update the status badge in the modal
      const statusBadge = document.getElementById('modalStatus');
      statusBadge.textContent = newStatus.toUpperCase();
      statusBadge.className = `status-badge ${newStatus}`;

      // Update the status in the table
      const tableRow = document.querySelector(`tr[data-proposal-id="${proposalId}"]`);
      if (tableRow) {
        const statusCell = tableRow.querySelector('.status-badge');
        statusCell.textContent = newStatus.toUpperCase();
        statusCell.className = `status-badge ${newStatus}`;
      }

      alert('Status berhasil diperbarui');
    } catch (error) {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.');
    }
  }

  async function saveNotes() {
    const proposalId = currentProposalId; // You need to store this when opening the modal
    const notes = document.getElementById('adminNotes').value;

    try {
      const response = await fetch(`/admin/pendaftaran-proposal/${proposalId}/notes`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notes: notes })
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      alert('Catatan berhasil disimpan');
    } catch (error) {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat menyimpan catatan. Silakan coba lagi.');
    }
  }

  function hideModal() {
    document.getElementById('proposalModal').classList.remove('show');
  }

  // Close modal when clicking outside of modal content
  window.onclick = function(event) {
    const modal = document.getElementById('proposalModal');
    if (event.target === modal) {
      hideModal();
    }
  }
  </script>
@endsection
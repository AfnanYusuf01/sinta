@extends('layouts.admin')

@section('title', 'Penilaian Log Bimbingan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-journal-text me-2"></i>Penilaian Log Bimbingan
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Materi Bimbingan</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
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
                                        <td>
                                            @if($log->nilai !== null)
                                                {{ $log->nilai }}
                                            @else
                                                <span class="badge bg-warning">Belum dinilai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($log->nilai === null)
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nilaiModal{{ $log->id }}">
                                                    Beri Nilai
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#nilaiModal{{ $log->id }}">
                                                    Edit Nilai
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Penilaian -->
                                    <div class="modal fade" id="nilaiModal{{ $log->id }}" tabindex="-1" aria-labelledby="nilaiModalLabel{{ $log->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="nilaiModalLabel{{ $log->id }}">Penilaian Log Bimbingan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('dosen.log-bimbingan.nilai', $log->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nilai{{ $log->id }}" class="form-label">Nilai (0-100)</label>
                                                            <input type="number" class="form-control" id="nilai{{ $log->id }}" name="nilai" min="0" max="100" value="{{ $log->nilai }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Detail Bimbingan:</label>
                                                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}</p>
                                                            <p><strong>Mahasiswa:</strong> {{ $log->user->mahasiswa->nama }} ({{ $log->user->mahasiswa->nim }})</p>
                                                            <p><strong>Materi:</strong> {{ $log->catatan }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada log bimbingan yang perlu dinilai</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
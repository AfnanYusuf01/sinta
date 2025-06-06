@extends('layouts.admin')

@section('title', 'Import Data Mahasiswa')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Import Data Mahasiswa</h4>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label d-block">Tipe Import</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type_mahasiswa" value="mahasiswa" checked>
                                <label class="form-check-label" for="type_mahasiswa">
                                    Mahasiswa
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type_dosen" value="dosen">
                                <label class="form-check-label" for="type_dosen">
                                    Dosen
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File Excel/CSV</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv">
                            <div class="form-text">
                                Format file yang didukung: Excel (.xlsx, .xls) atau CSV
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="btn-group">
                                <a href="{{ route('admin.users.template.mahasiswa') }}" class="btn btn-info">
                                    <i class="fas fa-download me-2"></i>Download Template Mahasiswa
                                </a>
                                <a href="{{ route('admin.users.template.dosen') }}" class="btn btn-info ms-2">
                                    <i class="fas fa-download me-2"></i>Download Template Dosen
                                </a>
                            </div>
                            <div class="form-text mt-2">
                                Format kolom untuk Mahasiswa: nama, email, password, nim, prodi, angkatan<br>
                                Format kolom untuk Dosen: nama, email, password, nip, bidang_keahlian
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Import Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .back-button {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #bb2d3b;
            color: white;
            text-decoration: none;
        }

        .profile-header {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .card {
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="profile-header">
        <div class="profile-container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Profile</h1>
                <a href="{{ route('index') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="profile-container">
        <div class="card">
            <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

        <div class="card">
            <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        <div class="card">
            <div class="card-body">
                    @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

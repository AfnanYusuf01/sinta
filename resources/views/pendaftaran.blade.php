<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran</title>
    <style>
        :root {
            --primary-color: #E30613;
            --primary-dark: #B0050F;
            --primary-light: #FF6B74;
            --secondary-color: #F8F8F8;
            --text-dark: #333333;
            --text-light: #FFFFFF;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #F8F8F8 0%, #F0F0F0 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-dark);
        }
        /* Style untuk tombol kembali ke beranda (warna abu-abu) */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 20px;
            background-color: #f8f9fa; /* Warna abu-abu muda */
            color: #495057; /* Warna teks abu-abu gelap */
            border: 1px solid #dee2e6; /* Border abu-abu */
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .back-button i {
            margin-right: 8px;
            transition: var(--transition);
            color: #6c757d; /* Warna icon abu-abu */
        }

        .back-button:hover {
            background-color: #e9ecef; /* Warna abu-abu sedikit lebih gelap saat hover */
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #ced4da;
        }

        .back-button:hover i {
            transform: translateX(-3px);
            color: #495057;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            text-align: center;
            margin-bottom: 50px;
            padding: 30px 0;
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-color);
        }
        
        header h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        header p {
            font-size: 1.1rem;
            color: var(--text-dark);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 0 auto;
        }
        
        .menu-item {
            background: #ffffff;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .menu-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(227, 6, 19, 0.2);
            border-color: var(--primary-color);
        }
        
        .menu-item:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .menu-item a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 1.2rem;
            font-weight: 600;
            display: block;
            transition: color 0.3s;
            position: relative;
            z-index: 1;
        }
        
        .menu-item:hover a {
            color: var(--primary-color);
        }
        
        .menu-item i {
            display: block;
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }
            
            .menu-container {
                grid-template-columns: 1fr;
            }
        }

        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container">
    <!-- Tombol Kembali ke Beranda -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{ url('/') }}" class="back-button">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    <header>
        <h1>Halaman Pendaftaran</h1>
        <p>Pilih salah satu menu di bawah untuk mendaftar ke proses akademik Anda</p>
    </header>

    <div class="menu-container">
        <div class="menu-item">
            <i class="fas fa-file-alt"></i>
            <a href="{{ url('/pengajuan') }}">Pengajuan</a>
        </div>
        <div class="menu-item">
            <i class="fas fa-file-contract"></i>
            <a href="{{ url('/perpanjangan') }}">Perpanjangan</a>
        </div>
        <div class="menu-item">
            <i class="fas fa-chalkboard-teacher"></i>
            <a href="{{ url('/deskevaluasi') }}">Desk Evaluasi</a>
        </div>
        <div class="menu-item">
            <i class="fas fa-graduation-cap"></i>
            <a href="{{ url('/pendaftaranproposal') }}">Pendaftaran Proposal</a>
        </div>
    </div>
</div>

<footer>
    &copy; 2025 Sistem Pendaftaran Akademik - Telkom University Purwokerto 
</footer>

</body>
</html>
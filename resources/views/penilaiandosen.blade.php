<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Penilaian Proposal TA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #E30613;
      --primary-dark: #C00511;
      --primary-light: #FF6B74;
      --secondary: #1A1A2E;
      --accent: #E30613;
      --text-dark: #2D3748;
      --text-light: #F8F9FA;
      --bg-light: #F8F8F8;
      --card-bg: rgba(255, 255, 255, 0.98);
      --shadow: 0 8px 30px rgba(26, 26, 46, 0.12);
      --glow: 0 0 15px rgba(227, 6, 19, 0.15);
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--bg-light);
      color: var(--text-dark);
      min-height: 100vh;
      background-image: 
        radial-gradient(circle at 10% 20%, rgba(227, 6, 19, 0.03) 0%, transparent 25%),
        radial-gradient(circle at 90% 80%, rgba(227, 6, 19, 0.03) 0%, transparent 25%);
      padding: 3rem 1.5rem;
    }
    
    .header {
      text-align: center;
      margin-bottom: 3rem;
      position: relative;
    }
    
    h1 {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--secondary);
      margin-bottom: 0.5rem;
      position: relative;
      display: inline-block;
    }
    
    h1::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      border-radius: 2px;
    }
    
    .subtitle {
      color: #4A5568;
      font-size: 1.1rem;
      max-width: 600px;
      margin: 0 auto;
    }
    
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 2rem 1.5rem;
      box-shadow: var(--shadow);
      text-align: center;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.4);
    }
    
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: linear-gradient(to bottom, var(--primary), var(--accent));
    }
    
    .card:hover {
      transform: translateY(-8px);
      box-shadow: var(--glow), var(--shadow);
    }
    
    .card h2 {
      color: var(--secondary);
      font-weight: 600;
      font-size: 1.5rem;
      margin-bottom: 1rem;
      line-height: 1.4;
    }
    
    .card-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 1.5rem;
      display: inline-block;
    }
    
    .card-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-top: 1.5rem;
      padding: 0.8rem 1.8rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(227, 6, 19, 0.2);
      border: none;
      font-size: 0.95rem;
      width: 80%;
      max-width: 200px;
    }
    
    .card-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(227, 6, 19, 0.3);
      background: linear-gradient(135deg, var(--primary-dark), var(--primary));
    }
    
    .card-btn i {
      margin-left: 8px;
      transition: transform 0.3s ease;
    }
    
    .card-btn:hover i {
      transform: translateX(4px);
    }
    
    @media (max-width: 768px) {
      body {
        padding: 2rem 1rem;
      }
      
      h1 {
        font-size: 1.8rem;
      }
      
      .grid-container {
        grid-template-columns: 1fr;
      }
    }

    .subtitle {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 30px;
            display: block;
        }

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

  <div class="header">
    <h1>Formulir Penilaian Proposal Tugas Akhir</h1>
    <p class="subtitle">Pilih formulir penilaian yang sesuai dengan kebutuhan evaluasi tugas akhir</p>
  </div>

  <div class="grid-container">
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-user-graduate"></i>
      </div>
      <h2>Formulir Nilai Bimbingan Proposal TA</h2>
      <a href="{{ url('/nilaibimbingan') }}" class="card-btn">
        Isi Formulir <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-file-alt"></i>
      </div>
      <h2>Formulir Nilai Desk Evaluasi</h2>
      <a href="{{ url('/nilaideskevaluasi') }}" class="card-btn">
        Isi Formulir <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <h2>Formulir Nilai Presentasi Proposal TA</h2>
      <a href="{{ url('/nilaipresentasiproposalta') }}" class="card-btn">
        Isi Formulir <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-book-open"></i>
      </div>
      <h2>Formulir Nilai Literatur Review Proposal TA</h2>
      <a href="{{ url('/nilailiteratur') }}" class="card-btn">
        Isi Formulir <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

</body>
</html>
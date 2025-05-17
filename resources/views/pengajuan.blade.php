<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan TA1 FIF | IT Telkom Purwokerto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #E30613;
            --primary-dark: #C00511;
            --primary-light: #FF4757;
            --secondary: #0F172A;
            --accent: #E30613;
            --text-dark: #1E293B;
            --text-light: #F8FAFC;
            --bg-light: #F1F5F9;
            --border: #E2E8F0;
            --card-bg: rgba(255, 255, 255, 0.95);
            --shadow: 0 4px 30px rgba(255, 0, 0, 0.15);
            --glow: 0 0 10px rgba(227, 6, 19, 0.3);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(227, 6, 19, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(227, 6, 19, 0.03) 0%, transparent 20%);
        }
        
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .form-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 40px;
            backdrop-filter: blur(5px);
            border: 1px solid #ffffff;
            position: relative;
            overflow: hidden;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
        }
        
        header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        
        .logo {
            width: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(var(--glow));
        }
        
        h1 {
            color: var(--secondary);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .subtitle {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 30px;
            display: block;
        }
        
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        
        .form-group {
            margin-bottom: 8px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        label {
            display: block;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 0.95rem;
            position: relative;
        }
        
        label.required::after {
            content: '*';
            color: var(--primary);
            margin-left: 4px;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: rgba(255, 255, 255, 0.8);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
            background-color: white;
        }
        
        input[readonly] {
            background-color: var(--bg-light);
            color: #64748B;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .file-upload {
            position: relative;
        }
        
        .file-upload input {
            padding: 12px;
            border: 1px dashed var(--border);
            background-color: rgba(241, 245, 249, 0.5);
        }
        
        .file-upload::before {
            content: 'Unggah File';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            pointer-events: none;
        }
        
        .help-text {
            font-size: 0.85rem;
            color: #64748B;
            margin-top: 6px;
            display: block;
        }
        
        .help-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .help-text a:hover {
            text-decoration: underline;
        }
        
        .submit-section {
            grid-column: span 2;
            text-align: center;
            margin-top: 20px;
        }
        
        button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 16px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(227, 6, 19, 0.1);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(227, 6, 19, 0.2);
        }
        
        button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
        }
        
        button:hover::after {
            left: 100%;
        }
        
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            .submit-section {
                grid-column: span 1;
            }
            
            .form-card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <header>
                <!-- Replace with actual logo -->
                <div class="logo" style="height: 40px; background: var(--border); display: flex; align-items: center; justify-content: center;">
                    <img src="assets/img/logo.jpeg" alt="Logo FIF" style="height: 100%; object-fit: contain;">
                </div>                  
                <h1>Formulir Pengajuan Tugas Akhir 1</h1>
                <span class="subtitle">Fakultas Informatika</span>
            </header>
            
            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email" class="required">Email</label>
                    <input type="email" id="email" name="email" value="21102231@ittelkom-pwt.ac.id" required readonly>
                </div>
                
                <div class="form-group">
                    <label for="nim" class="required">NIM</label>
                    <input type="text" id="nim" name="nim" required>
                </div>
                
                <div class="form-group">
                    <label for="nama" class="required">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="prodi" class="required">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" required>
                </div>
                
                <div class="form-group">
                    <label for="peminatan" class="required">Peminatan</label>
                    <input type="text" id="peminatan" name="peminatan" required>
                </div>
                
                <div class="form-group full-width">
                    <label for="judul" class="required">Usulan Judul/Topik Penelitian</label>
                    <textarea id="judul" name="judul" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="pembimbing1" class="required">Usulan Pembimbing 1</label>
                    <input type="text" id="pembimbing1" name="pembimbing1" required>
                </div>
                
                <div class="form-group">
                    <label for="pembimbing2">Usulan Pembimbing 2</label>
                    <input type="text" id="pembimbing2" name="pembimbing2">
                </div>
                
                <div class="form-group">
                    <label for="sks" class="required">Total SKS Lulus</label>
                    <input type="number" id="sks" name="sks" required>
                </div>
                
                <div class="form-group full-width">
                    <label for="lampiran" class="required">Lampiran Dokumen Usulan</label>
                    <div class="file-upload">
                        <input type="file" id="lampiran" name="lampiran" accept=".pdf" required>
                    </div>
                    <span class="help-text">Format file: PDF (maks. 10MB). Unduh template: <a href="link-ke-dokumen">Lembar Pengajuan Tema</a></span>
                </div>
                
                <div class="submit-section">
                    <button type="submit">
                        <span>Kirim Pengajuan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

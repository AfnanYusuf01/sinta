<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Penguji Tugas Akhir | Universitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #E30613; /* Warna merah utama */
            --secondary-color: #c00511; /* Warna merah lebih gelap */
            --accent-color: #FF6B6B; /* Warna aksen */
            --light-color: #f8f9fa; /* Warna latar light */
            --text-dark: #333333; /* Warna teks gelap */
            --text-light: #ffffff; /* Warna teks terang */
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            font-family: 'Segoe UI', 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.6;
        }
        
        .document-container {
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
        }
        
        .document-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            padding: 25px 40px;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .document-header h2 {
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.5px;
            font-size: 1.5rem;
        }
        
        .document-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), rgba(255, 107, 107, 0.5));
        }
        
        .university-logo {
            height: 50px;
            max-width: 150px;
            object-fit: contain;
        }
        
        .year-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 20px 40px;
            background-color: var(--light-color);
            border-bottom: 1px solid #e0e0e0;
        }
        
        .year-btn {
            padding: 8px 22px;
            border: 1px solid #e0e0e0;
            border-radius: 30px;
            background: white;
            color: var(--text-dark);
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .year-btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .year-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.2);
        }
        
        .semester-tabs {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            padding: 0 40px;
        }
        
        .semester-tab {
            padding: 10px 30px;
            cursor: pointer;
            border-radius: 6px;
            margin: 0 8px;
            font-weight: 500;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }
        
        .semester-tab.active {
            background-color: rgba(227, 6, 19, 0.1);
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            font-weight: 600;
        }
        
        .semester-tab:not(.active):hover {
            background-color: rgba(227, 6, 19, 0.05);
        }
        
        .document-body {
            padding: 30px 40px;
        }
        
        .pdf-viewer-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
        }
        
        .pdf-viewer-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .pdf-viewer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .btn-download {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            letter-spacing: 0.5px;
        }
        
        .btn-download:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(227, 6, 19, 0.3);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 40px;
            background-color: #fafafa;
            border-radius: 8px;
            border: 2px dashed #e0e0e0;
            margin-bottom: 30px;
            transition: var(--transition);
        }
        
        .empty-state:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state-icon {
            font-size: 64px;
            color: #e0e0e0;
            margin-bottom: 20px;
            transition: var(--transition);
        }
        
        .empty-state h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            color: #7f8c8d;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .btn-back {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
            z-index: 1000;
            border: none;
            cursor: pointer;
        }
        
        .btn-back:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
            color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 992px) {
            .document-container {
                margin: 30px 20px;
            }
            
            .document-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
                padding: 20px;
            }
            
            .document-body {
                padding: 20px 25px;
            }
            
            .year-nav {
                padding: 15px 20px;
                justify-content: center;
            }
            
            .semester-tabs {
                padding: 0 20px;
            }
            
            .university-logo {
                height: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .document-container {
                margin: 20px 15px;
                border-radius: 8px;
            }
            
            .document-body {
                padding: 20px;
            }
            
            .semester-tabs {
                flex-direction: column;
                align-items: stretch;
                padding: 0;
                gap: 8px;
            }
            
            .semester-tab {
                width: 100%;
                text-align: center;
                margin: 0;
                padding: 12px;
            }
            
            .btn-back {
                width: 50px;
                height: 50px;
                font-size: 20px;
                bottom: 20px;
                right: 20px;
            }
            
            .empty-state {
                padding: 40px 20px;
            }
            
            .empty-state-icon {
                font-size: 48px;
            }
        }
    </style>
</head>
<body>
    <div class="document-container">
        <!-- Header -->
        <div class="document-header">
            <h2><i class="fas fa-file-contract me-2"></i> SK Penguji Tugas Akhir</h2>
            <img src="assets/img/logo.png" alt="Logo Universitas" class="university-logo">
        </div>
        
        <!-- Navigasi Tahun -->
        <div class="year-nav">
            <div class="year-btn active" onclick="showYear(2025)">2025-2026</div>
            <div class="year-btn" onclick="showYear(2024)">2024-2025</div>
            <div class="year-btn" onclick="showYear(2023)">2023-2024</div>
            <div class="year-btn" onclick="showYear(2022)">2022-2023</div>
            <div class="year-btn" onclick="showYear(2021)">2021-2022</div>
        </div>
        
        <!-- Tab Semester -->
        <div class="semester-tabs">
            <div class="semester-tab active" onclick="showSemester('ganjil')">Semester Ganjil</div>
            <div class="semester-tab" onclick="showSemester('genap')">Semester Genap</div>
        </div>
        
        <!-- Konten Dokumen -->
        <div class="document-body">
            <div id="pdf-viewer-container" class="pdf-viewer-container">
                <iframe id="pdf-viewer" class="pdf-viewer" src="files/sk_penguji/sk_penguji_ganjil_2025.pdf" frameborder="0"></iframe>
            </div>
            
            <div class="text-center">
                <a id="download-link" href="files/sk_penguji/sk_penguji_ganjil_2025.pdf" class="btn btn-download" download>
                    <i class="fas fa-download"></i> Download SK Penguji Ganjil 2025
                </a>
            </div>
            
            <div id="empty-state" class="empty-state" style="display: none;">
                <div class="empty-state-icon">
                    <i class="fas fa-file-search"></i>
                </div>
                <h4>Dokumen Belum Tersedia</h4>
                <p>Surat Keputusan Penguji untuk periode ini sedang dalam proses persiapan. Silakan cek kembali beberapa waktu lagi atau hubungi administrasi fakultas Anda.</p>
            </div>
        </div>
    </div>
    
    <!-- Tombol Kembali -->
    <button class="btn-back" onclick="window.history.back()">
        <i class="fas fa-arrow-left"></i>
    </button>

    <script>
        // Fungsi untuk memeriksa ketersediaan dokumen
        async function checkDocumentExists(url) {
            try {
                const response = await fetch(url, { method: 'HEAD' });
                return response.ok;
            } catch (error) {
                return false;
            }
        }
        
        let currentYear = 2025;
        let currentSemester = 'ganjil';
        
        // Fungsi untuk menampilkan dokumen berdasarkan tahun
        async function showYear(year) {
            currentYear = year;
            
            // Update tombol tahun aktif
            document.querySelectorAll('.year-btn').forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.textContent) === year) {
                    btn.classList.add('active');
                }
            });
            
            // Load dokumen untuk tahun dan semester yang aktif
            await loadDocument(currentYear, currentSemester);
        }
        
        // Fungsi untuk menampilkan dokumen berdasarkan semester
        async function showSemester(semester) {
            currentSemester = semester;
            
            // Update tab semester aktif
            document.querySelectorAll('.semester-tab').forEach(tab => {
                tab.classList.remove('active');
                if (tab.textContent.toLowerCase().includes(semester)) {
                    tab.classList.add('active');
                }
            });
            
            // Load dokumen untuk tahun dan semester yang aktif
            await loadDocument(currentYear, currentSemester);
        }
        
        // Fungsi untuk memuat dokumen
        async function loadDocument(year, semester) {
            const pdfPath = `files/sk_penguji/sk_penguji_${semester}_${year}.pdf`;
            const pdfViewer = document.getElementById('pdf-viewer');
            const downloadLink = document.getElementById('download-link');
            const emptyState = document.getElementById('empty-state');
            const pdfContainer = document.getElementById('pdf-viewer-container');
            
            // Cek apakah dokumen tersedia
            const documentExists = await checkDocumentExists(pdfPath);
            
            if (documentExists) {
                // Tampilkan PDF viewer
                pdfViewer.src = pdfPath;
                downloadLink.href = pdfPath;
                downloadLink.innerHTML = `<i class="fas fa-download"></i> Download SK Penguji ${semester === 'ganjil' ? 'Ganjil' : 'Genap'} ${year}`;
                
                pdfContainer.style.display = 'block';
                downloadLink.style.display = 'inline-flex';
                emptyState.style.display = 'none';
            } else {
                // Tampilkan empty state yang elegan
                pdfContainer.style.display = 'none';
                downloadLink.style.display = 'none';
                emptyState.style.display = 'block';
                
                // Update pesan empty state berdasarkan tahun
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear();
                const currentMonth = currentDate.getMonth();
                
                let message = "Surat Keputusan Penguji untuk periode ini sedang dalam proses persiapan.";
                
                if (year > currentYear || (year === currentYear && semester === 'genap' && currentMonth < 6)) {
                    message = "SK Penguji akan tersedia mendekati masa ujian. Silakan pantau pengumuman resmi dari fakultas.";
                } else if (year < currentYear - 2) {
                    message = "Dokumen arsip untuk periode ini dapat diminta melalui administrasi fakultas.";
                }
                
                document.querySelector('#empty-state p').textContent = message;
            }
        }
        
        // Inisialisasi - tampilkan dokumen terbaru saat pertama kali load
        document.addEventListener('DOMContentLoaded', async function() {
            await loadDocument(2025, 'ganjil');
        });
    </script>
</body>
</html>
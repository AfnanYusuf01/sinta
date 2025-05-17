<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Template Tugas Akhir - Sinta</title>
  <meta name="description" content="Template dan dokumen pendukung Tugas Akhir">
  <meta name="keywords" content="tugas akhir, template, dokumen, panduan">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/logo.jpeg" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #E30613;
      --primary-hover: #C00510;
      --secondary-color: #6c757d;
      --light-bg: #f8f9fa;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      color: #212529;
    }
    
    .template-header {
      background-color: var(--primary-color);
      color: white;
      padding: 3rem 0;
      margin-bottom: 2rem;
    }
    
    .template-header h1 {
      font-weight: 700;
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

        /* Responsive adjustments untuk tombol kembali */
        @media (max-width: 768px) {
            .back-button {
                padding: 8px 16px;
                font-size: 0.9rem;
                margin: 15px 10px;
            }
        }
    
    .document-card {
      border-left: 4px solid var(--primary-color);
      transition: all 0.3s;
      margin-bottom: 1rem;
    }
    
    .document-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    
    .document-card .card-body {
      padding: 1.5rem;
    }
    
    .document-card .document-number {
      background-color: var(--primary-color);
      color: white;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      margin-right: 1rem;
    }
    
    .document-card .document-title {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    
    .document-card .document-link {
      color: var(--secondary-color);
      text-decoration: none;
    }
    
    .document-card .document-link:hover {
      color: var(--primary-color);
    }
    
    .document-card .document-icon {
      color: var(--primary-color);
      font-size: 1.5rem;
      margin-right: 0.5rem;
    }
    
    .section-title {
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #dee2e6;
      margin-bottom: 2rem;
    }
    
    .section-title h2 {
      color: var(--primary-color);
      font-weight: 700;
    }
    
    .pdf-viewer-container {
      background-color: #f8f9fa;
      padding: 1.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      margin-bottom: 2rem;
    }
    
    .pdf-viewer {
      width: 100%;
      height: 500px;
      border: 1px solid #dee2e6;
      border-radius: 0.25rem;
    }
    
    .download-btn {
      background-color: var(--primary-color);
      color: white;
      padding: 0.5rem 1.5rem;
      border-radius: 0.25rem;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
    }
    
    .download-btn:hover {
      background-color: var(--primary-hover);
      color: white;
    }
    
    .main-template-title {
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
      .pdf-viewer {
        height: 300px;
      }
    }
    
  </style>
</head>

<body>
  <!-- Template Header -->
<header class="template-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-12">
        <a href="{{ url('/') }}" class="btn btn-light back-button">
          <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-12">
        <h1><i class="bi bi-file-earmark-text me-2"></i>Template & Dokumen Tugas Akhir</h1>
        <p class="mb-0">Semua template dan formulir yang diperlukan untuk proses Tugas Akhir</p>
      </div>
    </div>
  </div>
</header>


  <main class="container my-5">
    <div class="row">
      <div class="col-lg-8">
        <!-- Main Template Section -->
        <section id="main-template" class="mb-5">
          <h2 class="main-template-title"><i class="bi bi-file-earmark-pdf-fill me-2"></i>Template Utama Tugas Akhir</h2>
          
          <!-- PDF Viewer -->
          <div class="pdf-viewer-container" data-aos="fade-up">
            <iframe src="{{ url('files/template_ta.pdf') }}" class="pdf-viewer" frameborder="0"></iframe>
            <div class="mt-3">
              <a href="{{ url('files/template_ta.pdf') }}" class="download-btn" download="Template_TA_Universitas.pdf">
                <i class="bi bi-download me-2"></i>Download Template
              </a>
            </div>
          </div>
          
          <div class="alert alert-info" data-aos="fade-up" data-aos-delay="100">
            <i class="bi bi-info-circle-fill me-2"></i> Gunakan template ini sebagai panduan penulisan Tugas Akhir Anda. Pastikan untuk mengikuti semua format dan panduan yang telah ditentukan.
          </div>
        </section>
      </div>
      
      <div class="col-lg-4">
        <!-- Quick Links Section -->
        <section id="quick-links" data-aos="fade-up" data-aos-delay="200">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="bi bi-link-45deg me-2"></i>Link Cepat</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="#main-template" class="text-decoration-none">
                    <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>Template Utama
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="#supporting-documents" class="text-decoration-none">
                    <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>Dokumen Pendukung
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="#faq" class="text-decoration-none">
                    <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>FAQ
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </section>
      </div>
    </div>
    
    <!-- Supporting Documents Section -->
    <div class="row">
      <div class="col-lg-12">
        <section id="supporting-documents" class="documents mt-5">
          <div class="section-title" data-aos="fade-up">
            <h2><i class="bi bi-file-earmark-arrow-down me-2"></i>Dokumen Pendukung Lainnya</h2>
            <p>Formulir dan dokumen tambahan yang diperlukan selama proses Tugas Akhir</p>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">01</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Validasi Dosen Wali</h5>
                      <a href="https://docs.google.com/document/d/1GTZeghjD4xsn0IyKs_z8WsZdpvIKeEmT/edit?tab=t.0" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="150">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">02</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Rekomendasi Sidang dari Pembimbing</h5>
                      <a href="https://docs.google.com/spreadsheets/d/18fQ2YLwte0kw60KnHrkRi3oo4reIbtAS/edit?usp=sharing&amp;ouid=110846138598727597485&amp;rtpof=true&amp;sd=true" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">03</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Persetujuan Publikasi TA</h5>
                      <a href="https://docs.google.com/document/d/1qzHyhNlnRx09yIeGKayXxkWzOyfz-yPS/edit?tab=t.0" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="250">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">04</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Nilai Penguji Tugas Akhir</h5>
                      <a href="https://docs.google.com/spreadsheets/d/1h7Kie3QnsKjSYk3Z7LGG6a2WiM7100Es/edit?usp=sharing&amp;ouid=110846138598727597485&amp;rtpof=true&amp;sd=true" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">05</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Berita Acara Sidang Tugas Akhir</h5>
                      <a href="https://docs.google.com/spreadsheets/d/1V0sUDBhnpHKcJGUapXvvktcN6o-HbVRh/edit?usp=sharing&amp;ouid=110846138598727597485&amp;rtpof=true&amp;sd=true" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="350">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">06</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Lembar Revisi Tugas Akhir</h5>
                      <a href="https://docs.google.com/document/d/1BpJfTFpLw5xdcC_iATmMNYkv9LreJyRw/edit?tab=t.0" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">07</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Nilai Pengganti Sidang TA</h5>
                      <a href="https://docs.google.com/document/d/1OlEQXYOm-DNIKikmuSOBT8-FY_m7i3tG/edit?tab=t.0" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card document-card mb-3" data-aos="fade-up" data-aos-delay="450">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="document-number">08</div>
                    <div class="flex-grow-1">
                      <h5 class="document-title">Formulir Permohonan Perubahan Judul</h5>
                      <a href="https://docs.google.com/document/d/167MA4HK4ho_9mTr2ov6ARPnHLPo87lBH/edit?tab=t.0" class="document-link" target="_blank">
                        <i class="bi bi-download document-icon"></i> Download Dokumen
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    
    <!-- FAQ Section -->
    <section id="faq" class="faq mt-5" data-aos="fade-up">
      <div class="container">
        <div class="section-title">
          <h2><i class="bi bi-question-circle-fill me-2"></i>Pertanyaan Umum</h2>
          <p>Beberapa pertanyaan yang sering diajukan tentang template Tugas Akhir</p>
        </div>

        <div class="accordion" id="faqAccordion">
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                Bagaimana jika saya tidak menggunakan template ini?
              </button>
            </h3>
            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Penggunaan template ini <strong>wajib</strong> untuk semua mahasiswa. Tugas Akhir yang tidak mengikuti format ini akan dikembalikan untuk diperbaiki sebelum dapat diproses lebih lanjut.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                Apakah boleh mengubah format template?
              </button>
            </h3>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Format dasar (font, margin, struktur dokumen) <strong>tidak boleh diubah</strong>. Anda hanya boleh mengisi konten sesuai dengan penelitian Anda. Jika ada kebutuhan khusus, konsultasikan terlebih dahulu dengan pembimbing.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                Bagaimana jika link download tidak bekerja?
              </button>
            </h3>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Jika mengalami masalah dengan link download, silahkan hubungi administrator sistem melalui menu <a href="#contact">Kontak</a> di website ini.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0">&copy; 2024 Sinta - Sistem Informasi Tugas Akhir. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

<!-- Tombol Kembali -->
    <button class="btn-back" onclick="window.history.back()">
        <i class="fas fa-arrow-left"></i>
    </button>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <script>
    // Initialize AOS animation
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });
  </script>
</body>

</html>
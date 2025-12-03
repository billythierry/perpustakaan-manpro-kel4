<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Literasi Kita - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-book-reader me-2"></i>Literasi Kita
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Selamat Datang di Literasi Kita</h1>
                    <p class="hero-subtitle">Perpustakaan digital modern yang menghubungkan Anda dengan ribuan koleksi buku berkualitas. Baca, pinjam, dan tingkatkan wawasan Anda kapan saja, di mana saja.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-light btn-hero">
                            <i class="fas fa-user-plus me-2"></i>Daftar Anggota
                        </a>
                        <a href="#tentang" class="btn btn-outline-light btn-hero">
                            <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <i class="fas fa-book-open" style="font-size: 15rem; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="about-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Tentang Literasi Kita</h2>
                <p class="section-subtitle">Perpustakaan digital terpercaya untuk meningkatkan budaya literasi</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4 class="mb-3">Koleksi Lengkap</h4>
                        <p class="text-muted">Ribuan koleksi buku dari berbagai kategori mulai dari fiksi, non-fiksi, akademik, hingga buku anak-anak.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="mb-3">Akses 24/7</h4>
                        <p class="text-muted">Akses perpustakaan kapan saja dan dimana saja melalui platform digital kami yang mudah digunakan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3">Komunitas Aktif</h4>
                        <p class="text-muted">Bergabung dengan komunitas pembaca aktif dan ikuti berbagai program literasi yang menarik.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-4">Mengapa Memilih Kami?</h3>
                    <p class="text-muted mb-3">Literasi Kita hadir sebagai solusi perpustakaan modern yang memadukan kemudahan teknologi dengan layanan berkualitas. Kami berkomitmen untuk:</p>
                    <ul class="text-muted">
                        <li class="mb-2">Menyediakan koleksi buku terbaru dan terlengkap</li>
                        <li class="mb-2">Mendukung program literasi di Indonesia</li>
                        <li class="mb-2">Memberikan layanan terbaik untuk semua kalangan</li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-laptop-code" style="font-size: 12rem; color: var(--primary); opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Koleksi Buku</div>
                    </div>
                </div>
                <div class="col-md-4 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">2000+</div>
                        <div class="stat-label">Member Aktif</div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Layanan Online</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="services-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Berbagai layanan untuk mendukung kebutuhan literasi Anda</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h5 class="mb-3">Pencarian Mudah</h5>
                        <p class="text-muted">Cari buku favorit dengan sistem pencarian yang cepat dan akurat</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <h5 class="mb-3">Peminjaman Online</h5>
                        <p class="text-muted">Pinjam buku secara online dengan proses yang simple</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="contact-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="section-subtitle">Punya pertanyaan? Kami siap membantu Anda</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Alamat</h5>
                                        <p class="text-muted mb-0">Jl. Literasi No. 123<br>Jakarta Selatan, 12345</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Telepon</h5>
                                        <p class="text-muted mb-0">+62 21 1234 5678<br>+62 812 3456 7890</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Email</h5>
                                        <p class="text-muted mb-0">info@literasikita.id<br>support@literasikita.id</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-2">Jam Operasional</h5>
                                        <p class="text-muted mb-0">Online: 24/7<br>Support: Senin - Jumat, 09:00 - 17:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2024 Literasi Kita. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none me-3">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none me-3">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>
</html>
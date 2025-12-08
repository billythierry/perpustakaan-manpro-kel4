<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --navbar-height: 70px;
            --accent-color: #667eea;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding-top: var(--navbar-height);
        }

        /* Navbar Styles */
        .main-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background: #fff;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 30px;
            list-style: none;
            margin: 0;
        }

        .navbar-menu a {
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .navbar-menu a:hover {
            color: var(--accent-color);
            background: #f1f5f9;
        }

        .navbar-menu a.active {
            color: #fff;
            background: var(--primary-gradient);
        }

        .navbar-menu a i {
            font-size: 1.1rem;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: #475569;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            right: 0;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 20px;
            z-index: 999;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .mobile-menu a:hover {
            background: #f1f5f9;
            color: var(--accent-color);
        }

        .mobile-menu a.active {
            background: var(--primary-gradient);
            color: #fff;
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
            min-height: calc(100vh - var(--navbar-height) - 100px);
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            transform: translateY(-4px);
        }

        /* Button Styles */
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #e2e8f0;
            border: none;
            color: #475569;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
            color: #1e293b;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #065f46;
        }

        .alert-info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #0c4a6e;
        }

        .alert-warning {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            color: #7c3d00;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: #fff;
            border-radius: 16px 16px 0 0;
            padding: 20px 24px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
        }

        /* Form Styles */
        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        /* Footer */
        .main-footer {
            background: #1e293b;
            color: #cbd5e1;
            padding: 30px;
            text-align: center;
            margin-top: 50px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .navbar-menu {
                gap: 20px;
            }

            .navbar-menu a {
                font-size: 0.9rem;
                padding: 6px 12px;
            }

            .main-content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .navbar-menu {
                display: none;
            }

            .navbar-container {
                padding: 0 20px;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 15px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .main-content {
                padding: 10px;
            }

            .main-footer {
                padding: 20px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="main-navbar">
        <div class="navbar-container">
            <a href="{{ route('member.dashboard') }}" class="navbar-brand">
                📚 Literasi Kita
            </a>

            <button class="menu-toggle" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>

            <ul class="navbar-menu">
                <li><a href="{{ route('member.dashboard') }}" class="{{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a></li>
                <li><a href="{{ route('member.book.index') }}" class="{{ request()->routeIs('member.book.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Daftar Buku
                </a></li>
                <li><a href="#">
                    <i class="bi bi-arrow-repeat"></i> Peminjaman Saya
                </a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a></li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('member.dashboard') }}" class="{{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('member.book.index') }}" class="{{ request()->routeIs('member.book.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Daftar Buku
        </a>
        <a href="#">
            <i class="bi bi-arrow-repeat"></i> Peminjaman Saya
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; 2025 LiterasiKita. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                const icon = menuToggle.querySelector('i');
                icon.classList.toggle('bi-list');
                icon.classList.toggle('bi-x');
            });

            // Close mobile menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    icon.classList.add('bi-list');
                    icon.classList.remove('bi-x');
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                    const icon = menuToggle.querySelector('i');
                    icon.classList.add('bi-list');
                    icon.classList.remove('bi-x');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
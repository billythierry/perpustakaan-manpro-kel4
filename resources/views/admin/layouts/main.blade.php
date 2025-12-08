<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --accent-color: #667eea;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
            background: #f8fafc;
        }

        /* Sidebar Styles */
        nav.sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        nav.sidebar::-webkit-scrollbar {
            width: 6px;
        }

        nav.sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        nav.sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 30px 20px;
            background: var(--primary-gradient);
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .sidebar-header p {
            font-size: 0.8rem;
            opacity: 0.9;
            margin: 5px 0 0 0;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        nav.sidebar a {
            color: #cbd5e1;
            display: flex;
            align-items: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 4px 12px;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        nav.sidebar a i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        nav.sidebar a:hover {
            background: var(--sidebar-hover);
            color: #fff;
            transform: translateX(5px);
        }

        nav.sidebar a.active {
            background: var(--accent-color);
            color: #fff;
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        .logout-btn {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: var(--primary-gradient);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* Main Content Styles */
        main.content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 0;
            background: #f8fafc;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-bar {
            background: #fff;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            border-bottom: 1px solid #e2e8f0;
        }

        .top-bar h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .content-wrapper {
            padding: 30px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        /* Button Styles */
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
        }

        /* Table Styles */
        .table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: var(--primary-gradient);
            color: #fff;
        }

        .table thead th {
            border: none;
            padding: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-color: #e2e8f0;
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
            border-radius: 8px;
            padding: 10px 14px;
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

        /* Responsive Styles */
        @media (max-width: 992px) {
            .top-bar h1 {
                font-size: 1.5rem;
            }

            .content-wrapper {
                padding: 20px;
            }

            .table thead th,
            .table tbody td {
                padding: 12px 10px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            nav.sidebar {
                transform: translateX(-100%);
            }

            nav.sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            main.content {
                margin-left: 0;
                width: 100%;
            }

            .top-bar {
                padding: 20px 20px 20px 75px;
            }

            .top-bar h1 {
                font-size: 1.3rem;
            }

            .content-wrapper {
                padding: 15px;
            }

            /* Responsive Table */
            .table-container {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }

            .table thead th,
            .table tbody td {
                padding: 10px 8px;
                font-size: 0.85rem;
                white-space: nowrap;
            }

            /* Modal Adjustments */
            .modal-dialog {
                margin: 10px;
            }

            .modal-body {
                padding: 20px 15px;
            }

            /* Button Adjustments */
            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            .btn-sm {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
        }

        @media (max-width: 576px) {
            .sidebar-header h4 {
                font-size: 1.2rem;
            }

            .sidebar-header p {
                font-size: 0.75rem;
            }

            nav.sidebar a {
                padding: 12px 15px;
                font-size: 0.9rem;
            }

            nav.sidebar a i {
                font-size: 1.1rem;
                margin-right: 10px;
            }

            .top-bar h1 {
                font-size: 1.1rem;
            }

            .content-wrapper {
                padding: 10px;
            }

            .alert {
                font-size: 0.9rem;
                padding: 12px 15px;
            }

            /* Stack action buttons vertically on very small screens */
            .table tbody td .btn-sm {
                display: block;
                width: 100%;
                margin-bottom: 5px;
            }

            .table tbody td .btn-sm:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>📚 Literasi Kita</h4>
            <p>Admin Panel</p>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.book.index') }}" class="{{ request()->routeIs('admin.book.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Manajemen Buku</span>
            </a>
            <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Manajemen User</span>
            </a>
            <a href="#">
                <i class="bi bi-arrow-repeat"></i>
                <span>Peminjaman</span>
            </a>
        </div>

        <div class="logout-btn">
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <div class="top-bar">
            <h1>@yield('title')</h1>
        </div>
        
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            }

            menuToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking on a link (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
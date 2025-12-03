<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Custom CSS -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        nav.sidebar {
            width: 200px;
            background: #343a40;
            color: #fff;
            padding-top: 20px;
        }
        nav.sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        nav.sidebar a:hover {
            background: #495057;
        }
        main.content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Welcome</a>
        <a href="{{ route('admin.book.index') }}">Buku</a>
        <a>Peminjaman</a>
        <a href="{{ route('logout') }}" 
        onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <!-- <h1>@yield('title')</h1> -->
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') {{-- Optional untuk script tambahan di halaman --}}
</body>
</html>

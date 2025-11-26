<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center p-5 bg-white rounded shadow" style="max-width: 450px; width: 100%;">
            <h1 class="mb-4">Selamat Datang di<br>Perpustakaan</h1>

            <p class="text-muted mb-4">Silakan pilih salah satu untuk mulai menggunakan aplikasi</p>

            <div class="d-grid gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Register</a>
            </div>
        </div>
    </div>

</body>
</html>

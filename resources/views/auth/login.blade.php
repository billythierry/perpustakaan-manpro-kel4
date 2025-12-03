<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Masuk - E-Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center p-5 bg-white rounded shadow" style="max-width: 450px; width: 100%;">
                
                <h2 class="mb-4">Masuk</h2>
                
                {{-- Cek keberadaan session 'success' --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" 
                           class="form-control @error('username') is-invalid @enderror" 
                           id="username" 
                           name="username" 
                           value="{{ old('username') }}"
                           required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password"
                           minlength="6"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mt-3">Masuk</button>


                <p class="mt-4 text-muted">
                    Belum punya akun?  
                    <a href="{{ route('register') }}">Daftar</a>
                </p>
            </form>

        </div>
    </div>

</body>
</html>

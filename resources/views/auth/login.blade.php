<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sidumas Polsek</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
</head>
<body>

    <div class="auth-container">
        <!-- Info Section -->
        <div class="auth-info">
            <div class="logo">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1>Selamat Datang</h1>
            <p>Sistem Pengaduan Masyarakat Polsek. Laporkan tindak kriminal dengan cepat, aman, dan terpercaya.</p>
        </div>

        <!-- Form Section -->
        <div class="auth-form">
            <h2>Login ke Akun Anda</h2>
            <p class="subtitle">Silakan masukkan email dan password Anda.</p>
            
            <!-- Session Status (Pesan setelah reset password) -->
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Input -->
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus class="@error('email') is-invalid @enderror">
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <!-- Password Input -->
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required class="@error('password') is-invalid @enderror">
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <!-- Options: Remember me & Forgot Password -->
                <div class="form-options">
                    <label for="remember_me" class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Lupa password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="submit-button">Login</button>

                <!-- Register Link -->
                @if (Route::has('register'))
                <div class="switch-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
                @endif
            </form>
        </div>
    </div>

</body>
</html>

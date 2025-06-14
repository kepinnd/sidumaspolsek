<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sidumas Polsek</title>
    
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
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h1>Buat Akun Baru</h1>
            <p>Bergabunglah dengan kami untuk menciptakan lingkungan yang lebih aman. Pendaftaran cepat dan mudah.</p>
        </div>

        <!-- Form Section -->
        <div class="auth-form">
            <h2>Formulir Pendaftaran</h2>
            <p class="subtitle">Isi data diri Anda dengan benar.</p>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="input-group">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="@error('name') is-invalid @enderror">
                </div>
                @error('name') <span class="error-message">{{ $message }}</span> @enderror

                <div class="input-group">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="text" name="nik" placeholder="NIK (Nomor Induk Kependudukan)" value="{{ old('nik') }}" required class="@error('nik') is-invalid @enderror">
                </div>
                @error('nik') <span class="error-message">{{ $message }}</span> @enderror
                
                <div class="input-group">
                    <textarea name="alamat" placeholder="Alamat Lengkap" rows="3" required class="@error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                </div>
                @error('alamat') <span class="error-message">{{ $message }}</span> @enderror

                <div class="input-group">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" name="no_telp" placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required class="@error('no_telp') is-invalid @enderror">
                </div>
                @error('no_telp') <span class="error-message">{{ $message }}</span> @enderror
                
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required class="@error('email') is-invalid @enderror">
                </div>
                @error('email') <span class="error-message">{{ $message }}</span> @enderror

                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required class="@error('password') is-invalid @enderror">
                </div>
                @error('password') <span class="error-message">{{ $message }}</span> @enderror

                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="submit-button">Daftar</button>

                @if (Route::has('login'))
                <div class="switch-link">
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                </div>
                @endif
            </form>
        </div>
    </div>

</body>
</html>

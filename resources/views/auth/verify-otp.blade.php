<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sidumas Polsek</title>

    {{-- Menghubungkan ke file CSS yang sama dengan halaman login/register --}}
    <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
    
    {{-- Dependensi lain dari halaman auth Anda --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <div class="auth-container">
        <div class="auth-form" style="width:100%; max-width: 500px; margin: auto;">
            <h2>Verifikasi Akun Anda</h2>
            <p class="subtitle">Kami telah mengirimkan 6 digit kode OTP ke email <strong>{{ $email ?? 'Anda' }}</strong>.</p>

            {{-- Menampilkan pesan sukses dari halaman registrasi atau kirim ulang --}}
            @if (session('success'))
                <div class="session-status">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('otp.verification.verify') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email ?? '' }}">
                <div class="input-group">
                    <i class="fa-solid fa-key"></i>
                    <input type="text" name="otp" placeholder="Masukkan 6 digit kode OTP" required 
                           class="@error('otp') is-invalid @enderror" 
                           style="text-align: center; font-size: 1.5rem; letter-spacing: 0.5rem; padding: 12px 15px;">
                </div>
                
                {{-- Menampilkan pesan error validasi --}}
                @error('otp') <span class="error-message">{{ $message }}</span> @enderror
                @error('email') <span class="error-message">{{ $message }}</span> @enderror

                <button type="submit" class="submit-button">Verifikasi</button>
            </form>

            {{-- Fitur Kirim Ulang OTP --}}
            {{-- Di dalam verify-otp.blade.php --}}

<div class="switch-link" style="margin-top: 20px;">
    <p>Tidak menerima kode?
        <form action="{{ route('otp.resend') }}" method="POST" style="display:inline;">
            @csrf
            {{-- Bagian ini sangat penting untuk mengirim email ke controller --}}
            <input type="hidden" name="email" value="{{ $email ?? '' }}">
            <button type="submit" style="background:none; border:none; color:#4f46e5; font-weight:600; text-decoration:underline; cursor:pointer; font-family:'Poppins', sans-serif; font-size: 0.9rem;">
                Kirim ulang OTP
            </button>
        </form>
    </p>
</div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
        }
        .content {
            padding: 20px 0;
            line-height: 1.6;
        }
        .otp-code {
            background-color: #f0f4ff;
            border: 1px dashed #4f46e5;
            color: #4338ca;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            letter-spacing: 5px;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kode Verifikasi Akun</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Gunakan kode berikut untuk memverifikasi akun Anda di Sistem Pengaduan Masyarakat:</p>
            <div class="otp-code">
                {{ $otp }}
            </div>
            <p>Kode ini akan kedaluwarsa dalam 10 menit. Mohon untuk tidak membagikan kode ini kepada siapa pun demi keamanan akun Anda.</p>
            <p>Terima kasih.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Sidumas Polsek') }}. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>
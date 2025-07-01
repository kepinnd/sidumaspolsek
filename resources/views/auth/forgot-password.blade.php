<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sidumas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6; /* Light gray background for the whole page */
        }
        .container-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .form-input {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-input:focus {
            border-color: #3B82F6; /* Blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .primary-button {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .primary-button:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="container-wrapper">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl">
            <!-- Logo dan Judul -->
            <div class="text-center mb-6">
                <a href="/" class="text-3xl font-bold text-blue-600">
                    Sidumas
                </a>
                <h2 class="text-xl font-semibold text-gray-800 mt-4">Lupa Password Anda?</h2>
            </div>

            <!-- Instruksi -->
            <div class="mb-4 text-sm text-gray-600 text-center">
                Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi yang memungkinkan Anda memilih yang baru.
            </div>

            <!-- Status Session (Pesan Sukses) -->
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg">
                {{ session('status') }}
            </div>
            @endif

            <!-- Form Lupa Password -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Input Email -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none sm:text-sm @error('email') border-red-500 @enderror"
                        placeholder="email@anda.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex items-center justify-end mt-6">
                    <button
                        type="submit"
                        class="primary-button w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Kirim Tautan Reset Password
                    </button>
                </div>
            </form>

            <!-- Kembali ke Halaman Login -->
            <p class="mt-8 text-center text-sm text-gray-600">
                Ingat password Anda?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Kembali ke Login
                </a>
            </p>
        </div>
    </div>

</body>
</html>

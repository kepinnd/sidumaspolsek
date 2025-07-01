<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sidumas</title>
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
                <h2 class="text-xl font-semibold text-gray-800 mt-4">Atur Ulang Password Anda</h2>
                <p class="text-sm text-gray-500 mt-1">Buat password baru yang kuat dan mudah Anda ingat.</p>
            </div>

            <!-- Form Reset Password -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token (Tersembunyi) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Input Email (readonly) -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autofocus
                        autocomplete="username"
                        class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none sm:text-sm bg-gray-100 cursor-not-allowed @error('email') border-red-500 @enderror"
                        value="{{ old('email', $request->email) }}"
                        readonly 
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Password Baru -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none sm:text-sm @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password baru Anda"
                    >
                     @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                 <!-- Input Konfirmasi Password Baru -->
                 <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none sm:text-sm"
                        placeholder="Ulangi password baru Anda"
                    >
                </div>


                <!-- Tombol Submit -->
                <div class="flex items-center justify-end mt-6">
                    <button
                        type="submit"
                        class="primary-button w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

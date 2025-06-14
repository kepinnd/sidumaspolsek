<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sidumas - Sistem Informasi Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-bg {
            background-color: #F3F4F6; /* Light gray background */
        }
        .cta-button {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <!-- Header / Navigation Bar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#beranda" class="text-2xl font-bold text-blue-600">
                Sidumas
            </a>
            <nav class="space-x-4 hidden md:flex items-center">
                <a href="#beranda" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                <a href="#tentang" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                <a href="#fitur" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Fitur</a>
                <a href="#kontak" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
            </nav>
            <!-- Tombol Login & Register untuk Desktop -->
            <div class="hidden md:flex space-x-2"> 
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button">
                    Register
                </a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg pb-3"> 
            <a href="#beranda" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 text-sm font-medium">Beranda</a>
            <a href="#tentang" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 text-sm font-medium">Tentang</a>
            <a href="#fitur" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 text-sm font-medium">Fitur</a>
            <a href="#kontak" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 text-sm font-medium">Kontak</a>
            
            <!-- Garis Pemisah (Opsional) -->
            <hr class="my-2 border-gray-200 mx-4">

            <!-- Tombol Login & Register untuk Mobile Menu -->
            <div class="px-4 pt-1 pb-2 flex justify-end space-x-2">
                 <a href="{{ route('login') }}" class="mobile-auth-link bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button">
                Login
            </a>
            <a href="{{ route('register') }}" class="mobile-auth-link bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button">
                Register
            </a>
            </div>
        
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="hero-bg py-20 md:py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                Selamat Datang di <span class="text-blue-600">Sidumas</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Platform terintegrasi untuk pengelolaan pengaduan masyarakat yang efektif, transparan, dan responsif. Sampaikan aspirasi dan keluhan Anda dengan mudah.
            </p>
            <a href="#tentang" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg text-lg cta-button inline-block">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Tentang Sidumas</h2>
                <p class="text-gray-600 mt-2">Mengenal lebih dekat tujuan dan manfaat Sidumas.</p>
            </div>
            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                <div class="md:w-1/2">
                    <img src="{{ asset('images/gemini.png') }}" alt="Ilustrasi Tentang Sidumas" class="rounded-lg shadow-lg w-full h-auto object-cover">
                </div>
                <div class="md:w-1/2 text-gray-700 space-y-4">
                    <p class="leading-relaxed">
                        Sidumas (Sistem Informasi Pengaduan Masyarakat) adalah sebuah inisiatif digital yang bertujuan untuk menjembatani komunikasi antara masyarakat dengan pihak berwenang atau penyedia layanan. Kami percaya bahwa setiap suara berhak didengar dan setiap masalah layak mendapatkan perhatian.
                    </p>
                    <p class="leading-relaxed">
                        Dengan Sidumas, proses pengaduan menjadi lebih terstruktur, mudah dilacak, dan terdokumentasi dengan baik. Kami berkomitmen untuk menciptakan platform yang tidak hanya memudahkan pelaporan, tetapi juga mendorong penyelesaian masalah yang lebih cepat dan akuntabel.
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>Mempermudah masyarakat menyampaikan aspirasi.</li>
                        <li>Meningkatkan transparansi dalam penanganan pengaduan.</li>
                        <li>Mempercepat respons dan tindak lanjut dari pihak terkait.</li>
                        <li>Menyediakan data akurat untuk perbaikan layanan publik.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Fitur Unggulan Sidumas</h2>
                <p class="text-gray-600 mt-2">Temukan berbagai kemudahan yang kami tawarkan.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="flex items-center justify-center bg-blue-100 rounded-full w-16 h-16 mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengaduan Mudah & Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sampaikan pengaduan Anda melalui formulir online yang intuitif, kapan saja dan di mana saja.
                    </p>
                </div>
                <!-- Feature Card 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="flex items-center justify-center bg-green-100 rounded-full w-16 h-16 mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pelacakan Status Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau perkembangan pengaduan Anda secara transparan melalui dasbor pengguna.
                    </p>
                </div>
                <!-- Feature Card 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="flex items-center justify-center bg-purple-100 rounded-full w-16 h-16 mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Notifikasi & Respons Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan pemberitahuan otomatis dan tanggapan yang lebih cepat dari pihak terkait.
                    </p>
                </div>
                 <!-- Feature Card 4 (Placeholder for Login/Register info) -->
                <div id="login" class="bg-white p-8 rounded-xl shadow-lg feature-card md:col-span-1 lg:col-span-1">
                    <div class="flex items-center justify-center bg-yellow-100 rounded-full w-16 h-16 mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h5a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Akses Akun Anda</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Masuk untuk melihat riwayat pengaduan Anda, memperbarui status, atau mengirimkan pengaduan baru.
                    </p>
                    <a href="{{ route('login') }}" class="w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button block">
                        Login Sekarang
                    </a>
                </div>
                <div id="register" class="bg-white p-8 rounded-xl shadow-lg feature-card md:col-span-1 lg:col-span-1">
                     <div class="flex items-center justify-center bg-pink-100 rounded-full w-16 h-16 mb-6">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Belum Punya Akun?</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Daftar sekarang untuk mulai menggunakan layanan Sidumas dan sampaikan aspirasi Anda. Prosesnya cepat dan mudah!
                    </p>
                     <a href="{{ route('register') }}" class="w-full text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-sm cta-button block">
                        Register Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Hubungi Kami</h2>
                <p class="text-gray-600 mt-2">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
            </div>
            <div class="max-w-3xl mx-auto bg-gray-50 p-8 rounded-lg shadow-md">
                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Nama Anda">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="email@anda.com">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                        <input type="text" name="subject" id="subject" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Subjek pesan Anda">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg cta-button">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h5 class="text-lg font-semibold text-white mb-3">Sidumas</h5>
                    <p class="text-sm">Platform pengaduan masyarakat yang terintegrasi dan mudah digunakan.</p>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-3">Tautan Cepat</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#beranda" class="hover:text-blue-400">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-blue-400">Tentang Kami</a></li>
                        <li><a href="#fitur" class="hover:text-blue-400">Fitur</a></li>
                        <li><a href="#kontak" class="hover:text-blue-400">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-3">Legal</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-blue-400">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-blue-400">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold text-white mb-3">Ikuti Kami</h5>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.707 8.707a1 1 0 00-1.414-1.414L12 11.586l-2.293-2.293a1 1 0 00-1.414 1.414L10.586 13l-2.293 2.293a1 1 0 101.414 1.414L12 14.414l2.293 2.293a1 1 0 001.414-1.414L13.414 13l2.293-2.293z" clip-rule="evenodd" /></svg></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-sm">
                <p>&copy; <span id="currentYear"></span> Sidumas. Semua Hak Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

        <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        } else {
            if (!mobileMenuButton) {
                console.error('Tombol menu mobile dengan ID "mobile-menu-button" tidak ditemukan.');
            }
            if (!mobileMenu) {
                console.error('Elemen menu mobile dengan ID "mobile-menu" tidak ditemukan.');
            }
        }
        
        if (mobileMenu) {
            const menuItems = mobileMenu.querySelectorAll('a');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            });
        }

        // Set current year in footer
        const currentYearSpan = document.getElementById('currentYear');
        if (currentYearSpan) {
            currentYearSpan.textContent = new Date().getFullYear();
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId && targetId.length > 1) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                         // Tutup menu mobile jika terbuka setelah klik anchor link
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                }
            });
        });
    </script>

    </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>

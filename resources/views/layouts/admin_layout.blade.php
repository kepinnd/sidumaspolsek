<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <style>
        body { font-family: 'Figtree', sans-serif; margin: 0; background-color: #f3f4f6; color: #1f2937;}
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        nav ul { list-style: none; padding: 0; margin: 0; display: flex; gap: 15px; background-color: #4a5568; padding: 10px; border-radius: 5px;}
        nav ul li a { color: white; text-decoration: none; }
        nav ul li a:hover { text-decoration: underline; }
        .logout-btn { background-color: #ef4444; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .logout-btn:hover { background-color: #dc2626; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 1rem;}
        .table th, .table td { padding: 0.75rem; vertical-align: top; border-top: 1px solid #dee2e6; text-align: left;}
        .table thead th { vertical-align: bottom; border-bottom: 2px solid #dee2e6; background-color: #e9ecef;}
        .btn { display: inline-block; font-weight: 400; color: #212529; text-align: center; vertical-align: middle; cursor: pointer; user-select: none; background-color: transparent; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
        .btn-primary { color: #fff; background-color: #007bff; border-color: #007bff; }
        .btn-primary:hover { color: #fff; background-color: #0056b3; border-color: #0056b3; }
        .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5; border-radius: 0.2rem; }
        .form-control { display: block; width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: 0.25rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; box-sizing: border-box; }
        .form-group { margin-bottom: 1rem; }
        label { display: inline-block; margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @auth
                    @if(Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.users.index') }}">Kelola Pengguna</a></li>
                    @endif
                    @if(Auth::user()->role == 'masyarakat')
                        <li><a href="{{ route('masyarakat.pengaduan.index') }}">Pengaduan Saya</a></li>
                        <li><a href="{{ route('masyarakat.pengaduan.create') }}">Buat Pengaduan</a></li>
                    @endif
                     @if(Auth::user()->role == 'petugas_spkt')
                        <li><a href="{{ route('petugas.pengaduan.index') }}">Daftar Pengaduan</a></li>
                    @endif
                    @if(Auth::user()->role == 'kapolsek')
                        <li><a href="{{ route('kapolsek.monitoring.index') }}">Monitoring Pengaduan</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">Logout ({{ Auth::user()->name }})</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li> {{-- Arahkan ke register masyarakat jika ada --}}
                @endauth
            </ul>
        </nav>

        <main style="padding-top: 20px;">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    </body>
</html>
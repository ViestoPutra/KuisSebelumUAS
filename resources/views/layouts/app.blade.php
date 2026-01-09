<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kost')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f5f1e8; }
        .navbar { background: linear-gradient(135deg, #d4a574 0%, #c89968 100%); color: white; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.25rem; font-weight: bold; text-decoration: none; color: white; display: flex; align-items: center; gap: 0.5rem; }
        .nav-menu { display: flex; gap: 1rem; }
        .nav-link { color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; font-size: 0.875rem; transition: background-color 0.2s; }
        .nav-link:hover { background-color: rgba(255,255,255,0.2); }
        .nav-link.active { background-color: rgba(0,0,0,0.15); }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem 1rem; }
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <i class="fas fa-building"></i>
                <span>Manajemen Kost</span>
            </a>
            
            <div class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('kamar.index') }}" class="nav-link {{ request()->routeIs('kamar.*') ? 'active' : '' }}">
                    <i class="fas fa-door-open"></i> Kamar
                </a>
                <a href="{{ route('penyewa.index') }}" class="nav-link {{ request()->routeIs('penyewa.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Penyewa
                </a>
                <a href="{{ route('kontrak-sewa.index') }}" class="nav-link {{ request()->routeIs('kontrak-sewa.*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> Kontrak
                </a>
                <a href="{{ route('pembayaran.index') }}" class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill"></i> Pembayaran
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RentSCar') - Sistem Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

@auth
<div class="main-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">R</div>
            <span class="sidebar-brand-text">RentSCar<span class="light">.id</span></span>
        </div>

        <nav class="sidebar-nav">
            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 icon"></i>
                <span>Dashboard</span>
            </a>
            @else
            <a href="{{ url('/staff/dashboard') }}" class="sidebar-link {{ request()->is('staff/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 icon"></i>
                <span>Dashboard</span>
            </a>
            @endif

            <a href="{{ url('/mobil') }}" class="sidebar-link {{ request()->is('mobil*') ? 'active' : '' }}">
                <i class="bi bi-car-front icon"></i>
                <span>Mobil</span>
            </a>

            <a href="{{ url('/customer') }}" class="sidebar-link {{ request()->is('customer*') ? 'active' : '' }}">
                <i class="bi bi-people icon"></i>
                <span>Customer</span>
            </a>

            <a href="{{ url('/verifikasi') }}" class="sidebar-link {{ request()->is('verifikasi*') ? 'active' : '' }}">
                <i class="bi bi-shield-check icon"></i>
                <span>Verifikasi</span>
            </a>

            <a href="{{ url('/penyewaan') }}" class="sidebar-link {{ request()->is('penyewaan*') ? 'active' : '' }}">
                <i class="bi bi-journal-text icon"></i>
                <span>Penyewaan</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/staff') }}" class="sidebar-link {{ request()->is('staff*') ? 'active' : '' }}">
                <i class="bi bi-person-gear icon"></i>
                <span>Staff</span>
            </a>
            @endif

            <a href="{{ url('/laporan') }}" class="sidebar-link {{ request()->is('laporan*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart icon"></i>
                <span>Laporan</span>
            </a>

            <a href="{{ url('/pengaturan') }}" class="sidebar-link {{ request()->is('pengaturan*') ? 'active' : '' }}">
                <i class="bi bi-gear icon"></i>
                <span>Pengaturan</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="bi bi-box-arrow-left icon"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="navbar-custom">
            <div class="d-flex align-items-center gap-4">
                <div class="navbar-search">
                    <i class="bi bi-search" style="color: rgba(255,255,255,0.4); font-size: 14px;"></i>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>
            </div>

            <div class="navbar-actions">
                <button class="navbar-bell" title="Notifikasi">
                    <i class="bi bi-bell" style="font-size: 18px;"></i>
                    <span class="dot"></span>
                </button>
                <div class="navbar-divider"></div>
                <div class="navbar-user">
                    <div class="navbar-user-info">
                        <div class="navbar-user-name">{{ auth()->user()->nama_user }}</div>
                        <div class="navbar-user-role">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                    <div class="navbar-user-avatar">
                        {{ strtoupper(substr(auth()->user()->nama_user, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="page-content">
            <div class="page-container">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>
</div>
@else
    @yield('content')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>

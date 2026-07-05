<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trim($__env->yieldContent('title')) ?: 'RentSCar' }} - Sistem Rental Mobil</title>
    <meta name="description" content="@yield('meta_description', 'Sewa mobil premium di Padang dengan harga terjangkau. Nikmati pengalaman berkendara terbaik dengan armada mobil berkualitas dari RentSCar.')">
    <meta property="og:title" content="{{ trim($__env->yieldContent('title')) ?: 'RentSCar' }} - Sistem Rental Mobil">
    <meta property="og:description" content="@yield('meta_description', 'Sewa mobil premium di Padang dengan harga terjangkau. Nikmati pengalaman berkendara terbaik dengan armada mobil berkualitas dari RentSCar.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/nrentcar.png') }}">
    <meta property="og:site_name" content="RentSCar">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-[#080808] text-white font-[Inter] antialiased">

@auth
@php
    $publicRoutes = ['/', 'cars*', 'tentang-kami', 'login'];
    $isPublic = false;
    foreach ($publicRoutes as $pattern) {
        if (request()->is($pattern)) { $isPublic = true; break; }
    }
@endphp
@if($isPublic)
    @yield('content')
@else
<div x-data="{ sidebarOpen: window.innerWidth >= 768 }" class="flex min-h-screen overflow-hidden">
    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 md:hidden" @click="sidebarOpen = false"></div>
    <aside x-cloak :class="sidebarOpen ? 'flex' : 'hidden'" class="md:flex md:flex-col w-64 min-w-64 h-screen fixed left-0 top-0 border-r border-white/[0.06] z-50 bg-gradient-to-b from-[#141414]/80 to-[#0c0c0c]/90 overflow-y-auto">
        <div class="p-6 flex items-center gap-3">
            <img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-16 h-16">
            <span class="font-bold text-lg tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
        </div>

        <nav @click="sidebarOpen = false" class="flex-1 px-4 py-2 space-y-1">
            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('admin/dashboard') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('admin/dashboard'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                @svg('heroicon-s-squares-2x2', 'w-5 h-5 ' . (request()->is('admin/dashboard') ? 'text-[#C1121F]' : 'group-hover:text-white/80'))
                <span class="font-medium text-sm">Dashboard</span>
            </a>
            @else
            <a href="{{ url('/staff/dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('staff/dashboard') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('staff/dashboard'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                @svg('heroicon-s-squares-2x2', 'w-5 h-5 ' . (request()->is('staff/dashboard') ? 'text-[#C1121F]' : 'group-hover:text-white/80'))
                <span class="font-medium text-sm">Dashboard</span>
            </a>
            @endif

            <a href="{{ url('/mobil') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('mobil*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('mobil*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-car-front text-lg {{ request()->is('mobil*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Mobil</span>
            </a>

            <a href="{{ url('/customer') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('customer*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('customer*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-people text-lg {{ request()->is('customer*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Customer</span>
            </a>

            <a href="{{ url('/penyewaan') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('penyewaan*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('penyewaan*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-journal-text text-lg {{ request()->is('penyewaan*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Penyewaan</span>
            </a>

            <a href="{{ url('/pengembalian') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('pengembalian*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('pengembalian*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-arrow-return-left text-lg {{ request()->is('pengembalian*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Pengembalian</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/staff') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('staff*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('staff*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-person-gear text-lg {{ request()->is('staff*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Staff</span>
            </a>
            @endif

            <a href="{{ url('/laporan') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('laporan*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('laporan*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-bar-chart text-lg {{ request()->is('laporan*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Laporan</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/pengaturan') }}" class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->is('pengaturan*') ? 'bg-[#C1121F]/10 text-white' : 'text-white/60 hover:bg-white/[0.04] hover:text-white' }}">
                @if(request()->is('pengaturan*'))<span class="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]"></span>@endif
                <i class="bi bi-gear text-lg {{ request()->is('pengaturan*') ? 'text-[#C1121F]' : 'group-hover:text-white/80' }}"></i>
                <span class="font-medium text-sm">Pengaturan</span>
            </a>
            @endif

            <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group text-white/60 hover:bg-white/[0.04] hover:text-white">
                <i class="bi bi-globe text-lg group-hover:text-white/80"></i>
                <span class="font-medium text-sm">Lihat Website</span>
            </a>
        </nav>

        <div @click="sidebarOpen = false" class="p-4 border-t border-white/[0.06]">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg text-red-400/80 hover:bg-red-500/10 hover:text-red-400 transition-colors">
                    <i class="bi bi-box-arrow-left text-lg"></i>
                    <span class="font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden md:ml-64">
        <header class="h-16 border-b border-white/[0.06] bg-[#141414]/40 backdrop-blur-md flex items-center justify-between px-4 lg:px-8 z-10 shrink-0 relative">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg border border-white/[0.06] bg-white/[0.03] text-white/70 hover:text-white hover:bg-white/[0.06] transition-colors" aria-label="Buka menu">
                    <i class="bi bi-list text-xl"></i>
                </button>
                <h2 class="text-sm font-medium text-white/80">@yield('page-title', 'Dashboard')</h2>
            </div>

            <a href="/profile" class="flex items-center gap-3 no-underline group">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-sm font-medium text-white group-hover:text-[#C1121F] transition-colors">{{ auth()->user()->nama_user }}</span>
                    <span class="text-xs text-white/50">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
                @if(auth()->user()->foto_profil)
                <img src="{{ asset('storage/'.auth()->user()->foto_profil) }}" alt="{{ auth()->user()->nama_user }}" class="w-9 h-9 rounded-full object-cover border-2 border-white/10">
                @else
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">{{ strtoupper(substr(auth()->user()->nama_user, 0, 1)) }}</div>
                @endif
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-4 lg:p-8">
            <div class="max-w-7xl mx-auto w-full pb-12">
                @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="text-emerald-400/60 hover:text-emerald-400" onclick="this.parentElement.remove()">&times;</button>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="text-red-400/60 hover:text-red-400" onclick="this.parentElement.remove()">&times;</button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>
</div>
@endif
@else
    @yield('content')
@endauth

@vite('resources/js/app.js')

<script>
function togglePw(fieldId, iconId) {
    var f = document.getElementById(fieldId);
    var i = document.getElementById(iconId);
    if (!f || !i) return;
    if (f.type === 'password') { f.type = 'text'; i.className = 'bi bi-eye-slash'; }
    else { f.type = 'password'; i.className = 'bi bi-eye'; }
}
</script>
@push('scripts')
<script>
document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function() {
        var btn = this.querySelector('[type="submit"]');
        if (btn) btn.disabled = true;
    });
});
</script>
@endpush
@stack('scripts')
</body>
</html>

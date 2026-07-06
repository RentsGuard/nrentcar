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
<script>if(localStorage.getItem('theme')==='dark'||(!localStorage.getItem('theme')&&window.matchMedia('(prefers-color-scheme:dark)').matches))document.documentElement.classList.add('dark')</script>
@vite('resources/css/app.css')
@stack('styles')
</head>
<body>

@auth
@php
$publicRoutes = ['/', 'cars*', 'tentang-kami', 'login'];
$isPublic = false;
foreach ($publicRoutes as $pattern) {
if (request()->is($pattern)) { $isPublic = true; break; }
}
@endphp
@if($isPublic)
<div>
@yield('content')
<button onclick="toggleTheme()" class="theme-float-btn" title="Ganti tema" aria-label="Ganti tema">
<i class="bi bi-sun-fill theme-toggle-icon"></i>
</button>
</div>
@else
<div x-data="{ sidebarOpen: window.innerWidth >= 768 }" class="flex min-h-screen overflow-hidden" style="background:var(--bg-page)">
<div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 md:hidden" @click="sidebarOpen = false"></div>

<aside x-cloak :class="sidebarOpen ? 'flex' : 'hidden'" class="md:flex md:flex-col w-64 min-w-64 h-screen fixed left-0 top-0 z-50 overflow-y-auto" style="background:var(--bg-sidebar);border-right:1px solid var(--sidebar-border)">
<div class="p-6 flex items-center gap-3">
<img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-16 h-16">
<span class="font-bold text-lg tracking-tight" style="color:var(--text-primary)">RentSCar<span style="color:var(--text-muted)">.id</span></span>
</div>

<nav @click="sidebarOpen = false" class="flex-1 px-4 py-2 space-y-1">
@php $ac = auth()->user()->role === 'admin' ? '/admin/dashboard' : '/staff/dashboard'; @endphp
<a href="{{ url($ac) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('admin/dashboard') || request()->is('staff/dashboard') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('admin/dashboard') || request()->is('staff/dashboard'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-speedometer2 text-lg"></i>
<span class="font-medium text-sm">Dashboard</span>
</a>

<a href="{{ url('/mobil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('mobil*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('mobil*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-car-front text-lg"></i>
<span class="font-medium text-sm">Mobil</span>
</a>

<a href="{{ url('/customer') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('customer*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('customer*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-people text-lg"></i>
<span class="font-medium text-sm">Customer</span>
</a>

<a href="{{ url('/penyewaan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('penyewaan*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('penyewaan*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-journal-text text-lg"></i>
<span class="font-medium text-sm">Penyewaan</span>
</a>

<a href="{{ url('/pengembalian') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('pengembalian*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('pengembalian*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-arrow-return-left text-lg"></i>
<span class="font-medium text-sm">Pengembalian</span>
</a>

@if(auth()->user()->role === 'admin')
<a href="{{ url('/staff') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('staff*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('staff*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-person-gear text-lg"></i>
<span class="font-medium text-sm">Staff</span>
</a>
@endif

<a href="{{ url('/laporan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('laporan*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('laporan*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-bar-chart text-lg"></i>
<span class="font-medium text-sm">Laporan</span>
</a>

@if(auth()->user()->role === 'admin')
<a href="{{ url('/pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->is('pengaturan*') ? 'nav-active' : 'nav-link' }}">
@if(request()->is('pengaturan*'))
<span class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full" style="background:var(--accent);box-shadow:var(--accent-glow)"></span>
@endif
<i class="bi bi-gear text-lg"></i>
<span class="font-medium text-sm">Pengaturan</span>
</a>
@endif

<a href="{{ url('/') }}" target="_blank" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group">
<i class="bi bi-globe text-lg"></i>
<span class="font-medium text-sm">Lihat Website</span>
</a>
</nav>

<div @click="sidebarOpen = false" class="p-4" style="border-top:1px solid var(--sidebar-separator)">
<form method="POST" action="/logout">
@csrf
<button type="submit" class="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg transition-colors logout-btn" style="color:var(--text-muted)">
<i class="bi bi-box-arrow-left text-lg"></i>
<span class="font-medium text-sm">Logout</span>
</button>
</form>
</div>
</aside>

<main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden md:ml-64">
<header class="h-16 flex items-center justify-between px-4 lg:px-8 z-10 shrink-0 relative" style="background:var(--bg-header);border-bottom:1px solid var(--border);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px)">
<div class="flex items-center gap-4">
<button @click="sidebarOpen = !sidebarOpen" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg transition-colors" style="border:1px solid var(--border);color:var(--text-secondary)" aria-label="Buka menu">
<i class="bi bi-list text-xl"></i>
</button>
<h2 class="text-sm font-medium" style="color:var(--text-secondary)">@yield('page-title', 'Dashboard')</h2>
</div>

<div class="flex items-center gap-3">
<button onclick="toggleTheme()" class="w-9 h-9 flex items-center justify-center rounded-lg transition-colors" style="border:1px solid var(--border);color:var(--text-secondary)" title="Ganti tema" aria-label="Ganti tema">
<i class="bi bi-sun-fill theme-toggle-icon"></i>
</button>

<a href="/profile" class="flex items-center gap-3 no-underline group">
<div class="hidden sm:flex flex-col items-end">
<span class="text-sm font-medium transition-colors" style="color:var(--text-primary)">{{ auth()->user()->nama_user }}</span>
<span class="text-xs" style="color:var(--text-muted)">{{ ucfirst(auth()->user()->role) }}</span>
</div>
@if(auth()->user()->foto_profil)
<img src="{{ asset('storage/'.auth()->user()->foto_profil) }}" alt="{{ auth()->user()->nama_user }}" class="w-9 h-9 rounded-full object-cover" style="border:2px solid var(--border)">
@else
<div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg" style="background:var(--accent)">{{ strtoupper(substr(auth()->user()->nama_user, 0, 1)) }}</div>
@endif
</a>
</div>
</header>

<div class="flex-1 overflow-y-auto p-4 lg:p-8">
<div class="max-w-7xl mx-auto w-full pb-12">
@if(session('success'))
<div class="mb-4 p-4 rounded-xl text-sm flex items-center justify-between" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#10b981">
<span>{{ session('success') }}</span>
<button type="button" style="color:rgba(16,185,129,0.6)" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

@if(session('error'))
<div class="mb-4 p-4 rounded-xl text-sm flex items-center justify-between" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444">
<span>{{ session('error') }}</span>
<button type="button" style="color:rgba(239,68,68,0.6)" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

@yield('content')
</div>
</div>
</main>
</div>
@endif
@else
<div>
@yield('content')
<button onclick="toggleTheme()" class="theme-float-btn" title="Ganti tema" aria-label="Ganti tema">
<i class="bi bi-sun-fill theme-toggle-icon"></i>
</button>
</div>
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

function toggleTheme() {
var html = document.documentElement;
html.classList.toggle('dark');
html.classList.add('theme-transition');
setTimeout(function(){ html.classList.remove('theme-transition'); }, 400);
var icons = document.querySelectorAll('.theme-toggle-icon');
var isDark = html.classList.contains('dark');
localStorage.setItem('theme', isDark ? 'dark' : 'light');
icons.forEach(function(el){ el.className = 'bi ' + (isDark ? 'bi-moon-fill' : 'bi-sun-fill') + ' theme-toggle-icon'; });
}

(function() {
var icons = document.querySelectorAll('.theme-toggle-icon');
var isDark = document.documentElement.classList.contains('dark');
icons.forEach(function(el){ el.className = 'bi ' + (isDark ? 'bi-moon-fill' : 'bi-sun-fill') + ' theme-toggle-icon'; });
})();
</script>
@stack('scripts')
</body>
</html>
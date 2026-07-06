<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - RentSCar</title>
<meta name="description" content="Masuk ke dashboard manajemen NrentCar. Kelola armada, customer, dan penyewaan mobil dalam satu sistem terpadu.">
<link rel="canonical" href="{{ url()->current() }}">
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script>if(localStorage.getItem('theme')==='dark'||(!localStorage.getItem('theme')&&window.matchMedia('(prefers-color-scheme:dark)').matches))document.documentElement.classList.add('dark')</script>
@vite('resources/css/app.css')
</head>
<body class="min-h-screen flex font-[Inter] antialiased" style="background:var(--bg-page);color:var(--text-primary)">

<!-- Left Branding -->
<div class="hidden lg:flex flex-1 relative flex-col justify-between p-12 overflow-hidden" style="border-right:1px solid var(--border)">
<div class="absolute top-[-10%] left-[-10%] w-1/2 h-1/2 bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse"></div>
<div class="absolute bottom-[-10%] right-[-10%] w-1/2 h-1/2 bg-red-900 rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

<div class="relative z-10">
<a href="/" class="flex items-center gap-3 mb-8 no-underline">
<img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-20 h-20">
<span class="font-bold text-2xl tracking-tight" style="color:var(--text-primary)">RentsCar<span style="color:var(--text-muted)">.id</span></span>
</a>
</div>

<div class="relative z-10 max-w-xl">
<h1 class="text-5xl font-bold leading-tight mb-6" style="color:var(--text-primary)">
Premium Car Rental <br>
<span class="bg-gradient-to-r from-[#C1121F] to-red-500 bg-clip-text text-transparent">Management System</span>
</h1>
<p class="text-lg" style="color:var(--text-secondary)">Kelola armada, customer, dan penyewaan mobil Anda dalam satu dashboard modern dan profesional.</p>
</div>

<div class="relative z-10" style="color:var(--text-muted);font-size:14px">&copy; 2026 RentSCar Indonesia. All rights reserved.</div>
</div>

<!-- Right Form -->
<div class="flex-1 flex items-center justify-center p-6 relative">
<div class="lg:hidden absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-10"></div>

<div class="w-full max-w-md">
<a href="/" class="lg:hidden flex items-center justify-center gap-3 mb-10 no-underline">
<img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-20 h-20">
<span class="font-bold text-2xl tracking-tight" style="color:var(--text-primary)">RentSCar<span style="color:var(--text-muted)">.id</span></span>
</a>

<div class="p-8 rounded-xl border shadow-2xl relative" style="background:var(--bg-card);border-color:var(--border);box-shadow:var(--glass-shadow)">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="text-2xl font-bold" style="color:var(--text-primary)">Selamat Datang</h2>
<p class="text-sm mt-1" style="color:var(--text-muted)">Silakan masuk ke akun Anda untuk melanjutkan.</p>
</div>
<button onclick="toggleTheme()" class="w-9 h-9 flex items-center justify-center rounded-lg shrink-0" style="border:1px solid var(--border);color:var(--text-secondary)" title="Ganti tema">
<i class="bi bi-sun-fill" id="themeIcon"></i>
</button>
</div>

@if(session('error'))
<div class="mb-6 p-4 rounded-xl text-sm" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444">{{ session('error') }}</div>
@endif

<form method="POST" action="/login">
@csrf
<div class="space-y-5">
<div class="space-y-1.5">
<label class="text-sm font-medium" style="color:var(--text-secondary)">Email</label>
<input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@gmail.com" class="w-full h-10 rounded-lg px-3 text-sm outline-none transition-colors placeholder:text-sm" style="background:var(--bg-input);color:var(--text-primary);border:1px solid var(--input-border);{{ $errors->has('email') ? 'border-color:#ef4444' : '' }}">
@error('email') <p class="text-xs mt-1" style="color:#ef4444">{{ $message }}</p> @enderror
</div>

<div class="space-y-1.5">
<div class="flex items-center justify-between">
<label class="text-sm font-medium" style="color:var(--text-secondary)">Password</label>
</div>
<input type="password" name="password" required placeholder="••••••••" class="w-full h-10 rounded-lg px-3 text-sm outline-none transition-colors placeholder:text-sm" style="background:var(--bg-input);color:var(--text-primary);border:1px solid var(--input-border);{{ $errors->has('password') ? 'border-color:#ef4444' : '' }}">
@error('password') <p class="text-xs mt-1" style="color:#ef4444">{{ $message }}</p> @enderror
@if(session()->has('attempts_left'))
<p class="text-xs mt-1" style="color:#eab308">Sisa percobaan: {{ session('attempts_left') }}</p>
@endif
</div>

<div class="flex items-center gap-2">
<input type="checkbox" name="remember_me" id="remember_me" class="w-4 h-4 rounded" style="accent-color:#C1121F">
<label for="remember_me" class="text-sm" style="color:var(--text-secondary)">Ingat saya</label>
</div>

<button type="submit" class="w-full h-12 rounded-lg text-white font-medium text-base flex items-center justify-center gap-2 transition-all hover:opacity-90" style="background:var(--accent);box-shadow:0 0 24px -6px rgba(193,18,31,0.6)">
Masuk <i class="bi bi-arrow-right"></i>
</button>
</div>
</form>
</div>
</div>
</div>

<script>
function toggleTheme() {
var html = document.documentElement;
var icon = document.getElementById('themeIcon');
html.classList.toggle('dark');
html.classList.add('theme-transition');
setTimeout(function(){ html.classList.remove('theme-transition'); }, 400);
if (html.classList.contains('dark')) {
localStorage.setItem('theme', 'dark');
if (icon) icon.className = 'bi bi-moon-fill';
} else {
localStorage.setItem('theme', 'light');
if (icon) icon.className = 'bi bi-sun-fill';
}
}
(function() {
var icon = document.getElementById('themeIcon');
if (icon) icon.className = document.documentElement.classList.contains('dark') ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
})();
</script>
</body>
</html>
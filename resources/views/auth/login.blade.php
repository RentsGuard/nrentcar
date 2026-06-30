<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RentSCar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex bg-[#080808] font-[Inter] antialiased">
    <!-- Left Branding -->
    <div class="hidden lg:flex flex-1 relative flex-col justify-between p-12 overflow-hidden border-r border-white/[0.05]">
        <div class="absolute top-[-10%] left-[-10%] w-1/2 h-1/2 bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-1/2 h-1/2 bg-red-900 rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

        <div class="relative z-10">
            <a href="/" class="flex items-center gap-3 mb-8 no-underline">
                <img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-20 h-20">
                <span class="font-bold text-2xl tracking-tight text-white">RentsCar<span class="text-white/50 font-normal">.id</span></span>
            </a>
        </div>

        <div class="relative z-10 max-w-xl">
            <h1 class="text-5xl font-bold text-white leading-tight mb-6">
                Premium Car Rental <br>
                <span class="bg-gradient-to-r from-[#C1121F] to-red-500 bg-clip-text text-transparent">Management System</span>
            </h1>
            <p class="text-lg text-white/60">Kelola armada, customer, dan penyewaan mobil Anda dalam satu dashboard modern dan profesional.</p>
        </div>

        <div class="relative z-10 text-white/40 text-sm">&copy; 2026 RentSCar Indonesia. All rights reserved.</div>
    </div>

    <!-- Right Form -->
    <div class="flex-1 flex items-center justify-center p-6 relative">
        <div class="lg:hidden absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-10"></div>

        <div class="w-full max-w-md">
            <a href="/" class="lg:hidden flex items-center justify-center gap-3 mb-10 no-underline">
                <img src="{{ asset('images/nrentcar.png') }}" alt="RentSCar" class="w-20 h-20">
                <span class="font-bold text-2xl tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
            </a>

            <div class="p-8 rounded-xl border border-white/[0.08] bg-[#141414]/80 shadow-2xl backdrop-blur-2xl">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang</h2>
                    <p class="text-white/50 text-sm">Silakan masuk ke akun Anda untuk melanjutkan.</p>
                </div>

                @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">{{ session('error') }}</div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="space-y-5">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-white/80">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@gmail.com" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-white/80">Password</label>
                            </div>
                            <input type="password" name="password" required placeholder="••••••••" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember_me" id="remember_me" class="w-4 h-4 rounded border-white/[0.1] bg-[#0D0D0D] text-[#C1121F] focus:ring-[#C1121F]/50">
                            <label for="remember_me" class="text-sm text-white/60">Ingat saya</label>
                        </div>

                        <button type="submit" class="w-full h-12 rounded-lg bg-[#C1121F] text-white font-medium text-base flex items-center justify-center gap-2 transition-all hover:bg-[#a30f1a] shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)]">
                            Masuk <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

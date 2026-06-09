<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | RentSCar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-[#080808] font-[Inter] antialiased">
    <div class="text-center max-w-sm">
        <div class="text-7xl font-extrabold text-[#C1121F] leading-none mb-4 shadow-[0_0_40px_rgba(193,18,31,0.3)]" style="text-shadow:0 0 40px rgba(193,18,31,0.3)">403</div>
        <div class="text-4xl text-[#C1121F] mb-6"><i class="bi bi-shield-lock"></i></div>
        <h1 class="text-xl font-bold text-white mb-2">Akses Ditolak</h1>
        <p class="text-sm text-white/50 mb-8 leading-relaxed">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi admin jika menurut Anda ini kesalahan.</p>
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_4px_15px_rgba(193,18,31,0.4)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-house"></i> Kembali ke Beranda
        </a>
    </div>
</body>
</html>

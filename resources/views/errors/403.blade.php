<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | RentSCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 24px;
            font-family: 'Inter', sans-serif;
        }
        .error-card {
            text-align: center;
            padding: 48px;
            background: rgba(20,20,20,0.6);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-default);
            border-radius: 16px;
            max-width: 420px;
            width: 100%;
        }
        .error-code {
            font-size: 72px;
            font-weight: 800;
            color: var(--accent-red);
            line-height: 1;
            margin-bottom: 16px;
            text-shadow: 0 0 40px var(--accent-glow);
        }
        .error-icon {
            font-size: 48px;
            color: var(--accent-red);
            margin-bottom: 24px;
        }
        .error-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }
        .error-desc {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
        }
        .error-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            background: var(--accent-red);
            color: white;
            border: none;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 15px var(--accent-glow);
        }
        .error-btn:hover {
            background: var(--accent-hover);
            color: white;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon"><i class="bi bi-shield-lock"></i></div>
        <div class="error-code">403</div>
        <div class="error-title">Akses Ditolak</div>
        <div class="error-desc">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi admin jika menurut Anda ini kesalahan.
        </div>
        <a href="{{ url('/') }}" class="error-btn">
            <i class="bi bi-house"></i> Kembali ke Beranda
        </a>
    </div>
</body>
</html>

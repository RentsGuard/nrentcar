<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RentSCar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #080808;
            min-height: 100vh;
            display: flex;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .login-branding {
            display: none;
            flex: 1;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        @media (min-width: 992px) {
            .login-branding { display: flex; }
        }

        .login-glow-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50%;
            height: 50%;
            background: #C1121F;
            border-radius: 50%;
            filter: blur(150px);
            opacity: 0.2;
            animation: pulse 4s ease-in-out infinite;
        }

        .login-glow-2 {
            position: absolute;
            bottom: -10%;
            right: -10%;
            width: 50%;
            height: 50%;
            background: #7f1d1d;
            border-radius: 50%;
            filter: blur(150px);
            opacity: 0.2;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.3; }
        }

        .login-form-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
        }

        .login-mobile-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: #C1121F;
            border-radius: 50%;
            filter: blur(150px);
            opacity: 0.1;
        }

        @media (min-width: 992px) {
            .login-mobile-glow { display: none; }
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(20,20,20,0.8);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }

        .brand-mobile {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        @media (min-width: 992px) {
            .brand-mobile { display: none; }
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #C1121F;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 18px;
            box-shadow: 0 0 20px rgba(193,18,31,0.6);
        }

        .brand-text {
            font-weight: 700;
            font-size: 24px;
            color: white;
            letter-spacing: -0.02em;
        }

        .brand-text-light {
            color: rgba(255,255,255,0.5);
            font-weight: 400;
        }

        .gradient-text {
            background: linear-gradient(to right, #C1121F, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-input {
            height: 40px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            background: #0D0D0D;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: rgba(193,18,31,0.5);
            box-shadow: 0 0 0 2px rgba(193,18,31,0.3);
        }

        .form-input::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .btn-login {
            height: 48px;
            width: 100%;
            border-radius: 8px;
            background: #C1121F;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 0 24px -6px rgba(193,18,31,0.6);
        }

        .btn-login:hover {
            background: #a30f1a;
        }

        .login-note {
            margin-top: 24px;
            padding: 16px;
            border-radius: 8px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-branding">
        <div class="login-glow-1"></div>
        <div class="login-glow-2"></div>

        <div style="position: relative; z-index: 1;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
                <div class="brand-icon"><i class="bi bi-car-front" style="font-size: 20px;"></i></div>
                <span class="brand-text">RentSCar<span class="brand-text-light">.id</span></span>
            </div>
        </div>

        <div style="position: relative; z-index: 1; max-width: 500px;">
            <h1 style="font-size: 48px; font-weight: 700; color: white; line-height: 1.1; margin-bottom: 24px;">
                Premium Car Rental <br>
                <span class="gradient-text">Management System</span>
            </h1>
            <p style="font-size: 18px; color: rgba(255,255,255,0.6);">
                Kelola armada, customer, dan penyewaan mobil Anda dalam satu dashboard modern dan profesional.
            </p>
        </div>

        <div style="position: relative; z-index: 1; color: rgba(255,255,255,0.4); font-size: 14px;">
            &copy; 2026 RentSCar Indonesia. All rights reserved.
        </div>
    </div>

    <div class="login-form-wrapper">
        <div class="login-mobile-glow"></div>

        <div class="login-card">
            <div class="brand-mobile">
                <div class="brand-icon">R</div>
                <span class="brand-text">RentSCar<span class="brand-text-light">.id</span></span>
            </div>

            <div style="margin-bottom: 32px;">
                <h2 style="font-size: 24px; font-weight: 700; color: white; margin-bottom: 8px;">Selamat Datang</h2>
                <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin: 0;">Silakan masuk ke akun Anda untuk melanjutkan.</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger" role="alert" style="font-size: 14px; padding: 12px; border-radius: 8px;">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.8); display: block; margin-bottom: 6px;">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="admin@rentscar.id" value="{{ old('email') }}" required>
                </div>

                <div style="margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <label style="font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.8); display: block; margin-bottom: 0;">Password</label>
                        <a href="#" style="font-size: 12px; color: #C1121F; text-decoration: none;" onclick="return false;">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" class="form-input" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required>
                </div>

                <button type="submit" class="btn-login">
                    Masuk <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="login-note">
                Gunakan kredensial default untuk masuk ke prototype.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

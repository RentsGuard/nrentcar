@extends('layout')

@section('content')
<style>
  .hero-section {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    background: var(--bg-primary);
  }
  .hero-section::before {
    content: '';
    position: absolute;
    top: -300px;
    right: -200px;
    width: 700px;
    height: 700px;
    background: radial-gradient(circle, rgba(193,18,31,0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .hero-section::after {
    content: '';
    position: absolute;
    bottom: -200px;
    left: -150px;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(193,18,31,0.06) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .hero-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 40px;
    position: relative;
    z-index: 2;
  }
  .hero-nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
  }
  .hero-nav-brand-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: var(--accent-red);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    color: white;
    font-size: 18px;
    box-shadow: 0 0 20px var(--accent-glow);
  }
  .hero-nav-brand-text {
    font-weight: 700;
    font-size: 20px;
    color: white;
    letter-spacing: -0.02em;
  }
  .hero-nav-brand-text .light {
    color: var(--text-secondary);
    font-weight: 400;
  }
  .hero-nav-links {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .hero-nav-link {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.2s;
  }
  .hero-nav-link:hover {
    color: white;
    background: rgba(255,255,255,0.05);
  }
  .hero-nav-btn {
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid transparent;
  }
  .hero-nav-btn.primary {
    background: var(--accent-red);
    color: white;
    box-shadow: 0 4px 15px var(--accent-glow);
  }
  .hero-nav-btn.primary:hover {
    background: var(--accent-hover);
  }
  .hero-nav-btn.outline {
    border-color: rgba(255,255,255,0.2);
    color: white;
  }
  .hero-nav-btn.outline:hover {
    background: rgba(255,255,255,0.05);
  }

  .hero-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 32px;
    position: relative;
    z-index: 1;
    text-align: center;
  }
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    background: rgba(193,18,31,0.1);
    border: 1px solid rgba(193,18,31,0.2);
    color: var(--accent-red);
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 24px;
  }
  .hero-title {
    font-size: 52px;
    font-weight: 800;
    color: white;
    letter-spacing: -0.03em;
    line-height: 1.1;
    margin-bottom: 16px;
    max-width: 700px;
  }
  .hero-title .highlight {
    color: var(--accent-red);
  }
  .hero-subtitle {
    font-size: 18px;
    color: var(--text-secondary);
    max-width: 500px;
    line-height: 1.6;
    margin-bottom: 32px;
  }
  .hero-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
  }
  .hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
  }
  .hero-btn.primary {
    background: var(--accent-red);
    color: white;
    box-shadow: 0 8px 25px var(--accent-glow);
  }
  .hero-btn.primary:hover {
    background: var(--accent-hover);
    transform: translateY(-2px);
  }
  .hero-btn.secondary {
    background: rgba(255,255,255,0.06);
    color: white;
    border: 1px solid rgba(255,255,255,0.1);
  }
  .hero-btn.secondary:hover {
    background: rgba(255,255,255,0.1);
    transform: translateY(-2px);
  }

  .section {
    padding: 80px 32px;
    position: relative;
    z-index: 1;
  }
  .section-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--accent-red);
    margin-bottom: 8px;
    text-align: center;
  }
  .section-title {
    font-size: 32px;
    font-weight: 700;
    color: white;
    text-align: center;
    margin-bottom: 48px;
    letter-spacing: -0.02em;
  }
  .car-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    max-width: 1200px;
    margin: 0 auto;
  }
  .car-card {
    background: rgba(20,20,20,0.6);
    backdrop-filter: blur(16px);
    border: 1px solid var(--border-default);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s;
  }
  .car-card:hover {
    border-color: rgba(193,18,31,0.3);
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
  }
  .car-card-img {
    height: 180px;
    background: rgba(255,255,255,0.03);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: rgba(255,255,255,0.15);
    border-bottom: 1px solid var(--border-default);
  }
  .car-card-body {
    padding: 20px;
  }
  .car-card-name {
    font-size: 18px;
    font-weight: 700;
    color: white;
    margin-bottom: 4px;
  }
  .car-card-type {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 12px;
  }
  .car-card-detail {
    display: flex;
    gap: 16px;
    padding-top: 12px;
    border-top: 1px solid var(--border-default);
  }
  .car-card-detail-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--text-secondary);
  }
  .car-card-price {
    font-size: 20px;
    font-weight: 700;
    color: var(--accent-red);
    margin-top: 12px;
  }
  .car-card-price span {
    font-size: 13px;
    font-weight: 400;
    color: var(--text-secondary);
  }

  .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 24px;
    max-width: 1000px;
    margin: 0 auto;
  }
  .feature-card {
    text-align: center;
    padding: 32px 24px;
    background: rgba(20,20,20,0.4);
    border: 1px solid var(--border-default);
    border-radius: 16px;
    transition: all 0.3s;
  }
  .feature-card:hover {
    border-color: rgba(193,18,31,0.2);
  }
  .feature-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    margin: 0 auto 16px;
    background: rgba(193,18,31,0.1);
    border: 1px solid rgba(193,18,31,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: var(--accent-red);
  }
  .feature-title {
    font-size: 16px;
    font-weight: 600;
    color: white;
    margin-bottom: 8px;
  }
  .feature-desc {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.6;
  }

  .footer {
    border-top: 1px solid var(--border-default);
    padding: 32px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 13px;
    color: var(--text-muted);
    position: relative;
    z-index: 1;
  }
  .footer-links {
    display: flex;
    gap: 24px;
  }
  .footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.2s;
  }
  .footer-links a:hover {
    color: white;
  }

  @media (max-width: 768px) {
    .hero-title { font-size: 32px; }
    .hero-nav { padding: 12px 16px; }
    .hero-nav-links .hero-nav-link:not(.hero-nav-btn) { display: none; }
    .section { padding: 48px 16px; }
    .car-grid { grid-template-columns: 1fr; }
  }
</style>

<div class="hero-section">
  <nav class="hero-nav">
    <a href="/" class="hero-nav-brand">
      <div class="hero-nav-brand-icon">R</div>
      <span class="hero-nav-brand-text">RentSCar<span class="light">.id</span></span>
    </a>
    <div class="hero-nav-links">
      <a href="#mobil" class="hero-nav-link">Mobil</a>
      <a href="#fitur" class="hero-nav-link">Fitur</a>
      <a href="/login" class="hero-nav-btn outline">Masuk</a>
      <a href="/login" class="hero-nav-btn primary">Daftar</a>
    </div>
  </nav>

  <div class="hero-body">
    <div class="hero-badge">
      <i class="bi bi-star-fill"></i>
      Premium Car Rental Service
    </div>
    <h1 class="hero-title">
      Sewa Mobil <span class="highlight">Premium</span><br>Untuk Perjalanan Anda
    </h1>
    <p class="hero-subtitle">
      Nikmati pengalaman berkendara terbaik dengan armada mobil premium kami. Harga terjangkau, kualitas terjamin.
    </p>
    <div class="hero-actions">
      <a href="#mobil" class="hero-btn primary">
        <i class="bi bi-car-front"></i>
        Lihat Mobil
      </a>
      <a href="/login" class="hero-btn secondary">
        <i class="bi bi-box-arrow-in-right"></i>
        Masuk Admin/Staff
      </a>
    </div>
  </div>
</div>

<div class="section" id="mobil">
  <div class="section-label">Armada Kami</div>
  <h2 class="section-title">Mobil Tersedia</h2>
  @if($mobilTersedia->count())
  <div class="car-grid">
    @foreach($mobilTersedia as $mobil)
    <div class="car-card">
      <div class="car-card-img">
        <i class="bi bi-car-front"></i>
      </div>
      <div class="car-card-body">
        <div class="car-card-name">{{ $mobil->nama_mobil }}</div>
        <div class="car-card-type">{{ $mobil->tipe_mobil }} &middot; {{ $mobil->tahun_mobil }}</div>
        <div class="car-card-detail">
          <div class="car-card-detail-item">
            <i class="bi bi-people"></i>
            {{ $mobil->kapasitas_mobil }} kursi
          </div>
          <div class="car-card-detail-item">
            <i class="bi bi-fuel-pump"></i>
            {{ $mobil->bahan_bakar }}
          </div>
        </div>
        <div class="car-card-price">
                          Rp{{ number_format($mobil->harga_mobil, 0, ',', '.') }}
          <span>/hari</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <p style="text-align:center; color: var(--text-secondary);">Belum ada mobil tersedia saat ini.</p>
  @endif
</div>

<div class="section" id="fitur">
  <div class="section-label">Mengapa Kami</div>
  <h2 class="section-title">Kenapa Pilih RentSCar?</h2>
  <div class="features-grid">
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
      <div class="feature-title">Terpercaya</div>
      <div class="feature-desc">Armada terawat dengan standar kualitas tinggi dan asuransi lengkap.</div>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-cash-stack"></i></div>
      <div class="feature-title">Harga Bersaing</div>
      <div class="feature-desc">Nikmati harga sewa terbaik tanpa biaya tersembunyi.</div>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-headset"></i></div>
      <div class="feature-title">24/7 Support</div>
      <div class="feature-desc">Tim customer service siap membantu Anda kapan saja.</div>
    </div>
    <div class="feature-card">
      <div class="feature-icon"><i class="bi bi-geo-alt"></i></div>
      <div class="feature-title">Jangkauan Luas</div>
      <div class="feature-desc">Tersedia di berbagai kota untuk memudahkan perjalanan Anda.</div>
    </div>
  </div>
</div>

<div class="footer">
  <span>&copy; {{ date('Y') }} RentSCar.id &mdash; All Rights Reserved</span>
  <div class="footer-links">
    <a href="/login">Admin</a>
    <a href="/login">Staff</a>
  </div>
</div>
@endsection

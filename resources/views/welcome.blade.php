@extends('layout')

@section('content')
<style>
.hero-section { min-height:100vh; display:flex; flex-direction:column; position:relative; overflow:hidden; background:var(--bg-primary,#080808); }
.hero-section::before { content:''; position:absolute; top:-300px; right:-200px; width:700px; height:700px; background:radial-gradient(circle,rgba(193,18,31,0.1) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
.hero-section::after { content:''; position:absolute; bottom:-200px; left:-150px; width:500px; height:500px; background:radial-gradient(circle,rgba(193,18,31,0.06) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
</style>

<div class="hero-section">
    <nav class="flex items-center justify-between px-6 sm:px-10 py-4 relative z-10">
        <a href="/" class="flex items-center gap-3 no-underline">
            <img src="{{ asset('images/nrentcar.png?v=2') }}" alt="RentSCar" class="w-9 h-9">
            <span class="font-bold text-xl tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
        </a>
        <div class="flex items-center gap-3">
            <a href="/cars" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Mobil</a>
            <a href="#fitur" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Fitur</a>
            <a href="/tentang-kami" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Tentang</a>
            <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-white px-4 py-2 rounded-lg transition-colors no-underline" style="background:#25D366"><i class="bi bi-whatsapp"></i> Hubungi</a>
            <a href="/login" class="text-sm font-semibold text-white/60 px-4 py-2 rounded-lg hover:text-white transition-colors no-underline">Login</a>
        </div>
    </nav>

    <div class="flex-1 flex flex-col items-center justify-center text-center px-6 sm:px-10 relative z-10">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-medium bg-[#C1121F]/10 text-[#C1121F] border border-[#C1121F]/20 mb-6">
            <i class="bi bi-star-fill text-[10px]"></i> Premium Car Rental Service
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 max-w-2xl tracking-tight">
            Sewa Mobil <span class="text-[#C1121F]">Premium</span><br>Untuk Perjalanan Anda
        </h1>
        <p class="text-base sm:text-lg text-white/60 max-w-lg mb-8">Nikmati pengalaman berkendara terbaik dengan armada mobil premium kami. Harga terjangkau, kualitas terjamin.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="/cars" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-[#C1121F] text-white font-semibold text-base shadow-[0_8px_25px_rgba(193,18,31,0.3)] hover:bg-[#a30f1a] hover:-translate-y-0.5 transition-all no-underline">
                <i class="bi bi-car-front"></i> Lihat Mobil
            </a>
            <a href="/login" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-white/[0.06] text-white font-semibold text-base border border-white/[0.1] hover:bg-white/[0.1] hover:-translate-y-0.5 transition-all no-underline">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </div>
    </div>
</div>

<div class="py-16 sm:py-20 px-6 sm:px-10 relative z-10" id="mobil">
    <p class="text-xs font-semibold uppercase tracking-widest text-[#C1121F] text-center mb-2">Armada Kami</p>
    <h2 class="text-3xl sm:text-4xl font-bold text-white text-center mb-12 tracking-tight">Mobil Tersedia</h2>
    @if($mobilTersedia->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach($mobilTersedia as $mobil)
        <a href="/cars/{{ $mobil->id }}" class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden hover:border-[#C1121F]/30 hover:-translate-y-1 transition-all duration-300 shadow-[0_12px_40px_rgba(0,0,0,0.3)] no-underline group">
            @if($mobil->foto_mobil)
            <div class="h-44 overflow-hidden"><img src="{{ asset('storage/'.$mobil->foto_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"></div>
            @else
            <div class="h-44 bg-white/[0.02] flex items-center justify-center text-5xl text-white/[0.12] border-b border-white/[0.06] group-hover:text-[#C1121F]/20 transition-colors"><i class="bi bi-car-front"></i></div>
            @endif
            <div class="p-5">
                <div class="flex items-start justify-between mb-1">
                    <h3 class="text-lg font-bold text-white">{{ $mobil->nama_mobil }}</h3>
                    @php $sc = match($mobil->status_mobil) { 'tersedia' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'disewa' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'maintenance' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' }; $sl = match($mobil->status_mobil) { 'tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Maintenance', default => $mobil->status_mobil }; @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full border whitespace-nowrap {{ $sc }}">{{ $sl }}</span>
                </div>
                <p class="text-sm text-white/50 mb-3">{{ $mobil->tipe_mobil }} &middot; {{ $mobil->tahun_mobil }}</p>
                <div class="flex gap-4 pt-3 border-t border-white/[0.06] text-sm text-white/50">
                    <span class="flex items-center gap-1.5"><i class="bi bi-people"></i> {{ $mobil->kapasitas_mobil }} kursi</span>
                    <span class="flex items-center gap-1.5"><i class="bi bi-fuel-pump"></i> {{ $mobil->bahan_bakar }}</span>
                </div>
                <div class="text-xl font-bold text-[#C1121F] mt-3">Rp{{ number_format($mobil->harga_mobil, 0, ',', '.') }} <span class="text-sm font-normal text-white/50">/hari</span></div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-center text-white/50">Belum ada mobil tersedia saat ini.</p>
    @endif
</div>

<div class="py-16 sm:py-20 px-6 sm:px-10 relative z-10" id="fitur">
    <p class="text-xs font-semibold uppercase tracking-widest text-[#C1121F] text-center mb-2">Mengapa Kami</p>
    <h2 class="text-3xl sm:text-4xl font-bold text-white text-center mb-12 tracking-tight">Kenapa Pilih RentSCar?</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
        <div class="text-center p-8 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
            <div class="w-14 h-14 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-2xl text-[#C1121F] mx-auto mb-4"><i class="bi bi-shield-check"></i></div>
            <h3 class="text-base font-semibold text-white mb-2">Terpercaya</h3>
            <p class="text-sm text-white/50 leading-relaxed">Armada terawat dengan standar kualitas tinggi dan asuransi lengkap.</p>
        </div>
        <div class="text-center p-8 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
            <div class="w-14 h-14 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-2xl text-[#C1121F] mx-auto mb-4"><i class="bi bi-cash-stack"></i></div>
            <h3 class="text-base font-semibold text-white mb-2">Harga Bersaing</h3>
            <p class="text-sm text-white/50 leading-relaxed">Nikmati harga sewa terbaik tanpa biaya tersembunyi.</p>
        </div>
        <div class="text-center p-8 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
            <div class="w-14 h-14 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-2xl text-[#C1121F] mx-auto mb-4"><i class="bi bi-headset"></i></div>
            <h3 class="text-base font-semibold text-white mb-2">24/7 Support</h3>
            <p class="text-sm text-white/50 leading-relaxed">Tim customer service siap membantu Anda kapan saja.</p>
        </div>
        <div class="text-center p-8 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
            <div class="w-14 h-14 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-2xl text-[#C1121F] mx-auto mb-4"><i class="bi bi-geo-alt"></i></div>
            <h3 class="text-base font-semibold text-white mb-2">Jangkauan Luas</h3>
            <p class="text-sm text-white/50 leading-relaxed">Tersedia di berbagai kota untuk memudahkan perjalanan Anda.</p>
        </div>
    </div>
</div>

<div class="py-16 sm:py-20 px-6 sm:px-10 relative z-10" id="lokasi">
    <p class="text-xs font-semibold uppercase tracking-widest text-[#C1121F] text-center mb-2">Lokasi Kami</p>
    <h2 class="text-3xl sm:text-4xl font-bold text-white text-center mb-4 tracking-tight">Temukan Kami</h2>
    <p class="text-white/60 text-sm text-center max-w-lg mx-auto mb-10">Komplek Perumdam/III/4, Tunggul Hitam, Kota Padang</p>
    <div class="max-w-4xl mx-auto rounded-2xl overflow-hidden border border-white/[0.06] shadow-[0_12px_40px_rgba(0,0,0,0.3)]">
        <div id="homeMap" style="height:380px;"></div>
    </div>
</div>

<div class="border-t border-white/[0.06] px-6 sm:px-10 py-8 flex flex-wrap justify-between items-center gap-4 text-sm text-white/40">
    <span>&copy; {{ date('Y') }} RentSCar.id &mdash; All Rights Reserved</span>
    <div class="flex gap-6">
        <a href="/login" class="text-white/50 hover:text-white transition-colors no-underline">Login</a>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('homeMap').setView([-0.923, 100.372], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19
    }).addTo(map);
    L.marker([-0.923, 100.372]).addTo(map)
        .bindPopup('<b>NrentCar Padang</b><br>Komplek Perumdam/III/4<br>Tunggul Hitam, Kota Padang')
        .openPopup();
});
</script>
@endpush

@extends('layout')

@section('title', 'Tentang Kami - NrentCar')
@section('meta_description', 'Kenali NrentCar Padang — mitra terpercaya rental mobil di Padang. Armada berkualitas, harga bersaing, pelayanan profesional. Hubungi kami untuk informasi lebih lanjut.')

@section('content')
<style>
.page-section { min-height:100vh; position:relative; overflow:hidden; background:var(--bg-page); }
.page-section::before { content:''; position:absolute; top:-300px; right:-200px; width:700px; height:700px; background:radial-gradient(circle,rgba(193,18,31,0.08) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
.page-section::after { content:''; position:absolute; bottom:-200px; left:-150px; width:500px; height:500px; background:radial-gradient(circle,rgba(193,18,31,0.05) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
#map { height:400px; border-radius:1rem; z-index:1; }
</style>

<div class="page-section">
    <nav class="flex items-center justify-between px-6 sm:px-10 py-4 relative z-10">
        <a href="/" class="flex items-center gap-3 no-underline">
            <img src="{{ asset('images/nrentcar.png?v=2') }}" alt="NrentCar" class="w-9 h-9">
            <span class="font-bold text-xl tracking-tight text-white">NrentCar<span class="text-white/50 font-normal">.id</span></span>
        </a>
        <div class="flex items-center gap-3">
            <a href="/" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Beranda</a>
            <a href="/cars" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Mobil</a>
            <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-white px-4 py-2 rounded-lg transition-colors no-underline" style="background:#25D366"><i class="bi bi-whatsapp"></i> Hubungi</a>
            @auth
            <a href="{{ url(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/staff/dashboard') }}" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Dashboard</a>
            @else
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Admin</a>
            @endauth
        </div>
    </nav>

    <div class="px-6 sm:px-10 pb-16 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold uppercase tracking-widest text-[#C1121F] mb-2">Tentang Kami</p>
                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4 tracking-tight">NrentCar Padang</h1>
                <p class="text-white/60 text-sm max-w-2xl mx-auto">Mitra terpercaya untuk kebutuhan rental mobil di Kota Padang. Kami menyediakan armada berkualitas dengan harga kompetitif dan pelayanan profesional.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Informasi Kontak</h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-[#C1121F] shrink-0 mt-0.5"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <p class="text-sm font-medium text-white">Alamat</p>
                                <p class="text-sm text-white/60">Komplek Perumdam/III/4, Tunggul Hitam, Kota Padang</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-[#C1121F] shrink-0 mt-0.5"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <p class="text-sm font-medium text-white">WhatsApp</p>
                                <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="text-sm text-[#C1121F] hover:text-red-400 transition-colors no-underline">{{ config('app.admin_wa') }}</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-[#C1121F] shrink-0 mt-0.5"><i class="bi bi-instagram"></i></div>
                            <div>
                                <p class="text-sm font-medium text-white">Instagram</p>
                                <a href="https://instagram.com/N_RentCar_Padang" target="_blank" class="text-sm text-[#C1121F] hover:text-red-400 transition-colors no-underline">@N_RentCar_Padang</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-[#C1121F] shrink-0 mt-0.5"><i class="bi bi-clock"></i></div>
                            <div>
                                <p class="text-sm font-medium text-white">Jam Operasional</p>
                                <p class="text-sm text-white/60">Senin - Sabtu: 08:00 - 20:00<br>Minggu & Hari Libur: 09:00 - 17:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl p-2">
                    <div id="map"></div>
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-xl font-semibold text-white mb-6 tracking-tight">Mengapa Memilih NrentCar?</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-xl text-[#C1121F] mx-auto mb-3"><i class="bi bi-shield-check"></i></div>
                        <h3 class="text-sm font-semibold text-white mb-1">Armada Terawat</h3>
                        <p class="text-xs text-white/50">Mobil berkualitas dengan perawatan rutin dan kondisi prima.</p>
                    </div>
                    <div class="p-6 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-xl text-[#C1121F] mx-auto mb-3"><i class="bi bi-cash-stack"></i></div>
                        <h3 class="text-sm font-semibold text-white mb-1">Harga Bersaing</h3>
                        <p class="text-xs text-white/50">Tarif sewa terjangkau tanpa biaya tersembunyi.</p>
                    </div>
                    <div class="p-6 rounded-2xl border border-white/[0.06] bg-[#141414]/40 hover:border-[#C1121F]/20 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-[#C1121F]/10 border border-[#C1121F]/20 flex items-center justify-center text-xl text-[#C1121F] mx-auto mb-3"><i class="bi bi-headset"></i></div>
                        <h3 class="text-sm font-semibold text-white mb-1">Pelayanan Terbaik</h3>
                        <p class="text-xs text-white/50">Tim siap membantu Anda memilih mobil sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/[0.06] px-6 sm:px-10 py-8 flex flex-wrap justify-between items-center gap-4 text-sm text-white/40">
        <span>&copy; {{ date('Y') }} NrentCar.id &mdash; All Rights Reserved</span>
        <div class="flex gap-6">
            <a href="/" class="text-white/50 hover:text-white transition-colors no-underline">Beranda</a>
            <a href="/cars" class="text-white/50 hover:text-white transition-colors no-underline">Mobil</a>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([-0.923, 100.372], 15);
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
@endsection

@extends('layout')

@section('title', $mobil->nama_mobil)
@section('meta_description', 'Sewa '.$mobil->nama_mobil.' ('.$mobil->tipe_mobil.' '.$mobil->tahun_mobil.') mulai Rp '.number_format($mobil->harga_mobil,0,',','.').'/hari. Tersedia di Padang, hubungi kami untuk reservasi.')

@section('content')
<style>
.detail-page { min-height:100vh; position:relative; overflow:hidden; background:linear-gradient(180deg,var(--bg-page) 0%,var(--bg-card) 100%); }
</style>

<div class="detail-page">
    <nav class="flex items-center justify-between px-6 sm:px-10 py-4 relative z-10">
        <a href="/" class="flex items-center gap-3 no-underline">
            <img src="{{ asset('images/nrentcar.png?v=2') }}" alt="RentSCar" class="w-9 h-9">
            <span class="font-bold text-xl tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
        </a>
        <div class="flex items-center gap-3">
            <a href="/cars" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline"><i class="bi bi-grid"></i> Semua Mobil</a>
            <a href="/tentang-kami" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Tentang</a>
            <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-white px-4 py-2 rounded-lg transition-colors no-underline" style="background:#25D366"><i class="bi bi-whatsapp"></i> Hubungi</a>
            @auth
            <a href="{{ url(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/staff/dashboard') }}" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Dashboard</a>
            @else
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Admin</a>
            @endauth
        </div>
    </nav>

    <div class="sm:hidden sticky top-0 z-30 bg-[#080808]/95 backdrop-blur-xl border-y border-white/[0.06] px-4 py-3">
        <div class="grid grid-cols-3 gap-2 text-center">
            <a href="/cars" class="py-2 rounded-lg bg-white/[0.04] text-white/80 text-xs font-medium no-underline">Mobil</a>
            <a href="/tentang-kami" class="py-2 rounded-lg bg-white/[0.04] text-white/80 text-xs font-medium no-underline">Tentang</a>
            <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="py-2 rounded-lg text-white text-xs font-semibold no-underline" style="background:#25D366">WhatsApp</a>
        </div>
    </div>

    <div class="px-6 sm:px-10 pb-16 relative z-10">
        <a href="/cars" class="inline-flex items-center gap-2 text-sm text-white/50 hover:text-white transition-colors no-underline mb-6"><i class="bi bi-arrow-left"></i> Kembali ke daftar mobil</a>

        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3">
                    <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden">
                        @if($mobil->foto_mobil)
                        <img src="{{ asset('storage/'.$mobil->foto_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="w-full h-64 sm:h-80 object-cover">
                        @else
                        <div class="h-64 sm:h-80 bg-white/[0.02] flex items-center justify-center text-7xl text-white/[0.1] border-b border-white/[0.06]"><i class="bi bi-car-front"></i></div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h1 class="text-2xl font-bold text-white">{{ $mobil->nama_mobil }}</h1>
                                <p class="text-sm text-white/50">{{ $mobil->tipe_mobil }} &middot; {{ $mobil->tahun_mobil }}</p>
                            </div>
                            @php $sc = match($mobil->status_mobil) { 'tersedia' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'disewa' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'maintenance' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' }; $sl = match($mobil->status_mobil) { 'tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Maintenance', default => $mobil->status_mobil }; @endphp
                            <span class="text-xs px-2.5 py-1 rounded-full border {{ $sc }}">{{ $sl }}</span>
                        </div>

                        <div class="text-3xl font-bold text-[#C1121F] mb-6">Rp{{ number_format($mobil->harga_mobil, 0, ',', '.') }} <span class="text-base font-normal text-white/50">/hari</span></div>

                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between py-2 border-b border-white/[0.06]">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-grid-3x3-gap-fill"></i> Baris</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->kapasitas_mobil }} Baris</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-white/[0.06]">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-fuel-pump"></i> Bahan Bakar</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->bahan_bakar }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-white/[0.06]">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-calendar"></i> Tahun</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->tahun_mobil }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-white/[0.06]">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-tag"></i> Tipe</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->tipe_mobil }}</span>
                            </div>
                        </div>

                        @if($mobil->status_mobil === 'tersedia')
                        <a href="https://wa.me/{{ config('app.admin_wa') }}?text={{ urlencode('Halo, saya ingin menyewa '.$mobil->nama_mobil.' (Rp '.number_format($mobil->harga_mobil,0,',','.').'/hari - '.$mobil->tipe_mobil.' '.$mobil->tahun_mobil.'). Apakah masih tersedia?') }}" target="_blank" class="block w-full text-center py-3 rounded-xl text-white font-semibold text-sm hover:brightness-110 transition-all no-underline" style="background:#25D366;box-shadow:0 8px 25px rgba(37,211,102,0.3)"><i class="bi bi-whatsapp mr-2"></i>Sewa Sekarang via WhatsApp</a>
                        @else
                        <a href="https://wa.me/{{ config('app.admin_wa') }}?text={{ urlencode('Halo, saya ingin bertanya tentang ketersediaan '.$mobil->nama_mobil.'.') }}" target="_blank" class="block w-full text-center py-3 rounded-xl bg-white/[0.08] text-white font-semibold text-sm hover:bg-white/[0.12] transition-all no-underline"><i class="bi bi-whatsapp mr-2"></i>Tanya Ketersediaan</a>
                        @endif
                    </div>
                </div>
            </div>

            @if($mobilLain->count())
            <div class="mt-16">
                <h2 class="text-xl font-bold text-white mb-6 tracking-tight">Mobil Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($mobilLain as $lain)
                    <a href="/cars/{{ $lain->id }}" class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden hover:border-[#C1121F]/30 hover:-translate-y-1 transition-all duration-300 shadow-[0_12px_40px_rgba(0,0,0,0.3)] no-underline group">
                        @php $sc = match($lain->status_mobil) { 'tersedia' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'disewa' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'maintenance' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' }; $sl = match($lain->status_mobil) { 'tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Maintenance', default => $lain->status_mobil }; @endphp
                        <div class="relative">
                            @if($lain->foto_mobil)
                            <div class="h-32 overflow-hidden"><img src="{{ asset('storage/'.$lain->foto_mobil) }}" alt="{{ $lain->nama_mobil }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"></div>
                            @else
                            <div class="h-32 bg-white/[0.02] flex items-center justify-center text-3xl text-white/[0.1] border-b border-white/[0.06]"><i class="bi bi-car-front"></i></div>
                            @endif
                            <span class="absolute top-2 right-2 text-[10px] px-2 py-0.5 rounded-full border {{ $sc }}">{{ $sl }}</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-bold text-white mb-0.5">{{ $lain->nama_mobil }}</h3>
                            <p class="text-xs text-white/50 mb-2">{{ $lain->tipe_mobil }}</p>
                            <div class="text-base font-bold text-[#C1121F]">Rp{{ number_format($lain->harga_mobil, 0, ',', '.') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="border-t border-white/[0.06] px-6 sm:px-10 py-8 flex flex-wrap justify-between items-center gap-4 text-sm text-white/40">
        <span>&copy; {{ date('Y') }} RentSCar.id &mdash; All Rights Reserved</span>
        <div class="flex gap-6">
            <a href="/" class="text-white/50 hover:text-white transition-colors no-underline">Beranda</a>
            <a href="/cars" class="text-white/50 hover:text-white transition-colors no-underline">Mobil</a>
        </div>
    </div>
</div>
@endsection

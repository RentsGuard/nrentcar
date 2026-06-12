@extends('layout')

@section('title', $mobil->nama_mobil . ' - RentSCar')

@section('content')
<style>
.detail-page { min-height:100vh; position:relative; overflow:hidden; background:var(--bg-primary,#080808); }
.detail-page::before { content:''; position:absolute; top:-300px; right:-200px; width:700px; height:700px; background:radial-gradient(circle,rgba(193,18,31,0.08) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
.detail-page::after { content:''; position:absolute; bottom:-200px; left:-150px; width:500px; height:500px; background:radial-gradient(circle,rgba(193,18,31,0.05) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
</style>

<div class="detail-page">
    <nav class="flex items-center justify-between px-6 sm:px-10 py-4 relative z-10">
        <a href="/" class="flex items-center gap-3 no-underline">
            <div class="w-9 h-9 rounded-lg bg-[#C1121F] flex items-center justify-center font-bold text-white shadow-[0_0_20px_rgba(193,18,31,0.6)]">R</div>
            <span class="font-bold text-xl tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
        </a>
        <div class="flex items-center gap-3">
            <a href="/cars" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline"><i class="bi bi-grid"></i> Semua Mobil</a>
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Masuk</a>
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg bg-[#C1121F] shadow-[0_4px_15px_rgba(193,18,31,0.3)] hover:bg-[#a30f1a] transition-colors no-underline">Daftar</a>
        </div>
    </nav>

    <div class="px-6 sm:px-10 pb-16 relative z-10">
        <a href="/cars" class="inline-flex items-center gap-2 text-sm text-white/50 hover:text-white transition-colors no-underline mb-6"><i class="bi bi-arrow-left"></i> Kembali ke daftar mobil</a>

        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3">
                    <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden">
                        <div class="h-64 sm:h-80 bg-white/[0.02] flex items-center justify-center text-7xl text-white/[0.1] border-b border-white/[0.06]"><i class="bi bi-car-front"></i></div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h1 class="text-2xl font-bold text-white">{{ $mobil->nama_mobil }}</h1>
                                <p class="text-sm text-white/50">{{ $mobil->tipe_mobil }} &middot; {{ $mobil->tahun_mobil }}</p>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">{{ $mobil->status_mobil }}</span>
                        </div>

                        <div class="text-3xl font-bold text-[#C1121F] mb-6">Rp{{ number_format($mobil->harga_mobil, 0, ',', '.') }} <span class="text-base font-normal text-white/50">/hari</span></div>

                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between py-2 border-b border-white/[0.06]">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-people"></i> Kapasitas</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->kapasitas_mobil }} Kursi</span>
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
                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-white/50 flex items-center gap-2"><i class="bi bi-upc-scan"></i> Plat</span>
                                <span class="text-sm text-white font-medium">{{ $mobil->plat_mobil }}</span>
                            </div>
                        </div>

                        <a href="/login" class="block w-full text-center py-3 rounded-xl bg-[#C1121F] text-white font-semibold text-sm hover:bg-[#a30f1a] transition-colors shadow-[0_8px_25px_rgba(193,18,31,0.3)] no-underline"><i class="bi bi-calendar-check mr-2"></i>Sewa Sekarang</a>
                        <p class="text-xs text-white/40 text-center mt-2">Login untuk melakukan penyewaan</p>
                    </div>
                </div>
            </div>

            @if($mobilLain->count())
            <div class="mt-16">
                <h2 class="text-xl font-bold text-white mb-6 tracking-tight">Mobil Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($mobilLain as $lain)
                    <a href="/cars/{{ $lain->id }}" class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden hover:border-[#C1121F]/30 hover:-translate-y-1 transition-all duration-300 shadow-[0_12px_40px_rgba(0,0,0,0.3)] no-underline group">
                        <div class="h-32 bg-white/[0.02] flex items-center justify-center text-3xl text-white/[0.1] border-b border-white/[0.06] group-hover:text-[#C1121F]/20 transition-colors"><i class="bi bi-car-front"></i></div>
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

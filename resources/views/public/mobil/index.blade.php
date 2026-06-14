@extends('layout')

@section('title', 'Daftar Mobil - RentSCar')

@section('content')
<style>
.page-section { min-height:100vh; position:relative; overflow:hidden; background:var(--bg-primary,#080808); }
.page-section::before { content:''; position:absolute; top:-300px; right:-200px; width:700px; height:700px; background:radial-gradient(circle,rgba(193,18,31,0.08) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
.page-section::after { content:''; position:absolute; bottom:-200px; left:-150px; width:500px; height:500px; background:radial-gradient(circle,rgba(193,18,31,0.05) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
</style>

<div class="page-section">
    <nav class="flex items-center justify-between px-6 sm:px-10 py-4 relative z-10">
        <a href="/" class="flex items-center gap-3 no-underline">
            <img src="{{ asset('images/nrentcar.png?v=2') }}" alt="RentSCar" class="w-9 h-9">
            <span class="font-bold text-xl tracking-tight text-white">RentSCar<span class="text-white/50 font-normal">.id</span></span>
        </a>
        <div class="flex items-center gap-3">
            <a href="/" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline"><i class="bi bi-house"></i> Beranda</a>
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Masuk</a>
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg bg-[#C1121F] shadow-[0_4px_15px_rgba(193,18,31,0.3)] hover:bg-[#a30f1a] transition-colors no-underline">Daftar</a>
        </div>
    </nav>

    <div class="px-6 sm:px-10 pb-16 relative z-10">
        <div class="text-center mb-10">
            <p class="text-xs font-semibold uppercase tracking-widest text-[#C1121F] mb-2">Armada Kami</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2 tracking-tight">Daftar Mobil Tersedia</h1>
            <p class="text-white/50 text-sm">Temukan mobil yang sesuai dengan kebutuhan Anda</p>
        </div>

        <form method="GET" action="/cars" class="max-w-5xl mx-auto mb-10">
            <div class="flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="text-xs text-white/50 block mb-1.5">Cari Mobil</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama mobil, tipe, plat..." class="w-full px-4 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder:text-white/30 focus:border-[#C1121F]/50 focus:outline-none transition-colors">
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Bahan Bakar</label>
                    <select name="bahan_bakar" class="w-full px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors">
                        <option value="">Semua</option>
                        @foreach($bahanBakarList as $bb)
                        <option value="{{ $bb }}" @selected(request('bahan_bakar') === $bb)>{{ $bb }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Min. Kursi</label>
                    <select name="kapasitas" class="w-full px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors">
                        <option value="">Semua</option>
                        @foreach([2,4,5,6,7,8] as $k)
                        <option value="{{ $k }}" @selected((int)request('kapasitas') === $k)>{{ $k }} Kursi</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Urutkan</label>
                    <select name="sort" class="w-full px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors">
                        <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                        <option value="termurah" @selected(request('sort') === 'termurah')>Termurah</option>
                        <option value="termahal" @selected(request('sort') === 'termahal')>Termahal</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#C1121F] text-white text-sm font-semibold hover:bg-[#a30f1a] transition-colors shadow-[0_4px_15px_rgba(193,18,31,0.3)]"><i class="bi bi-search mr-1.5"></i>Cari</button>
                @if(request()->anyFilled('search','bahan_bakar','kapasitas','sort'))
                <a href="/cars" class="px-4 py-2.5 rounded-xl bg-white/[0.06] text-white/70 text-sm hover:text-white hover:bg-white/[0.1] transition-colors no-underline"><i class="bi bi-x-lg mr-1"></i>Reset</a>
                @endif
            </div>
        </form>

        @if($mobilList->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($mobilList as $mobil)
            <a href="/cars/{{ $mobil->id }}" class="rounded-2xl border border-white/[0.06] bg-[#141414]/60 backdrop-blur-xl overflow-hidden hover:border-[#C1121F]/30 hover:-translate-y-1 transition-all duration-300 shadow-[0_12px_40px_rgba(0,0,0,0.3)] no-underline group">
                <div class="h-44 bg-white/[0.02] flex items-center justify-center text-5xl text-white/[0.12] border-b border-white/[0.06] group-hover:text-[#C1121F]/20 transition-colors"><i class="bi bi-car-front"></i></div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-1">
                        <h3 class="text-lg font-bold text-white">{{ $mobil->nama_mobil }}</h3>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 whitespace-nowrap">{{ $mobil->status_mobil }}</span>
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

        <div class="mt-10">
            {{ $mobilList->links('partials.pagination') }}
        </div>
        @else
        <div class="text-center py-20">
            <div class="text-6xl text-white/[0.08] mb-4"><i class="bi bi-car-front"></i></div>
            <p class="text-white/50 text-lg">Tidak ada mobil ditemukan</p>
            <a href="/cars" class="inline-block mt-4 text-sm text-[#C1121F] hover:underline no-underline">Reset filter</a>
        </div>
        @endif
    </div>

    <div class="border-t border-white/[0.06] px-6 sm:px-10 py-8 flex flex-wrap justify-between items-center gap-4 text-sm text-white/40">
        <span>&copy; {{ date('Y') }} RentSCar.id &mdash; All Rights Reserved</span>
        <div class="flex gap-6">
            <a href="/" class="text-white/50 hover:text-white transition-colors no-underline">Beranda</a>
            <a href="/login" class="text-white/50 hover:text-white transition-colors no-underline">Admin</a>
        </div>
    </div>
</div>
@endsection

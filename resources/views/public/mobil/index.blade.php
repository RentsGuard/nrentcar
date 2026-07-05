@extends('layout')

@section('title', 'Daftar Mobil - RentSCar')
@section('meta_description', 'Lihat daftar mobil premium tersedia untuk disewa di Padang. Berbagai pilihan mobil berkualitas dengan harga terjangkau. Sewa mobil mudah dan cepat.')

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
            <a href="/tentang-kami" class="hidden sm:inline text-sm text-white/70 hover:text-white px-3 py-2 rounded-lg hover:bg-white/[0.05] transition-colors no-underline">Tentang</a>
            <a href="https://wa.me/{{ config('app.admin_wa') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-white px-4 py-2 rounded-lg transition-colors no-underline" style="background:#25D366"><i class="bi bi-whatsapp"></i> Hubungi</a>
            @auth
            <a href="{{ url(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/staff/dashboard') }}" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Dashboard</a>
            @else
            <a href="/login" class="text-sm font-semibold text-white px-4 py-2 rounded-lg border border-white/20 hover:bg-white/[0.05] transition-colors no-underline">Admin</a>
            @endauth
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama mobil, tipe, plat..." class="w-full px-4 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm placeholder:text-white/30 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors">
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Bahan Bakar</label>
                    <select name="bahan_bakar" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($bahanBakarList as $bb)
                        <option value="{{ $bb }}" @selected(request('bahan_bakar') === $bb)>{{ $bb }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Min. Baris</label>
                    <select name="kapasitas" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($kapasitasList as $k)
                        <option value="{{ $k }}" @selected((int)request('kapasitas') === $k)>{{ $k }} Baris</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Status</label>
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($statusList as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Urutkan</label>
                    <select name="sort" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                        <option value="termurah" @selected(request('sort') === 'termurah')>Termurah</option>
                        <option value="termahal" @selected(request('sort') === 'termahal')>Termahal</option>
                    </select>
                </div>
                <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#C1121F] text-white hover:bg-[#a30f1a] transition-colors shadow-[0_4px_15px_rgba(193,18,31,0.3)]"><i class="bi bi-search"></i></button>
                @if(request()->anyFilled('search','bahan_bakar','kapasitas','status','sort'))
                <a href="/cars" class="px-4 py-2.5 rounded-xl bg-white/[0.06] text-white/70 text-sm hover:text-white hover:bg-white/[0.1] transition-colors no-underline"><i class="bi bi-x-lg mr-1"></i>Reset</a>
                @endif
            </div>
        </form>

        @if($mobilList->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($mobilList as $mobil)
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
                        <span class="flex items-center gap-1.5"><i class="bi bi-grid-3x3-gap-fill"></i> {{ $mobil->kapasitas_mobil }} baris</span>
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
        </div>
    </div>
</div>
@endsection

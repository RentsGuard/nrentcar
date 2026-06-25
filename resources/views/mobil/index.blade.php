@extends('layout')

@section('title', 'Data Mobil - RentSCar')

@section('page-title', 'Mobil')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Data Mobil</h1>
            <p class="text-white/50 text-sm mt-1">Kelola armada kendaraan dan status ketersediaan.</p>
        </div>
        <a href="/mobil/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Tambah Mobil
        </a>
    </div>

    <form method="GET" action="/mobil">
        <div class="glass-card p-4">
            <div class="flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="text-xs text-white/50 block mb-1.5">Cari Mobil</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, tipe, plat..." class="w-full px-4 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm placeholder:text-white/30 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors">
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Bahan Bakar</label>
                    <select name="bahan_bakar" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($bahanBakarList ?? [] as $bb)
                        <option value="{{ $bb }}" @selected(request('bahan_bakar') === $bb)>{{ $bb }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-32">
                    <label class="text-xs text-white/50 block mb-1.5">Baris</label>
                    <select name="kapasitas" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($kapasitasList ?? [] as $k)
                        <option value="{{ $k }}" @selected((int)request('kapasitas') === $k)>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-36">
                    <label class="text-xs text-white/50 block mb-1.5">Status</label>
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua</option>
                        @foreach($statusList ?? [] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-32">
                    <label class="text-xs text-white/50 block mb-1.5">Urutkan</label>
                    <select name="sort" class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-all appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                        <option value="termurah" @selected(request('sort') === 'termurah')>Termurah</option>
                        <option value="termahal" @selected(request('sort') === 'termahal')>Termahal</option>
                    </select>
                </div>
                <button type="submit" class="h-[38px] px-4 flex items-center justify-center rounded-xl bg-[#C1121F] text-white hover:bg-[#a30f1a] transition-colors shadow-[0_4px_15px_rgba(193,18,31,0.3)]"><i class="bi bi-search mr-1"></i> Filter</button>
                @if(request()->anyFilled('search','bahan_bakar','kapasitas','status','sort'))
                <a href="/mobil" class="px-4 py-2.5 rounded-xl bg-white/[0.06] text-white/70 text-sm hover:text-white hover:bg-white/[0.1] transition-colors no-underline"><i class="bi bi-x-lg mr-1"></i>Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="carGrid">
        @forelse($mobils as $mobil)
        @php $hidden = !$mobil->is_visible; @endphp
        <div class="glass-card group car-item{{ $hidden ? ' opacity-50' : '' }}">
            <div class="relative h-48 overflow-hidden">
                @if($mobil->foto_mobil)
                <img src="{{ asset('storage/'.$mobil->foto_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-[#1a1a1a] to-[#0D0D0D] flex items-center justify-center">
                    <i class="bi bi-car-front text-5xl text-white/20"></i>
                </div>
                @endif
                <div class="absolute top-3 left-3 flex gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-black/60 backdrop-blur-md border-white/10 text-white/90">{{ $mobil->tipe_mobil ?? '-' }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-black/60 backdrop-blur-md border-white/10 text-white/90">{{ $mobil->tahun_mobil }}</span>
                </div>
                @php
                $sc = match($mobil->status_mobil) { 'tersedia' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'disewa' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'maintenance' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' };
                $sl = match($mobil->status_mobil) { 'tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Maintenance', default => $mobil->status_mobil };
                @endphp
                <div class="absolute top-3 right-3 flex gap-1.5">
                    @if($hidden)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-white/[0.08] text-white/50 border-white/10"><i class="bi bi-eye-slash mr-1"></i>Disembunyikan</span>
                    @endif
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <span class="text-lg font-bold text-white tracking-tight drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">Rp {{ number_format($mobil->harga_mobil, 0, ',', '.') }}<span class="text-xs font-normal text-white/70">/hari</span></span>
                </div>
            </div>
            <div class="p-4 space-y-3">
                <div>
                    <h3 class="text-base font-semibold text-white">{{ $mobil->nama_mobil }}</h3>
                    <p class="text-xs text-white/50 mt-0.5">{{ $mobil->plat_mobil }}</p>
                </div>
                <div class="flex items-center gap-4 text-xs text-white/60">
                    <span class="flex items-center gap-1"><i class="bi bi-grid-3x3-gap-fill"></i> {{ $mobil->kapasitas_mobil }} baris</span>
                    <span class="flex items-center gap-1"><i class="bi bi-fuel-pump"></i> {{ $mobil->bahan_bakar ?? '-' }}</span>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-white/[0.05] opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                    <a href="/mobil/{{ $mobil->id }}" class="flex-1 inline-flex items-center justify-center gap-2 h-9 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline">
                        Detail
                    </a>
                    <a href="/mobil/{{ $mobil->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-9 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="/mobil/{{ $mobil->id }}/toggle-visibility" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="inline-flex items-center justify-center gap-2 h-9 px-3 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors" title="{{ $hidden ? 'Tampilkan' : 'Sembunyikan' }}">
                            <i class="bi bi-{{ $hidden ? 'eye' : 'eye-slash' }}"></i>
                        </button>
                    </form>
                    @if($mobil->penyewaan_count === 0)
                    <form action="/mobil/{{ $mobil->id }}" method="POST" onsubmit="return confirm('Yakin hapus mobil {{ $mobil->nama_mobil }}? Data tidak bisa dikembalikan.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center gap-2 h-9 px-3 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 text-sm transition-colors" title="Hapus permanen">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full glass-card p-8 text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-white/[0.04] flex items-center justify-center mb-4">
                <i class="bi bi-car-front text-2xl text-white/30"></i>
            </div>
            <h3 class="text-lg font-semibold text-white/70 mb-1">Belum Ada Mobil</h3>
            <p class="text-sm text-white/50">Tambahkan mobil pertama Anda untuk mulai menyewakan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection



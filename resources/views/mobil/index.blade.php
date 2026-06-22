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

    <div class="glass-card p-4">
        <div class="relative w-full sm:w-72">
            <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
            <input type="text" id="searchInput" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari mobil...">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="carGrid">
        @forelse($mobils as $mobil)
        <div class="glass-card group car-item">
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
                    @if($mobil->trashed())
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-red-900/30 text-red-300 border-red-500/30"><i class="bi bi-trash mr-1"></i>Dihapus</span>
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
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="/mobil/{{ $mobil->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-9 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
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

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('.car-item').forEach(function(el) {
        el.style.display = el.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endpush

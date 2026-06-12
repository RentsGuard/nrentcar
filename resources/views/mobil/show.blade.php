@extends('layout')

@section('title', 'Detail Mobil - RentSCar')

@section('page-title', 'Detail Mobil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/mobil" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">{{ $mobil->nama_mobil }}</h1>
            <p class="text-white/50 text-sm mt-1">{{ $mobil->plat_mobil }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="glass-card overflow-hidden">
                @if($mobil->foto_mobil)
                <img src="{{ asset('storage/'.$mobil->foto_mobil) }}" alt="{{ $mobil->nama_mobil }}" class="w-full h-72 object-cover">
                @else
                <div class="w-full h-72 bg-gradient-to-br from-[#1a1a1a] to-[#0D0D0D] flex items-center justify-center">
                    <i class="bi bi-car-front text-6xl text-white/20"></i>
                </div>
                @endif
            </div>

            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-white mb-4">Informasi Mobil</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-white/50">Nama Mobil</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->nama_mobil }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Plat Nomor</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->plat_mobil }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tahun</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->tahun_mobil }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tipe</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->tipe_mobil ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Kapasitas</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->kapasitas_mobil }} Kursi</p>
                    </div>
                    <div>
                        <span class="text-white/50">Bahan Bakar</span>
                        <p class="text-white font-medium mt-0.5">{{ $mobil->bahan_bakar ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Harga Sewa</span>
                        <p class="text-[#C1121F] font-bold mt-0.5">Rp {{ number_format($mobil->harga_mobil, 0, ',', '.') }} /hari</p>
                    </div>
                    <div>
                        <span class="text-white/50">Status</span>
                        @php
                        $sc = match($mobil->status_mobil) { 'tersedia' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'disewa' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'maintenance' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' };
                        $sl = match($mobil->status_mobil) { 'tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Maintenance', default => $mobil->status_mobil };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border mt-1 {{ $sc }}">{{ $sl }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-white mb-4">Riwayat Penyewaan</h3>
                @forelse($mobil->penyewaan->take(5) as $sewa)
                <div class="flex items-center justify-between py-3 border-b border-white/[0.05] last:border-0">
                    <div>
                        <p class="text-sm text-white font-medium">#{{ $sewa->id }}</p>
                        <p class="text-xs text-white/50">{{ $sewa->customer->nama_customer ?? '-' }}</p>
                    </div>
                    <span class="text-xs text-white/50">{{ $sewa->tanggal_sewa ? $sewa->tanggal_sewa->format('d M Y') : '-' }}</span>
                </div>
                @empty
                <p class="text-sm text-white/50 text-center py-4">Belum ada riwayat penyewaan.</p>
                @endforelse
            </div>

            <div class="flex gap-3">
                <a href="/mobil/{{ $mobil->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-10 rounded-lg bg-white/[0.08] text-white hover:bg-white/[0.12] text-sm transition-colors no-underline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

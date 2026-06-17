@extends('layout')

@section('title', 'Detail Penyewaan - RentSCar')

@section('page-title', 'Detail Penyewaan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/penyewaan" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Penyewaan</h1>
            <p class="text-white/50 text-sm mt-1">#RNT-{{ str_pad($penyewaan->id, 3, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-white mb-4">Informasi Penyewaan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-white/50">Customer</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->customer->nama_customer ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Mobil</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->mobil->nama_mobil ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tanggal Sewa</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->tanggal_sewa ? $penyewaan->tanggal_sewa->format('d M Y') : '-' }} {{ $penyewaan->jam_sewa ?? '' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tanggal Kembali</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->tanggal_kembali ? $penyewaan->tanggal_kembali->format('d M Y') : '-' }} {{ $penyewaan->jam_kembali ?? '' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Lama Sewa</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->lama_sewa }} Hari</p>
                    </div>
                    <div>
                        <span class="text-white/50">Denda / Jam</span>
                        <p class="text-white font-medium mt-0.5">{{ $penyewaan->denda_per_jam ? 'Rp '.number_format($penyewaan->denda_per_jam, 0, ',', '.') : 'Rp 0' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Status</span>
                        @php
                        $sc = match($penyewaan->status) { 'aktif' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'selesai' => 'bg-white/[0.1] text-white', 'dibatalkan' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' };
                        $sl = match($penyewaan->status) { 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan', default => $penyewaan->status };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border mt-1 {{ $sc }}">{{ $sl }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-3">Total Harga</h3>
                <p class="text-2xl font-bold text-white">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</p>
                @if($penyewaan->catatan)
                <div class="mt-4 pt-4 border-t border-white/[0.05]">
                    <span class="text-xs text-white/50">Catatan</span>
                    <p class="text-sm text-white/80 mt-1">{{ $penyewaan->catatan }}</p>
                </div>
                @endif
            </div>

            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-3">Staff</h3>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                        {{ strtoupper(substr($penyewaan->user->nama_user ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">{{ $penyewaan->user->nama_user ?? '-' }}</p>
                        <p class="text-xs text-white/50">Penanggung Jawab</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="/penyewaan/{{ $penyewaan->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-10 rounded-lg bg-white/[0.08] text-white hover:bg-white/[0.12] text-sm transition-colors no-underline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

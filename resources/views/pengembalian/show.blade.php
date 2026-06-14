@extends('layout')

@section('title', 'Detail Pengembalian - RentSCar')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">Informasi lengkap pengembalian mobil.</p>
        </div>
        <a href="/pengembalian/{{ $pengembalian->id }}/edit" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card">
            <div class="px-6 py-5 border-b border-white/[0.05]">
                <h3 class="text-base font-semibold text-white">Informasi Pengembalian</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">ID Penyewaan</p>
                    <p class="text-sm text-white mt-1 font-mono">RNT-{{ str_pad($pengembalian->penyewaan_id, 3, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Tanggal Pengembalian</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->tanggal_pengembalian ? $pengembalian->tanggal_pengembalian->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Kondisi Mobil</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->kondisi_mobil ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Denda</p>
                    <p class="text-sm text-white mt-1 font-semibold">Rp {{ number_format($pengembalian->denda ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Catatan</p>
                    <p class="text-sm text-white/80 mt-1">{{ $pengembalian->catatan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="px-6 py-5 border-b border-white/[0.05]">
                <h3 class="text-base font-semibold text-white">Data Penyewaan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Customer</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->penyewaan?->customer?->nama_customer ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Mobil</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->penyewaan?->mobil?->nama_mobil ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Tanggal Sewa</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->penyewaan?->tanggal_sewa?->format('d M Y') ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Tanggal Rencana Kembali</p>
                    <p class="text-sm text-white mt-1">{{ $pengembalian->penyewaan?->tanggal_kembali?->format('d M Y') ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-white/50 uppercase tracking-wide">Total Harga Sewa</p>
                    <p class="text-sm text-white mt-1">Rp {{ number_format($pengembalian->penyewaan?->total_harga ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

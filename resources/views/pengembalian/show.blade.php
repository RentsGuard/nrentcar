@extends('layout')

@section('title', 'Detail Pengembalian - RentSCar')

<<<<<<< HEAD
@section('page-title', 'Detail Pengembalian')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
=======
@section('content')
<div class="max-w-3xl mx-auto space-y-6">
>>>>>>> aqsha
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
<<<<<<< HEAD
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">RNT-{{ str_pad($pengembalian->penyewaan_id, 3, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-white mb-4">Informasi Pengembalian</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-white/50">Customer</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->customer->nama_customer ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Mobil</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->mobil->nama_mobil ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Plat Mobil</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->mobil->plat_mobil ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Staff</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->user->nama_user ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tgl Kembali (Jadwal)</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->tanggal_kembali ? $pengembalian->penyewaan->tanggal_kembali->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tgl Kembali (Real)</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->tanggal_kembali_real ? $pengembalian->tanggal_kembali_real->format('d M Y H:i') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Telat</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->telat_jam ? $pengembalian->telat_jam.' jam' : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Status</span>
                        @php
                        $sc = match($pengembalian->status_pengembalian) {
                            'tepat_waktu' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'telat' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                            'rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            'telat_dan_rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            default => 'bg-white/[0.1] text-white/80'
                        };
                        $sl = match($pengembalian->status_pengembalian) {
                            'tepat_waktu' => 'Tepat Waktu',
                            'telat' => 'Telat',
                            'rusak' => 'Rusak',
                            'telat_dan_rusak' => 'Telat & Rusak',
                            default => $pengembalian->status_pengembalian
                        };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border mt-1 {{ $sc }}">{{ $sl }}</span>
                    </div>
                </div>
            </div>

            @if($pengembalian->catatan)
            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-3">Catatan</h3>
                <p class="text-sm text-white/80 p-3 rounded-lg bg-white/[0.03] border border-white/[0.05]">{{ $pengembalian->catatan }}</p>
            </div>
            @endif

            @if($pengembalian->foto_kondisi)
            <div class="glass-card overflow-hidden">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider p-4 pb-2">Foto Kondisi</h3>
                <div class="p-4 pt-2">
                    <img src="{{ asset('storage/'.$pengembalian->foto_kondisi) }}" alt="foto kondisi" class="w-full max-w-md rounded-lg border border-white/10">
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-4">Ringkasan Denda</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Denda Telat</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_telat ? 'Rp '.number_format($pengembalian->denda_telat, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Denda Kerusakan</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_kerusakan ? 'Rp '.number_format($pengembalian->denda_kerusakan, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                    <div class="border-t border-white/[0.05] pt-3 flex justify-between text-sm">
                        <span class="text-white/80 font-medium">Total Denda</span>
                        <span class="text-red-400 font-bold text-base">{{ $pengembalian->total_denda ? 'Rp '.number_format($pengembalian->total_denda, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-3">Info Sewa</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-white/50">Total Sewa</span>
                        <span class="text-white font-medium">Rp {{ number_format($pengembalian->penyewaan->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white/50">Denda/jam</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_per_jam ? 'Rp '.number_format($pengembalian->denda_per_jam, 0, ',', '.') : '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="/pengembalian/{{ $pengembalian->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-10 rounded-lg bg-white/[0.08] text-white hover:bg-white/[0.12] text-sm transition-colors no-underline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
=======
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
>>>>>>> aqsha
            </div>
        </div>
    </div>
</div>
@endsection

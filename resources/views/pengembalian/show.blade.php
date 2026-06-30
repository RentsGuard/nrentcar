@extends('layout')

@section('title', 'Detail Pengembalian - RentSCar')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">RNT-{{ str_pad($pengembalian->penyewaan_id, 3, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="/pengembalian/{{ $pengembalian->id }}/edit" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-pencil"></i> Edit
        </a>
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
                        <span class="text-white/50">Tgl Jatuh Tempo</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->penyewaan->tanggal_kembali ? $pengembalian->penyewaan->tanggal_kembali->format('d M Y') : '-' }} {{ $pengembalian->penyewaan->jam_kembali ?? '' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tgl Dikembalikan</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->tanggal_pengembalian ? $pengembalian->tanggal_pengembalian->format('d M Y H:i') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Telat</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->telat_jam ? $pengembalian->telat_jam.' jam' : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Kondisi</span>
                        <p class="text-white font-medium mt-0.5">{{ $pengembalian->kondisi_mobil ?? '-' }}</p>
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
        </div>

        <div class="space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-4">Ringkasan Denda</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Denda / Jam</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_per_jam ? 'Rp '.number_format($pengembalian->denda_per_jam, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Telat</span>
                        <span class="text-white font-medium">{{ $pengembalian->telat_jam ? $pengembalian->telat_jam.' jam' : '-' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Denda Telat</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_telat ? 'Rp '.number_format($pengembalian->denda_telat, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/50">Denda Kerusakan</span>
                        <span class="text-white font-medium">{{ $pengembalian->denda_kerusakan ? 'Rp '.number_format($pengembalian->denda_kerusakan, 0, ',', '.') : 'Rp 0' }}</span>
                    </div>
                    @php $lunas = $pengembalian->status_denda === 'lunas'; @endphp
                    <div class="border-t border-white/[0.05] pt-3 flex justify-between text-sm">
                        <span class="text-white/80 font-medium">Total Denda</span>
                        @if($lunas)
                        <span class="text-emerald-400 font-bold text-base flex items-center gap-1.5">
                            <i class="bi bi-check-circle-fill text-xs"></i> Lunas
                        </span>
                        @else
                        <span class="text-red-400 font-bold text-base">{{ $pengembalian->total_denda ? 'Rp '.number_format($pengembalian->total_denda, 0, ',', '.') : 'Rp 0' }}</span>
                        @endif
                    </div>
                    @if($lunas && $pengembalian->dendaLunasBy)
                    <div class="text-xs text-white/40 text-right pt-1 break-words">Dibayar oleh {{ $pengembalian->dendaLunasBy->nama_user }}, {{ $pengembalian->denda_lunas_at->format('d M Y H:i') }}</div>
                    @endif
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
                        <span class="text-white/50">Status Sewa</span>
                        <span class="text-white font-medium">{{ ucfirst($pengembalian->penyewaan->status) }}</span>
                    </div>
                </div>
            </div>

            @if($pengembalian->total_denda > 0)
            <form action="/pengembalian/{{ $pengembalian->id }}/{{ $pengembalian->status_denda === 'lunas' ? 'batal-lunas' : 'lunas' }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 h-10 rounded-lg {{ $pengembalian->status_denda === 'lunas' ? 'bg-amber-500/10 text-amber-400 hover:bg-amber-500/20' : 'bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20' }} text-sm transition-colors border-0 cursor-pointer mb-3">
                    <i class="bi {{ $pengembalian->status_denda === 'lunas' ? 'bi-arrow-counterclockwise' : 'bi-check-lg' }}"></i>
                    {{ $pengembalian->status_denda === 'lunas' ? 'Batalkan Lunas' : 'Tandai Lunas' }}
                </button>
            </form>
            @endif
            <div class="flex gap-3">
                <a href="/pengembalian/{{ $pengembalian->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-10 rounded-lg bg-white/[0.08] text-white hover:bg-white/[0.12] text-sm transition-colors no-underline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout')

@section('title', 'Cetak Laporan - RentSCar')

@section('page-title', 'Cetak Laporan')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Ringkasan Laporan</h1>
            <p class="text-white/50 text-sm mt-1">Periode: Semua data hingga {{ date('d F Y') }}</p>
        </div>
        <button onclick="window.print()" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all">
            <i class="bi bi-printer"></i> Cetak Halaman
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 print:grid-cols-4">
        <div class="glass-card p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-journal-text text-xl text-white/70"></i></div>
                <div>
                    <p class="text-sm font-medium text-white/50">Total Penyewaan</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalPenyewaan }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-cash-stack text-xl text-white/70"></i></div>
                <div>
                    <p class="text-sm font-medium text-white/50">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-car-front text-xl text-white/70"></i></div>
                <div>
                    <p class="text-sm font-medium text-white/50">Total Mobil</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalMobil }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-people text-xl text-white/70"></i></div>
                <div>
                    <p class="text-sm font-medium text-white/50">Total Customer</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalCustomer }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <h3 class="text-base font-semibold text-white">Data Penyewaan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">ID</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Mobil</th>
                        <th class="px-6 py-4 font-medium">Tanggal Sewa</th>
                        <th class="px-6 py-4 font-medium">Tanggal Kembali</th>
                        <th class="px-6 py-4 font-medium">Total</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Staff</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($penyewaans as $p)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-white/70">RNT-{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $p->customer->nama_customer ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $p->mobil->nama_mobil ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $p->tanggal_sewa ? $p->tanggal_sewa->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $p->tanggal_kembali ? $p->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 font-medium text-white">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                            $sc = match($p->status) { 'aktif' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'selesai' => 'bg-white/[0.1] text-white', 'dibatalkan' => 'bg-red-500/10 text-red-400 border-red-500/20', 'menunggu' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', default => 'bg-white/[0.1] text-white/80' };
                            $sl = match($p->status) { 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan', 'menunggu' => 'Menunggu', default => $p->status };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                        </td>
                        <td class="px-6 py-4 text-white/60">{{ $p->user->nama_user ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-white/50">Tidak ada data penyewaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
            <div>Total: {{ count($penyewaans) }} data penyewaan</div>
        </div>
    </div>

    <div class="text-center text-xs text-white/40">
        Dicetak pada {{ date('d F Y H:i:s') }} oleh {{ auth()->user()->nama_user }} &mdash; &copy; {{ date('Y') }} RentSCar
    </div>
</div>

<style>
@media print {
    body { background: #fff !important; }
    .glass-card { border: 1px solid #ddd !important; }
    .no-print { display: none !important; }
}
</style>
@endsection

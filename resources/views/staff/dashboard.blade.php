@extends('layout')

@section('title', 'Dashboard Staff - RentSCar')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Dashboard</h1>
            <p class="text-white/50 text-sm mt-1">Selamat bertugas, {{ auth()->user()->nama_user }}. Berikut ringkasan hari ini.</p>
        </div>
        <div class="text-sm text-white/60 bg-white/[0.03] px-4 py-2 rounded-lg border border-white/[0.05]">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-car-front text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>12%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Total Mobil</p>
                <h3 class="text-2xl font-bold text-white">{{ $totalMobil }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-check-circle text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>5%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Mobil Tersedia</p>
                <h3 class="text-2xl font-bold text-white">{{ $mobilTersedia }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-people text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>18%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Total Customer</p>
                <h3 class="text-2xl font-bold text-white">{{ $totalCustomer }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-shield-check text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>22%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Terverifikasi</p>
                <h3 class="text-2xl font-bold text-white">{{ $customerTerverifikasi }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-journal-text text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>8%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Penyewaan</p>
                <h3 class="text-2xl font-bold text-white">{{ $totalPenyewaan }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 flex flex-col justify-between h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]"><i class="bi bi-cash-stack text-xl text-white/70"></i></div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><i class="bi bi-arrow-up-short"></i>15%</span>
            </div>
            <div>
                <p class="text-sm font-medium text-white/50 mb-1">Pendapatan</p>
                <h3 class="text-2xl font-bold text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="glass-card lg:col-span-2">
            <div class="p-5 pb-2"><h3 class="text-base font-semibold text-white">Penyewaan &amp; Pendapatan Bulanan</h3></div>
            <div class="p-5 pt-0">
                <div class="h-[280px] w-full"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
        <div class="glass-card">
            <div class="p-5 pb-2"><h3 class="text-base font-semibold text-white">Pertumbuhan Customer</h3></div>
            <div class="p-5 pt-0">
                <div class="h-[280px] w-full"><canvas id="customerChart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card">
            <div class="px-6 py-5 flex justify-between items-center border-b border-white/[0.05]">
                <h3 class="text-base font-semibold text-white">Aktivitas Terbaru</h3>
                <a href="/customer" class="text-sm text-[#C1121F] hover:text-red-400 transition-colors no-underline">Lihat Semua</a>
            </div>
            <div class="p-4">
                @forelse($pelangganBaru as $cust)
                <div class="flex items-center gap-3 p-3 rounded-lg border border-transparent hover:border-white/[0.05] transition-colors">
                    <div class="w-10 h-10 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-sm shrink-0">{{ strtoupper(substr($cust->nama_customer ?? $cust->email, 0, 1)) }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ $cust->nama_customer ?? $cust->email }}</p>
                        <p class="text-xs text-white/50">Customer Baru Mendaftar</p>
                    </div>
                    <div class="text-xs text-white/40 shrink-0">{{ $cust->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <div class="p-6 text-center text-white/50 text-sm">Belum ada customer terdaftar.</div>
                @endforelse
            </div>
        </div>

        <div class="glass-card">
            <div class="px-6 py-5 flex justify-between items-center border-b border-white/[0.05]">
                <h3 class="text-base font-semibold text-white">Penyewaan Aktif</h3>
                <a href="/penyewaan" class="text-sm text-[#C1121F] hover:text-red-400 transition-colors no-underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                        <tr><th class="px-6 py-4 font-medium">ID</th><th class="px-6 py-4 font-medium">Customer</th><th class="px-6 py-4 font-medium">Status</th><th class="px-6 py-4 font-medium text-right">Total</th></tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.05]">
                        @forelse($penyewaanAktif as $sewa)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 font-medium text-white">{{ 'RNT-'.$sewa->id }}</td>
                            <td class="px-6 py-4 text-white/80">{{ $sewa->customer->nama_customer ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @php
                                $bc = match($sewa->status) { 'aktif' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'selesai' => 'bg-white/[0.1] text-white', 'dibatalkan' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $bc }}">{{ ucfirst($sewa->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-medium text-white">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-white/50">Belum ada penyewaan aktif.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const m = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: { labels: m, datasets: [{ label: 'Pendapatan', data: [25,28,26,45,55,38,60,52,48,42,46,85], borderColor: '#C1121F', backgroundColor: 'rgba(193,18,31,0.1)', fill: true, tension: 0.4, borderWidth: 3, pointRadius: 0 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#141414', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, titleColor: '#fff', bodyColor: '#fff', cornerRadius: 8, callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'Jt'; } } } },
            scales: { x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }, y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'M'; } } } }
        }
    });

    new Chart(document.getElementById('customerChart'), {
        type: 'bar',
        data: { labels: m, datasets: [{ label: 'Customer Baru', data: [12,15,10,25,30,18,35,22,20,15,19,45], backgroundColor: '#C1121F', borderRadius: 4, barPercentage: 0.6 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#141414', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, titleColor: '#fff', bodyColor: '#fff', cornerRadius: 8 } },
            scales: { x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }, y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } } }
        }
    });
});
</script>
@endpush
@endsection

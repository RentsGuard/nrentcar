@extends('layout')

@section('title', 'Laporan - RentSCar')

@section('page-title', 'Ringkasan Laporan')

@section('content')
<div class="space-y-6">
    @include('laporan.tabs')

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="glass-card p-5">
            <div class="flex items-center gap-3">
                <div class="stat-icon-sm"><i class="bi bi-journal-text"></i></div>
                <div class="min-w-0">
                    <p class="text-[11px] font-medium text-white/50 uppercase tracking-wider">Penyewaan</p>
                    <h3 class="text-xl font-bold text-white mt-0.5">{{ $totalPenyewaan }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-5">
            <div class="flex items-center gap-3">
                <div class="stat-icon-sm"><i class="bi bi-cash-stack"></i></div>
                <div class="min-w-0">
                    <p class="text-[11px] font-medium text-white/50 uppercase tracking-wider">Pendapatan</p>
                    <h3 class="text-xl lg:text-lg xl:text-xl font-bold text-white mt-0.5 break-words">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-5">
            <div class="flex items-center gap-3">
                <div class="stat-icon-sm"><i class="bi bi-car-front"></i></div>
                <div class="min-w-0">
                    <p class="text-[11px] font-medium text-white/50 uppercase tracking-wider">Mobil</p>
                    <h3 class="text-xl font-bold text-white mt-0.5">{{ $totalMobil }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-5">
            <div class="flex items-center gap-3">
                <div class="stat-icon-sm"><i class="bi bi-people"></i></div>
                <div class="min-w-0">
                    <p class="text-[11px] font-medium text-white/50 uppercase tracking-wider">Customer</p>
                    <h3 class="text-xl font-bold text-white mt-0.5">{{ $totalCustomer }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-5 col-span-2 lg:col-span-1">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-amber-500/10 border border-amber-500/20 shrink-0"><i class="bi bi-exclamation-triangle text-lg text-amber-400"></i></div>
                <div class="min-w-0">
                    <p class="text-[11px] font-medium text-white/50 uppercase tracking-wider">Denda</p>
                    <h3 class="text-xl lg:text-lg xl:text-xl font-bold text-amber-400 mt-0.5 break-words">Rp{{ number_format($totalDenda, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="glass-card">
            <div class="px-5 pt-5 pb-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-white tracking-tight">Pendapatan Bulanan</h3>
                    <span class="text-[11px] text-white/40">(Juta)</span>
                </div>
            </div>
            <div class="p-5 pt-2">
                <div class="h-[260px] w-full"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
        <div class="glass-card">
            <div class="px-5 pt-5 pb-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-white tracking-tight">Penyewaan Bulanan</h3>
                    <span class="text-[11px] text-white/40">(Transaksi)</span>
                </div>
            </div>
            <div class="p-5 pt-2">
                <div class="h-[260px] w-full"><canvas id="rentalChart"></canvas></div>
            </div>
        </div>
        <div class="glass-card">
            <div class="px-5 pt-5 pb-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-white tracking-tight">Denda Bulanan</h3>
                    <span class="text-[11px] text-white/40">(Ribuan)</span>
                </div>
            </div>
            <div class="p-5 pt-2">
                <div class="h-[260px] w-full"><canvas id="dendaChart"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const revData = @json($monthlyRevenue);
    const renData = @json($monthlyRentals);
    const isDark = document.documentElement.classList.contains('dark');
    const tc = isDark ? 'rgba(255,255,255,0.4)' : 'rgba(0,0,0,0.5)';
    const gc = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.08)';
    const tb = isDark ? '#141414' : '#ffffff';
    const tbd = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)';
    const ttc = isDark ? '#fff' : '#1a1a2e';

    window.dashCharts = window.dashCharts || [];

    const allKeys = [...new Set([...Object.keys(revData), ...Object.keys(renData)])].sort();
    const labels = allKeys.map(k => { const p = k.split('-'); const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; return months[parseInt(p[1])-1] + ' ' + p[0]; });
    const revenueValues = allKeys.map(k => revData[k] ? Math.round(parseFloat(revData[k]) / 1000000) : 0);
    const rentalValues = allKeys.map(k => renData[k] ? parseInt(renData[k]) : 0);

    window.dashCharts.push(new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: { labels: labels, datasets: [{ label: 'Pendapatan', data: revenueValues, borderColor: '#C1121F', backgroundColor: 'rgba(193,18,31,0.1)', fill: true, tension: 0.4, borderWidth: 3, pointRadius: 0 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: tb, borderColor: tbd, borderWidth: 1, titleColor: ttc, bodyColor: ttc, cornerRadius: 8, callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'Jt'; } } } },
            scales: { x: { grid: { display: false }, ticks: { color: tc, font: { size: 12 } } }, y: { grid: { color: gc }, ticks: { color: tc, font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'M'; } } } }
        }
    }));

    window.dashCharts.push(new Chart(document.getElementById('rentalChart'), {
        type: 'bar',
        data: { labels: labels, datasets: [{ label: 'Penyewaan', data: rentalValues, backgroundColor: '#C1121F', borderRadius: 4, barPercentage: 0.6 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: tb, borderColor: tbd, borderWidth: 1, titleColor: ttc, bodyColor: ttc, cornerRadius: 8 } },
            scales: { x: { grid: { display: false }, ticks: { color: tc, font: { size: 12 } } }, y: { grid: { color: gc }, ticks: { color: tc, font: { size: 12 } } } }
        }
    }));

    const dendaData = @json($monthlyDenda);
    const dendaValues = allKeys.map(k => dendaData[k] ? Math.round(parseFloat(dendaData[k]) / 1000) : 0);

    window.dashCharts.push(new Chart(document.getElementById('dendaChart'), {
        type: 'bar',
        data: { labels: labels, datasets: [{ label: 'Denda', data: dendaValues, backgroundColor: '#F59E0B', borderRadius: 4, barPercentage: 0.6 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: tb, borderColor: tbd, borderWidth: 1, titleColor: ttc, bodyColor: ttc, cornerRadius: 8, callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'rb'; } } } },
            scales: { x: { grid: { display: false }, ticks: { color: tc, font: { size: 12 } } }, y: { grid: { color: gc }, ticks: { color: tc, font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'rb'; } } } }
        }
    }));
});
</script>
@endpush

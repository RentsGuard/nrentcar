@extends('layout')

@section('title', 'Laporan - RentSCar')

@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Laporan</h1>
        <p class="text-white/50 text-sm mt-1">Ringkasan data dan export laporan.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
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
        <div class="glass-card p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-amber-500/10 border border-amber-500/20"><i class="bi bi-exclamation-triangle text-xl text-amber-400"></i></div>
                <div>
                    <p class="text-sm font-medium text-white/50">Total Denda</p>
                    <h3 class="text-2xl font-bold text-amber-400">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="glass-card">
            <div class="p-5 pb-2"><h3 class="text-base font-semibold text-white">Pendapatan Bulanan</h3></div>
            <div class="p-5 pt-0">
                <div class="h-[280px] w-full"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
        <div class="glass-card">
            <div class="p-5 pb-2"><h3 class="text-base font-semibold text-white">Penyewaan Bulanan</h3></div>
            <div class="p-5 pt-0">
                <div class="h-[280px] w-full"><canvas id="rentalChart"></canvas></div>
            </div>
        </div>
        <div class="glass-card">
            <div class="p-5 pb-2"><h3 class="text-base font-semibold text-white">Denda Bulanan</h3></div>
            <div class="p-5 pt-0">
                <div class="h-[280px] w-full"><canvas id="dendaChart"></canvas></div>
            </div>
        </div>
    </div>

    <div class="glass-card p-6">
        <h3 class="text-base font-semibold text-white mb-4">Export Laporan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="/laporan/export/pdf" target="_blank" class="flex items-center gap-3 p-4 rounded-lg border border-white/[0.06] hover:bg-white/[0.03] transition-colors no-underline group">
                <div class="p-3 rounded-lg bg-[#C1121F]/10 text-[#C1121F]"><i class="bi bi-filetype-pdf text-xl"></i></div>
                <div>
                    <p class="text-sm font-medium text-white group-hover:text-[#C1121F] transition-colors">Export PDF</p>
                    <p class="text-xs text-white/50">Laporan penyewaan</p>
                </div>
            </a>
            <a href="/laporan/export/excel" target="_blank" class="flex items-center gap-3 p-4 rounded-lg border border-white/[0.06] hover:bg-white/[0.03] transition-colors no-underline group">
                <div class="p-3 rounded-lg bg-emerald-500/10 text-emerald-400"><i class="bi bi-file-earmark-spreadsheet text-xl"></i></div>
                <div>
                    <p class="text-sm font-medium text-white group-hover:text-emerald-400 transition-colors">Export Excel</p>
                    <p class="text-xs text-white/50">Data penyewaan</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const revData = @json($monthlyRevenue);
    const renData = @json($monthlyRentals);

    const allKeys = [...new Set([...Object.keys(revData), ...Object.keys(renData)])].sort();
    const labels = allKeys.map(k => { const p = k.split('-'); const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; return months[parseInt(p[1])-1] + ' ' + p[0]; });
    const revenueValues = allKeys.map(k => revData[k] ? Math.round(parseFloat(revData[k]) / 1000000) : 0);
    const rentalValues = allKeys.map(k => renData[k] ? parseInt(renData[k]) : 0);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: { labels: labels, datasets: [{ label: 'Pendapatan', data: revenueValues, borderColor: '#C1121F', backgroundColor: 'rgba(193,18,31,0.1)', fill: true, tension: 0.4, borderWidth: 3, pointRadius: 0 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#141414', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, titleColor: '#fff', bodyColor: '#fff', cornerRadius: 8, callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'Jt'; } } } },
            scales: { x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }, y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'M'; } } } }
        }
    });

    new Chart(document.getElementById('rentalChart'), {
        type: 'bar',
        data: { labels: labels, datasets: [{ label: 'Penyewaan', data: rentalValues, backgroundColor: '#C1121F', borderRadius: 4, barPercentage: 0.6 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#141414', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, titleColor: '#fff', bodyColor: '#fff', cornerRadius: 8 } },
            scales: { x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }, y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } } }
        }
    });

    const dendaData = @json($monthlyDenda);
    const dendaValues = allKeys.map(k => dendaData[k] ? Math.round(parseFloat(dendaData[k]) / 1000) : 0);

    new Chart(document.getElementById('dendaChart'), {
        type: 'bar',
        data: { labels: labels, datasets: [{ label: 'Denda', data: dendaValues, backgroundColor: '#F59E0B', borderRadius: 4, barPercentage: 0.6 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#141414', borderColor: 'rgba(255,255,255,0.1)', borderWidth: 1, titleColor: '#fff', bodyColor: '#fff', cornerRadius: 8, callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'rb'; } } } },
            scales: { x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }, y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'rb'; } } } }
        }
    });
});
</script>
@endpush

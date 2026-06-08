@extends('layout')

@section('title', 'Dashboard Staff - RentSCar')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: white; letter-spacing: -0.02em; margin: 0;">Dashboard</h1>
            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin: 4px 0 0 0;">
                Selamat bertugas, {{ auth()->user()->nama_user }}. Berikut ringkasan hari ini.
            </p>
        </div>
        <div style="font-size: 14px; color: rgba(255,255,255,0.6); background: rgba(255,255,255,0.03); padding: 8px 16px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-car-front"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 12%</span>
            </div>
            <div>
                <div class="stat-card-label">Total Mobil</div>
                <div class="stat-card-value">{{ $totalMobil }}</div>
            </div>
        </div>

        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-check-circle"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 5%</span>
            </div>
            <div>
                <div class="stat-card-label">Mobil Tersedia</div>
                <div class="stat-card-value">{{ $mobilTersedia }}</div>
            </div>
        </div>

        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-people"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 18%</span>
            </div>
            <div>
                <div class="stat-card-label">Total Customer</div>
                <div class="stat-card-value">{{ $totalCustomer }}</div>
            </div>
        </div>

        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-shield-check"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 22%</span>
            </div>
            <div>
                <div class="stat-card-label">Terverifikasi</div>
                <div class="stat-card-value">{{ $customerTerverifikasi }}</div>
            </div>
        </div>

        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-journal-text"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 8%</span>
            </div>
            <div>
                <div class="stat-card-label">Penyewaan</div>
                <div class="stat-card-value">{{ $totalPenyewaan }}</div>
            </div>
        </div>

        <div class="glass-card stat-card">
            <div class="stat-card-header">
                <div class="stat-card-icon"><i class="bi bi-cash-stack"></i></div>
                <span class="badge-custom success" style="font-size: 11px; padding: 2px 8px;"><i class="bi bi-arrow-up-short"></i> 15%</span>
            </div>
            <div>
                <div class="stat-card-label">Pendapatan</div>
                <div class="stat-card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        <div class="glass-card">
            <div style="padding: 20px 24px 12px;">
                <h3 style="font-size: 16px; font-weight: 600; color: white; margin: 0;">Penyewaan & Pendapatan Bulanan</h3>
            </div>
            <div style="padding: 0 24px 24px;">
                <div style="height: 280px; width: 100%;"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>

        <div class="glass-card">
            <div style="padding: 20px 24px 12px;">
                <h3 style="font-size: 16px; font-weight: 600; color: white; margin: 0;">Pertumbuhan Customer</h3>
            </div>
            <div style="padding: 0 24px 24px;">
                <div style="height: 280px; width: 100%;"><canvas id="customerChart"></canvas></div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        <div class="glass-card">
            <div style="padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h3 style="font-size: 16px; font-weight: 600; color: white; margin: 0;">Aktivitas Terbaru</h3>
                <a href="/customer" style="font-size: 14px; color: #C1121F; text-decoration: none;">Lihat Semua</a>
            </div>
            <div style="padding: 8px 16px;">
                @forelse($pelangganBaru as $cust)
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 8px;">
                    <div class="avatar-circle-lg">{{ strtoupper(substr($cust->nama_customer ?? $cust->email, 0, 1)) }}</div>
                    <div style="flex: 1; min-width: 0;">
                        <p style="font-size: 14px; font-weight: 500; color: white; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $cust->nama_customer ?? $cust->email }}</p>
                        <p style="font-size: 12px; color: rgba(255,255,255,0.5); margin: 0;">Customer Baru Mendaftar</p>
                    </div>
                    <div style="font-size: 12px; color: rgba(255,255,255,0.4);">{{ $cust->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <div style="padding: 24px; text-align: center; color: rgba(255,255,255,0.5); font-size: 14px;">Belum ada customer terdaftar.</div>
                @endforelse
            </div>
        </div>

        <div class="glass-card">
            <div style="padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h3 style="font-size: 16px; font-weight: 600; color: white; margin: 0;">Penyewaan Aktif</h3>
                <a href="/penyewaan" style="font-size: 14px; color: #C1121F; text-decoration: none;">Lihat Semua</a>
            </div>
            <div style="overflow-x: auto;">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penyewaanAktif as $sewa)
                        <tr>
                            <td style="font-weight: 500; color: white;">{{ $sewa->kode_penyewaan ?? 'RNT-'.$sewa->id }}</td>
                            <td style="color: rgba(255,255,255,0.8);">{{ $sewa->customer->nama_customer ?? '-' }}</td>
                            <td>
                                @php
                                $badgeClass = match($sewa->status) {
                                    'aktif' => 'success',
                                    'selesai' => 'default',
                                    'dibatalkan' => 'danger',
                                    default => 'default'
                                };
                                @endphp
                                <span class="badge-custom {{ $badgeClass }}">{{ ucfirst($sewa->status) }}</span>
                            </td>
                            <td style="text-align: right; font-weight: 500; color: white;">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align: center; padding: 32px; color: rgba(255,255,255,0.5);">Belum ada penyewaan aktif.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Pendapatan',
                data: [25, 28, 26, 45, 55, 38, 60, 52, 48, 42, 46, 85],
                borderColor: '#C1121F',
                backgroundColor: 'rgba(193, 18, 31, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#141414',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 8,
                    callbacks: { label: function(ctx) { return 'Rp ' + ctx.parsed.y + 'Jt'; } }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } },
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 }, callback: function(v) { return 'Rp' + v + 'M'; } } }
            }
        }
    });

    new Chart(document.getElementById('customerChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Customer Baru',
                data: [12, 15, 10, 25, 30, 18, 35, 22, 20, 15, 19, 45],
                backgroundColor: '#C1121F',
                borderRadius: 4,
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#141414',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 8,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } },
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 12 } } }
            }
        }
    });
});
</script>
@endpush

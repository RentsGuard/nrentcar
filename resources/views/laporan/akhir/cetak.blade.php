<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Akhir Penyewaan - {{ $label ?? '' }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        h1 { color: #C1121F; border-bottom: 2px solid #C1121F; padding-bottom: 8px; font-size: 18px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .subtitle { font-size: 11px; color: #888; }
        .stats { display: flex; gap: 20px; margin-bottom: 20px; }
        .stat-box { border: 1px solid #ddd; padding: 10px 15px; border-radius: 6px; text-align: center; }
        .stat-box .label { font-size: 10px; color: #888; }
        .stat-box .value { font-size: 18px; font-weight: bold; color: #C1121F; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #C1121F; color: white; padding: 8px 10px; text-align: left; font-size: 9px; text-transform: uppercase; }
        td { padding: 6px 10px; border-bottom: 1px solid #eee; font-size: 10px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .status { padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; white-space: nowrap; }
        .aktif { background: #d4edda; color: #155724; }
        .selesai { background: #cce5ff; color: #004085; }
        .dibatalkan { background: #f8d7da; color: #721c24; }
        .check { color: #22c55e; font-weight: bold; }
        .footer { margin-top: 20px; text-align: center; font-size: 9px; color: #aaa; border-top: 1px solid #ddd; padding-top: 10px; }
        .watermark { position: fixed; bottom: 20px; right: 20px; font-size: 60px; color: rgba(0,0,0,0.04); font-weight: bold; transform: rotate(-20deg); }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Laporan Akhir Penyewaan</h1>
            <p class="subtitle">RentSCar.id - Premium Car Rental</p>
        </div>
        <div style="text-align:right;">
            @if(isset($label))
            <p style="font-size:11px;color:#888;">Periode: {{ $label }}</p>
            @endif
            <p style="font-size:11px;color:#888;">Tanggal Cetak: {{ date('d/m/Y') }}</p>
        </div>
    </div>

    <div class="stats">
        <div class="stat-box">
            <div class="label">Total Penyewaan</div>
            <div class="value">{{ $penyewaans->count() }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Pendapatan</div>
            <div class="value">Rp {{ number_format($totalPendapatan ?? $penyewaans->sum('total_harga'), 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>                
                <th>Mobil</th>
                <th>No. HP</th>
                <th>Plat</th>
                <th>Tgl Sewa</th>
                <th>Tgl Kembali</th>
                <th>Lama</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyewaans as $p)
            <tr>
                <td>RNT-{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $p->customer->nama_customer ?? '-' }}</td>
                <td>{{ $p->mobil->nama_mobil ?? '-' }}</td>
                <td>{{ $p->customer->no_hp ?? '-' }}</td>
                <td>{{ $p->mobil->plat_mobil ?? '-' }}</td>
                <td>{{ $p->tanggal_sewa ? $p->tanggal_sewa->format('d/m/Y') : '-' }}</td>
                <td>{{ $p->tanggal_kembali ? $p->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                <td>{{ $p->lama_sewa }} Hari</td>
                <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                <td><span class="status {{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                <td>{{ $p->pengembalian->catatan ?? $p->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="12" style="text-align:center;color:#888;">Tidak ada data penyewaan</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada {{ date('d F Y H:i:s') }} | &copy; {{ date('Y') }} RentSCar.id</p>
    </div>

    @if(isset($label))
    <div class="watermark">SELESAI</div>
    @endif
</body>
</html>
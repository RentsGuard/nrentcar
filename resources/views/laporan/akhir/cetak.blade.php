<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Akhir - {{ $label }}</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #333; }
        h1 { color: #C1121F; border-bottom: 2px solid #C1121F; padding-bottom: 6px; font-size: 18px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .subtitle { font-size: 11px; color: #888; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #C1121F; color: white; padding: 6px 8px; text-align: left; font-size: 9px; text-transform: uppercase; }
        td { padding: 5px 8px; border-bottom: 1px solid #eee; font-size: 10px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .check { color: #22c55e; font-weight: bold; }
        .footer { margin-top: 15px; text-align: center; font-size: 8px; color: #aaa; border-top: 1px solid #ddd; padding-top: 8px; }
        .watermark { position: fixed; bottom: 20px; right: 20px; font-size: 60px; color: rgba(0,0,0,0.04); font-weight: bold; transform: rotate(-20deg); }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>Laporan Akhir</h1>
            <p class="subtitle">RentSCar.id - Premium Car Rental</p>
        </div>
        <div style="text-align:right;">
            <p style="font-size:10px;color:#888;">Periode: {{ $label }}</p>
            <p style="font-size:10px;color:#888;">Tanggal Cetak: {{ date('d/m/Y') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Unit</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Trouble</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyewaans as $p)
            <tr>
                <td>{{ $p->customer->nama_customer ?? '-' }} / {{ $p->customer->no_hp ?? '-' }}</td>
                <td>{{ $p->mobil->nama_mobil ?? '-' }} / {{ $p->mobil->plat_mobil ?? '-' }}</td>
                <td>{{ $p->tanggal_sewa?->format('d/m/y') }}</td>
                <td>{{ $p->lama_sewa }}</td>
                <td>{{ $p->pengembalian?->catatan ?? $p->catatan ?? '-' }}</td>
                <td style="text-align:center;">@if($p->status === 'selesai')<span class="check">&#10003;</span>@else - @endif</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#888;">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada {{ date('d F Y H:i:s') }} | &copy; {{ date('Y') }} RentSCar.id</p>
    </div>

    <div class="watermark">SELESAI</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima - RNT-{{ str_pad($penyewaan->id, 3, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 13px; color: #000; margin: 40px; }
        .header { text-align: center; margin-bottom: 5px; }
        .header h1 { font-size: 20px; margin: 0; font-weight: bold; }
        .header h2 { font-size: 16px; margin: 2px 0; font-weight: bold; }
        .header p { margin: 1px 0; font-size: 12px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin: 15px 0; text-decoration: underline; }
        table.detail { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.detail td { padding: 4px 6px; vertical-align: top; }
        table.detail .label { font-weight: bold; width: 130px; }
        table.detail .value { border-bottom: 1px dotted #999; }
        table.detail .value-filled { padding-bottom: 1px; }
        .terms { font-size: 10px; margin-top: 10px; }
        .terms ol { padding-left: 20px; margin: 5px 0; }
        .terms li { margin-bottom: 2px; line-height: 1.4; }
        .signature { margin-top: 40px; }
        .signature table { width: 100%; border-collapse: collapse; }
        .signature td { text-align: center; width: 50%; vertical-align: top; padding: 0 20px; }
        .signature .sig-title { font-size: 12px; font-weight: bold; margin-bottom: 5px; }
        .signature .sig-date { font-size: 11px; margin-bottom: 50px; color: #333; }
        .signature .sig-line { border-top: 1px solid #000; padding-top: 5px; font-size: 11px; font-weight: bold; }
        .materai { text-align: center; font-size: 10px; margin-top: 15px; }
        hr { border: none; border-top: 1px solid #000; margin: 8px 0; }
        .company-logo { font-size: 24px; font-weight: bold; color: #C1121F; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-logo">N_RentCarPadang</div>
        <h2>PT. Nabil Rental Mobil Padang</h2>
        <p>Komplek Perumdam/III/4, Dadok Tunggul Hitam</p>
    </div>

    <hr>

    <div class="title">TANDA TERIMA</div>

    @php $cust = $penyewaan->customer; @endphp

    <table class="detail">
        <tr>
            <td class="label">Nama Penyewa</td>
            <td class="value value-filled">{{ $cust->nama_customer }} No. KTP/SIM: {{ $cust->nik }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="value value-filled">{{ $cust->alamat_customer }}{{ $cust->kota_kabupaten ? ', '.$cust->kota_kabupaten : '' }}</td>
        </tr>
        <tr>
            <td class="label">Telp.</td>
            <td class="value value-filled">{{ $cust->no_hp }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Mobil</td>
            <td class="value value-filled">1 Unit No. Pol.: {{ $penyewaan->mobil->plat_mobil ?? '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kendaraan</td>
            <td class="value value-filled">{{ $penyewaan->mobil->nama_mobil ?? '' }} ({{ $penyewaan->mobil->tipe_mobil ?? '-' }}) &mdash; {{ $penyewaan->mobil->bahan_bakar ?? '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Lama Sewa</td>
            <td class="value value-filled">{{ $penyewaan->lama_sewa }} hari &mdash; Jam: {{ $penyewaan->jam_sewa ?? '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal di Ambil</td>
            <td class="value value-filled">{{ $penyewaan->tanggal_sewa?->format('d F Y') }} &mdash; Jam: {{ $penyewaan->jam_sewa ?? '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal dikembalikan</td>
            <td class="value value-filled">{{ $penyewaan->tanggal_kembali?->format('d F Y') }} &mdash; Jam: {{ $penyewaan->jam_kembali ?? '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Biaya Sewa</td>
            <td class="value value-filled">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }} &mdash; Biaya Denda: Rp {{ $penyewaan->pengembalian ? number_format($penyewaan->pengembalian->total_denda, 0, ',', '.') : '____________' }}</td>
        </tr>
        <tr>
            <td class="label">Keterangan Lain</td>
            <td class="value value-filled">{{ $penyewaan->catatan ?? '____________' }}</td>
        </tr>
    </table>

    <hr>

    <div class="terms">
        <p><strong>PENTING DIKETAHUI KETENTUAN - KETENTUAN DIBAWAH INI:</strong></p>
        <ol>
            <li>Kendaraan (Mobil) yang disewakan tidak dapat dipindahtangankan kepada pihak lain tanpa izin pemilik kendaraan.</li>
            <li>Kendaraan tidak dapat dijadikan jaminan atau digadaikan. Pelanggaran akan diproses sesuai ketentuan hukum dan pemilik berhak mengambil kembali kendaraan.</li>
            <li>Pemilik kendaraan berhak mengambil kembali kendaraan apabila ditemukan pelanggaran atau kejanggalan dalam penggunaannya.</li>
            <li>Kendaraan harus dikembalikan dalam kondisi yang sama seperti saat diterima.</li>
            <li>Kerusakan body kendaraan menjadi tanggung jawab penyewa.</li>
            <li>Keterlambatan pengembalian dikenakan denda sebesar Rp {{ number_format($penyewaan->denda_per_jam ?? 40000, 0, ',', '.') }} per jam.</li>
        </ol>
    </div>

    <div class="signature">
        <table>
            <tr>
                <td>
                    <div class="sig-title">Pemilik Kendaraan atau<br>yang diberi kuasa</div>
                    <div class="sig-date">Padang, {{ now()->format('d F Y') }}</div>
                    <div class="sig-line">&nbsp;</div>
                </td>
                <td>
                    <div class="sig-title">Penyewa Kendaraan</div>
                    <div class="sig-date">Menyetujui ketentuan tersebut di atas</div>
                    <div class="sig-line">{{ $cust->nama_customer }}</div>
                </td>
            </tr>
        </table>
        <div class="materai">Materai 10.000</div>
    </div>
</body>
</html>

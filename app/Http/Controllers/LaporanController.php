<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Mobil;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');
        $totalMobil = Mobil::count();
        $totalCustomer = Customer::count();

        $monthlyRevenue = Penyewaan::where('status', 'selesai')
            ->selectRaw("DATE_FORMAT(tanggal_kembali, '%Y-%m') as bulan, SUM(total_harga) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $monthlyRentals = Penyewaan::selectRaw("DATE_FORMAT(tanggal_sewa, '%Y-%m') as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('laporan.index', compact(
            'totalPenyewaan', 'totalPendapatan', 'totalMobil', 'totalCustomer',
            'monthlyRevenue', 'monthlyRentals'
        ));
    }

    public function exportPdf()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil', 'user')
            ->latest()->get();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');

        $pdf = Pdf::loadView('laporan.pdf', compact('penyewaans', 'totalPendapatan'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-penyewaan-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil')->latest()->get();

        $writer = new Writer();
        $writer->openToBrowser('laporan-penyewaan-' . date('Y-m-d') . '.xlsx');

        $writer->addRow(Row::fromValues(['ID', 'Customer', 'Mobil', 'Tanggal Sewa', 'Tanggal Kembali', 'Lama Sewa', 'Total Harga', 'Status', 'Catatan']));

        foreach ($penyewaans as $p) {
            $writer->addRow(Row::fromValues([
                'RNT-' . str_pad($p->id, 3, '0', STR_PAD_LEFT),
                $p->customer->nama_customer ?? '-',
                $p->mobil->nama_mobil ?? '-',
                $p->tanggal_sewa ? $p->tanggal_sewa->format('d/m/Y') : '-',
                $p->tanggal_kembali ? $p->tanggal_kembali->format('d/m/Y') : '-',
                $p->lama_sewa . ' Hari',
                'Rp ' . number_format($p->total_harga, 0, ',', '.'),
                ucfirst($p->status),
                $p->catatan ?? '-',
            ]));
        }

        $writer->close();
    }

    public function cetak()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil', 'user')
            ->latest()->get();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');
        $totalPenyewaan = Penyewaan::count();
        $totalMobil = Mobil::count();
        $totalCustomer = Customer::count();

        return view('laporan.cetak', compact(
            'penyewaans', 'totalPendapatan', 'totalPenyewaan', 'totalMobil', 'totalCustomer'
        ));
    }
}

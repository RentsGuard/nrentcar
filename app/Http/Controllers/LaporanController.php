<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use Barryvdh\DomPDF\Facade\Pdf;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Writer\XLSX\Writer;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');
        $totalMobil = Mobil::count();
        $totalCustomer = Customer::count();

        $totalDenda = Pengembalian::sum('total_denda');
        $totalPengembalian = Pengembalian::count();

        $monthlyRevenue = Penyewaan::where('status', 'selesai')
            ->selectRaw("DATE_FORMAT(tanggal_kembali, '%Y-%m') as bulan, SUM(total_harga) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $monthlyRentals = Penyewaan::selectRaw("DATE_FORMAT(tanggal_sewa, '%Y-%m') as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $monthlyDenda = Pengembalian::selectRaw("DATE_FORMAT(tanggal_pengembalian, '%Y-%m') as bulan, SUM(total_denda) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('laporan.index', compact(
            'totalPenyewaan', 'totalPendapatan', 'totalMobil', 'totalCustomer',
            'totalDenda', 'totalPengembalian',
            'monthlyRevenue', 'monthlyRentals', 'monthlyDenda'
        ));
    }

    public function awal()
    {
        $query = Penyewaan::with('customer', 'mobil', 'pengembalian');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama_customer', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                })->orWhereHas('mobil', function ($q) use ($search) {
                    $q->where('plat_mobil', 'like', "%{$search}%")
                        ->orWhere('nama_mobil', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        $penyewaans = $query->latest()->get();

        return view('laporan.awal.index', compact('penyewaans'));
    }

    public function cetakAwal(Penyewaan $penyewaan)
    {
        $penyewaan->load('customer', 'mobil', 'pengembalian', 'user');

        $pdf = Pdf::loadView('laporan.awal.cetak', compact('penyewaan'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('tanda-terima-'.$penyewaan->id.'.pdf');
    }

    public function akhir()
    {
        $query = Penyewaan::with('customer', 'mobil', 'pengembalian');
        $label = 'Semua';

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama_customer', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                })->orWhereHas('mobil', function ($q) use ($search) {
                    $q->where('plat_mobil', 'like', "%{$search}%")
                        ->orWhere('nama_mobil', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        $filterDate = request('filter_date');
        $filterValue = request('filter_value');

        if ($filterDate === 'rentang' && request('start_date') && request('end_date')) {
            $query->whereBetween('tanggal_sewa', [request('start_date'), request('end_date')]);
            $label = request('start_date').' s/d '.request('end_date');
        } elseif ($filterDate === 'bulan' && $filterValue) {
            $query->whereYear('tanggal_sewa', substr($filterValue, 0, 4))
                ->whereMonth('tanggal_sewa', substr($filterValue, 5, 2));
            $label = \Carbon\Carbon::parse($filterValue.'-01')->format('F Y');
        } elseif ($filterDate === 'tahun' && $filterValue) {
            $query->whereYear('tanggal_sewa', $filterValue);
            $label = $filterValue;
        } elseif ($filterDate === 'hari' && $filterValue) {
            $query->whereDate('tanggal_sewa', $filterValue);
            $label = \Carbon\Carbon::parse($filterValue)->format('d/m/Y');
        } elseif ($filterDate === 'minggu' && $filterValue) {
            $startOfWeek = \Carbon\Carbon::parse($filterValue)->startOfWeek();
            $endOfWeek = \Carbon\Carbon::parse($filterValue)->endOfWeek();
            $query->whereBetween('tanggal_sewa', [$startOfWeek, $endOfWeek]);
            $label = $startOfWeek->format('d/m').' - '.$endOfWeek->format('d/m/Y');
        }

        $penyewaans = $query->latest('tanggal_sewa')->get();

        return view('laporan.akhir.index', compact('penyewaans', 'label'));
    }

    public function cetakAkhir()
    {
        $query = Penyewaan::with('customer', 'mobil', 'pengembalian');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama_customer', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                })->orWhereHas('mobil', function ($q) use ($search) {
                    $q->where('plat_mobil', 'like', "%{$search}%")
                        ->orWhere('nama_mobil', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        $filterDate = request('filter_date');
        $filterValue = request('filter_value');
        $label = 'Semua';

        if ($filterDate === 'rentang' && request('start_date') && request('end_date')) {
            $query->whereBetween('tanggal_sewa', [request('start_date'), request('end_date')]);
            $label = request('start_date').' s/d '.request('end_date');
        } elseif ($filterDate === 'bulan' && $filterValue) {
            $query->whereYear('tanggal_sewa', substr($filterValue, 0, 4))
                ->whereMonth('tanggal_sewa', substr($filterValue, 5, 2));
            $label = \Carbon\Carbon::parse($filterValue.'-01')->format('F Y');
        } elseif ($filterDate === 'tahun' && $filterValue) {
            $query->whereYear('tanggal_sewa', $filterValue);
            $label = $filterValue;
        } elseif ($filterDate === 'hari' && $filterValue) {
            $query->whereDate('tanggal_sewa', $filterValue);
            $label = \Carbon\Carbon::parse($filterValue)->format('d/m/Y');
        } elseif ($filterDate === 'minggu' && $filterValue) {
            $startOfWeek = \Carbon\Carbon::parse($filterValue)->startOfWeek();
            $endOfWeek = \Carbon\Carbon::parse($filterValue)->endOfWeek();
            $query->whereBetween('tanggal_sewa', [$startOfWeek, $endOfWeek]);
            $label = $startOfWeek->format('d/m').' - '.$endOfWeek->format('d/m/Y');
        }

        $penyewaans = $query->latest('tanggal_sewa')->get();

        $pdf = Pdf::loadView('laporan.akhir.cetak', compact('penyewaans', 'label'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-akhir-'.date('Y-m-d').'.pdf');
    }

    public function exportPdf()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil', 'user')
            ->latest()->get();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');

        $pdf = Pdf::loadView('laporan.pdf', compact('penyewaans', 'totalPendapatan'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-penyewaan-'.date('Y-m-d').'.pdf');
    }

    public function exportExcel()
    {
        $penyewaans = Penyewaan::with('customer', 'mobil')->latest()->get();

        $writer = new Writer;
        $writer->openToBrowser('laporan-penyewaan-'.date('Y-m-d').'.xlsx');

        $headerStyle = (new Style)->setFontBold()->setFontSize(12)->setBackgroundColor('C1121F')->setFontColor('FFFFFF');
        $writer->addRow(Row::fromValuesWithStyle(['ID', 'Customer', 'Mobil', 'Tanggal Sewa', 'Tanggal Kembali', 'Lama', 'Total Harga', 'Status', 'Catatan'], $headerStyle));

        foreach ($penyewaans as $p) {
            $writer->addRow(Row::fromValues([
                'RNT-'.str_pad($p->id, 3, '0', STR_PAD_LEFT),
                $p->customer->nama_customer ?? '-',
                $p->mobil->nama_mobil ?? '-',
                $p->tanggal_sewa ? $p->tanggal_sewa->format('d/m/Y') : '-',
                $p->tanggal_kembali ? $p->tanggal_kembali->format('d/m/Y') : '-',
                $p->lama_sewa,
                $p->total_harga ? (int) $p->total_harga : 0,
                ucfirst($p->status),
                $p->catatan ?? '-',
            ]));
        }

        $writer->close();
    }

}

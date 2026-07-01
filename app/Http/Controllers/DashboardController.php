<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Pengembalian;
use App\Models\Penyewaan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status_mobil', 'tersedia')->count();
        $totalCustomer = Customer::count();
        $customerTerverifikasi = Customer::where('status_verifikasi', 'disetujui')->count();
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');
        $penyewaanAktif = Penyewaan::where('status', 'aktif')->with('customer', 'mobil')->latest()->take(5)->get();
        $pelangganBaru = Customer::latest()->take(6)->get();

        $monthlyRevenue = Penyewaan::where('status', 'selesai')
            ->selectRaw("DATE_FORMAT(tanggal_kembali, '%Y-%m') as bulan, SUM(total_harga) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $monthlyRentals = Penyewaan::selectRaw("DATE_FORMAT(tanggal_sewa, '%Y-%m') as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $totalDenda = Pengembalian::sum('total_denda');
        $dendaLunas = Pengembalian::where('status_denda', 'lunas')->sum('total_denda');
        $pengembalianHariIni = Pengembalian::where(function ($q) {
            $q->whereDate('tanggal_pengembalian', today())
                ->orWhereDate('denda_lunas_at', today());
        })
            ->count();

        $view = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard';

        return view($view, compact(
            'totalMobil', 'mobilTersedia', 'totalCustomer',
            'customerTerverifikasi', 'totalPenyewaan', 'totalPendapatan',
            'penyewaanAktif', 'pelangganBaru',
            'totalDenda', 'pengembalianHariIni', 'dendaLunas',
            'monthlyRevenue', 'monthlyRentals'
        ));
    }
}

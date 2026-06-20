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
        $totalPendapatan = Penyewaan::whereIn('status', ['aktif', 'selesai'])->sum('total_harga');
        $penyewaanAktif = Penyewaan::where('status', 'aktif')->with('customer', 'mobil')->latest()->take(5)->get();
        $pelangganBaru = Customer::latest()->take(6)->get();

        $totalDenda = Pengembalian::where('status_denda', '!=', 'lunas')->sum('total_denda');
        $pengembalianHariIni = Pengembalian::whereDate('tanggal_pengembalian', today())->count();

        $view = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard';

        return view($view, compact(
            'totalMobil', 'mobilTersedia', 'totalCustomer',
            'customerTerverifikasi', 'totalPenyewaan', 'totalPendapatan',
            'penyewaanAktif', 'pelangganBaru',
            'totalDenda', 'pengembalianHariIni'
        ));
    }
}

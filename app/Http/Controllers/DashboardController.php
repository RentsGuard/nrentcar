<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Customer;
use App\Models\Penyewaan;
use App\Models\Verifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status_mobil', 'tersedia')->count();
        $totalCustomer = Customer::count();
        $customerTerverifikasi = Verifikasi::where('status_verifikasi', 'approve')->distinct('customer_id')->count('customer_id');
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::whereIn('status', ['aktif', 'selesai'])->sum('total_harga');
        $penyewaanAktif = Penyewaan::where('status', 'aktif')->with('customer', 'mobil')->latest()->take(5)->get();
        $pelangganBaru = Customer::latest()->take(6)->get();

        $view = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard';

        return view($view, compact(
            'totalMobil', 'mobilTersedia', 'totalCustomer',
            'customerTerverifikasi', 'totalPenyewaan', 'totalPendapatan',
            'penyewaanAktif', 'pelangganBaru'
        ));
    }
}

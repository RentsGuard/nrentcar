<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Mobil;
use App\Models\Customer;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::where('status', 'selesai')->sum('total_harga');
        $totalMobil = Mobil::count();
        $totalCustomer = Customer::count();
        return view('laporan.index', compact('totalPenyewaan', 'totalPendapatan', 'totalMobil', 'totalCustomer'));
    }
}

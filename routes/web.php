<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Models\Mobil;
use App\Models\Customer;
use App\Models\Penyewaan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $totalCustomer = Customer::count();
        $customerTerverifikasi = Customer::where('status_verifikasi', 'disetujui')->count();
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::whereIn('status', ['berlangsung', 'selesai'])->sum('total_biaya');
        $penyewaanAktif = Penyewaan::where('status', 'berlangsung')->with('customer', 'mobil')->latest()->take(5)->get();
        $pelangganBaru = Customer::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalMobil', 'mobilTersedia', 'totalCustomer',
            'customerTerverifikasi', 'totalPenyewaan', 'totalPendapatan',
            'penyewaanAktif', 'pelangganBaru'
        ));
    })->middleware('role:admin');

    Route::get('/staff/dashboard', function () {
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $totalCustomer = Customer::count();
        $customerTerverifikasi = Customer::where('status_verifikasi', 'disetujui')->count();
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::whereIn('status', ['berlangsung', 'selesai'])->sum('total_biaya');
        $penyewaanAktif = Penyewaan::where('status', 'berlangsung')->with('customer', 'mobil')->latest()->take(5)->get();
        $pelangganBaru = Customer::latest()->take(6)->get();

        return view('staff.dashboard', compact(
            'totalMobil', 'mobilTersedia', 'totalCustomer',
            'customerTerverifikasi', 'totalPenyewaan', 'totalPendapatan',
            'penyewaanAktif', 'pelangganBaru'
        ));
    })->middleware('role:staff');

    Route::middleware('role:admin')->group(function () {
        Route::get('/staff', [StaffController::class,'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class,'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class,'store'])->name('staff.store');
        Route::get('/staff/{id}/edit', [StaffController::class,'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class,'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class,'destroy'])->name('staff.destroy');
    });
});

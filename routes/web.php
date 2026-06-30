<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicMobilController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WilayahController;
use App\Models\Mobil;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [PublicMobilController::class, 'index'])->name('public.mobil.index');
Route::get('/cars/{id}', [PublicMobilController::class, 'show'])->name('public.mobil.show');
Route::get('/tentang-kami', function () {
    return view('public.tentang');
});

Route::prefix('api/wilayah')->group(function () {
    Route::get('/provinsi', [WilayahController::class, 'provinces']);
    Route::get('/kabupaten/{provinceId}', [WilayahController::class, 'regencies']);
    Route::get('/kecamatan/{regencyId}', [WilayahController::class, 'districts']);
    Route::get('/kelurahan/{districtId}', [WilayahController::class, 'villages']);
});

Route::get('/', function () {
    $mobilTersedia = Mobil::where('is_visible', true)->latest()->take(6)->get();

    return view('welcome', compact('mobilTersedia'));
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('role:admin');
    Route::get('/staff/dashboard', [DashboardController::class, 'index'])->middleware('role:staff');

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::get('/customer/{id}', [CustomerController::class, 'show']);
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit']);
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->middleware('role:admin');

    Route::get('/mobil', [MobilController::class, 'index']);
    Route::get('/mobil/create', [MobilController::class, 'create']);
    Route::post('/mobil', [MobilController::class, 'store']);
    Route::get('/mobil/{id}', [MobilController::class, 'show']);
    Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);
    Route::put('/mobil/{id}', [MobilController::class, 'update']);
    Route::put('/mobil/{id}/toggle-visibility', [MobilController::class, 'toggleVisibility'])->middleware('role:admin');

    Route::get('/penyewaan', [PenyewaanController::class, 'index']);
    Route::get('/penyewaan/create', [PenyewaanController::class, 'create']);
    Route::post('/penyewaan', [PenyewaanController::class, 'store']);
    Route::get('/penyewaan/{id}', [PenyewaanController::class, 'show']);
    Route::get('/penyewaan/{id}/edit', [PenyewaanController::class, 'edit']);
    Route::put('/penyewaan/{id}', [PenyewaanController::class, 'update']);
    Route::delete('/penyewaan/{id}', [PenyewaanController::class, 'destroy'])->middleware('role:admin');
    Route::put('/penyewaan/{id}/batalkan', [PenyewaanController::class, 'batalkan']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/ringkasan', [LaporanController::class, 'index']);
    Route::get('/laporan/awal', [LaporanController::class, 'awal']);
    Route::get('/laporan/awal/cetak/{penyewaan}', [LaporanController::class, 'cetakAwal']);
    Route::get('/laporan/akhir', [LaporanController::class, 'akhir']);
    Route::get('/laporan/akhir/cetak', [LaporanController::class, 'cetakAkhir']);

    Route::get('/pengaturan', [PengaturanController::class, 'index']);
    Route::get('/pengaturan/tampilan', [PengaturanController::class, 'tampilan']);
    Route::put('/pengaturan/tampilan', [PengaturanController::class, 'tampilanUpdate']);
    Route::get('/pengaturan/notifikasi', [PengaturanController::class, 'notifikasi']);
    Route::put('/pengaturan/notifikasi', [PengaturanController::class, 'notifikasiUpdate']);

    Route::get('/pengembalian', [PengembalianController::class, 'index']);
    Route::get('/pengembalian/create', [PengembalianController::class, 'create']);
    Route::post('/pengembalian', [PengembalianController::class, 'store']);
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'show']);
    Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit']);
    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update']);
    Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->middleware('role:admin');
    Route::put('/pengembalian/{id}/lunas', [PengembalianController::class, 'tandaiLunas'])->name('pengembalian.lunas');
    Route::put('/pengembalian/{id}/batal-lunas', [PengembalianController::class, 'batalkanLunas'])->name('pengembalian.batal-lunas');

    Route::middleware('role:admin')->group(function () {
        Route::post('/customer/{id}/verify', [CustomerController::class, 'verify']);
        Route::get('/pengaturan/role-akses', [PengaturanController::class, 'roleAkses']);

        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
        Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);

        Route::post('/staff/{id}/reset-password', [StaffController::class, 'resetPassword'])->name('staff.reset-password');
    });
});

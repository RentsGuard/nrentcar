<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DashboardController;
use App\Models\Mobil;
use App\Models\Customer;
use App\Models\Penyewaan;
use App\Models\Verifikasi;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') return redirect('/admin/dashboard');
        if ($role === 'staff') return redirect('/staff/dashboard');
        return redirect('/login');
    }
    $mobilTersedia = Mobil::where('status_mobil', 'tersedia')->latest()->take(6)->get();
    return view('welcome', compact('mobilTersedia'));
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout']);

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
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);

    Route::get('/mobil', [MobilController::class, 'index']);
    Route::get('/mobil/create', [MobilController::class, 'create']);
    Route::post('/mobil', [MobilController::class, 'store']);
    Route::get('/mobil/{id}', [MobilController::class, 'show']);
    Route::get('/mobil/{id}/edit', [MobilController::class, 'edit']);
    Route::put('/mobil/{id}', [MobilController::class, 'update']);
    Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);

    Route::get('/penyewaan', [PenyewaanController::class, 'index']);
    Route::get('/penyewaan/create', [PenyewaanController::class, 'create']);
    Route::post('/penyewaan', [PenyewaanController::class, 'store']);
    Route::get('/penyewaan/{id}', [PenyewaanController::class, 'show']);
    Route::get('/penyewaan/{id}/edit', [PenyewaanController::class, 'edit']);
    Route::put('/penyewaan/{id}', [PenyewaanController::class, 'update']);
    Route::delete('/penyewaan/{id}', [PenyewaanController::class, 'destroy']);

    Route::get('/verifikasi', [VerifikasiController::class, 'index']);
    Route::get('/verifikasi/create', [VerifikasiController::class, 'create']);
    Route::post('/verifikasi', [VerifikasiController::class, 'store']);
    Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show']);
    Route::get('/verifikasi/{id}/edit', [VerifikasiController::class, 'edit']);
    Route::put('/verifikasi/{id}', [VerifikasiController::class, 'update']);
    Route::delete('/verifikasi/{id}', [VerifikasiController::class, 'destroy']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/pengaturan', [PengaturanController::class, 'index']);

    Route::middleware('role:admin')->group(function () {
        Route::get('/staff', [StaffController::class,'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class,'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class,'store'])->name('staff.store');
        Route::get('/staff/{id}/edit', [StaffController::class,'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class,'update'])->name('staff.update');
        Route::delete('/staff/{id}', [StaffController::class,'destroy'])->name('staff.destroy');

        Route::post('/staff/{id}/reset-password', [StaffController::class, 'resetPassword'])->name('staff.reset-password');
        Route::get('/demo/pdf', function () {
            $pdf = Pdf::loadHTML('<h1>RentSCar Invoice</h1><p>Demo PDF generated with DOMPDF.</p>');
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('demo-invoice.pdf');
        });

        // Intervention Image demo
        Route::get('/demo/image', function () {
            $manager = new \Intervention\Image\ImageManager(\Intervention\Image\Drivers\Gd\Driver::class);
            $img = $manager->createImage(200, 200);
            $img->fill('#C1121F');
            $encoded = $img->encodeUsingMediaType('image/png');
            return response($encoded->toString(), 200, ['Content-Type' => 'image/png']);
        });

        // OpenSpout demo
        Route::get('/demo/excel', function () {
            $writer = new Writer();
            $writer->openToBrowser('demo-export.xlsx');
            $writer->addRow(Row::fromValues(['Nama', 'Email', 'Role']));
            $writer->addRow(Row::fromValues(['Admin', 'admin@rentscar.id', 'admin']));
            $writer->addRow(Row::fromValues(['Staff', 'staff@rentscar.id', 'staff']));
            $writer->close();
        });

        // Livewire demo
        Route::get('/demo/livewire', function () {
            return view('livewire.health-check');
        });
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');

    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
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

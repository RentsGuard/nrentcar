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

        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        return view('admin.dashboard');
    });

    Route::get('/staff/dashboard', function () {

        if(auth()->user()->role !== 'staff'){
            abort(403);
        }

        return view('staff.dashboard');
    });
    Route::get('/staff', [StaffController::class,'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class,'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class,'store'])->name('staff.store');
});
<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class PengaturanController extends Controller
{
    public function index()
    {
        $recentActivities = Activity::latest()->take(10)->get();
        return view('pengaturan.index', compact('recentActivities'));
    }

    public function roleAkses()
    {
        $users = User::withCount('penyewaan', 'verifikasi')->latest()->get();
        return view('pengaturan.role-akses', compact('users'));
    }

    public function tampilan()
    {
        $appName = Setting::getValue('app_name', 'RentSCar');
        $appDesc = Setting::getValue('app_description', 'Premium Car Rental System');
        $accentColor = Setting::getValue('app_accent_color', '#C1121F');
        $dendaPerHari = Setting::getValue('rental_denda_per_hari', '50000');
        return view('pengaturan.tampilan', compact('appName', 'appDesc', 'accentColor', 'dendaPerHari'));
    }

    public function tampilanUpdate(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'app_accent_color' => 'required|string|max:7',
            'rental_denda_per_hari' => 'required|numeric|min:0',
        ]);

        Setting::setValue('app_name', $request->app_name);
        Setting::setValue('app_description', $request->app_description);
        Setting::setValue('app_accent_color', $request->app_accent_color);
        Setting::setValue('rental_denda_per_hari', $request->rental_denda_per_hari);

        activity()->log('Pengaturan tampilan diperbarui');

        return redirect('/pengaturan/tampilan')
            ->with('success', 'Pengaturan tampilan berhasil disimpan');
    }

    public function notifikasi()
    {
        $notifEmail = Setting::getValue('notifikasi_email', 'true');
        $notifSistem = Setting::getValue('notifikasi_sistem', 'true');
        return view('pengaturan.notifikasi', compact('notifEmail', 'notifSistem'));
    }

    public function notifikasiUpdate(Request $request)
    {
        $request->validate([
            'notifikasi_email' => 'required|in:true,false',
            'notifikasi_sistem' => 'required|in:true,false',
        ]);

        Setting::setValue('notifikasi_email', $request->notifikasi_email);
        Setting::setValue('notifikasi_sistem', $request->notifikasi_sistem);

        activity()->log('Pengaturan notifikasi diperbarui');

        return redirect('/pengaturan/notifikasi')
            ->with('success', 'Pengaturan notifikasi berhasil disimpan');
    }
}

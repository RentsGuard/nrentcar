@extends('layout')

@section('title', 'Notifikasi - RentSCar')

@section('page-title', 'Notifikasi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengaturan" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Notifikasi</h1>
            <p class="text-white/50 text-sm mt-1">Pengaturan notifikasi sistem.</p>
        </div>
    </div>

    <form action="/pengaturan/notifikasi" method="POST">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Saluran Notifikasi</h3>
                </div>

                <label class="flex items-center justify-between p-4 rounded-lg border border-white/[0.06] hover:bg-white/[0.02] transition-colors cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-emerald-500/10"><i class="bi bi-envelope text-emerald-400"></i></div>
                        <div>
                            <p class="text-sm font-medium text-white">Email Notifikasi</p>
                            <p class="text-xs text-white/50">Terima notifikasi via email untuk aktivitas sistem</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="notifikasi_email" value="false">
                        <input type="checkbox" name="notifikasi_email" value="true" class="sr-only peer" {{ $notifEmail === 'true' ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-white/[0.1] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </label>

                <label class="flex items-center justify-between p-4 rounded-lg border border-white/[0.06] hover:bg-white/[0.02] transition-colors cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-blue-500/10"><i class="bi bi-bell text-blue-400"></i></div>
                        <div>
                            <p class="text-sm font-medium text-white">Notifikasi Sistem</p>
                            <p class="text-xs text-white/50">Tampilkan notifikasi di dalam aplikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="notifikasi_sistem" value="false">
                        <input type="checkbox" name="notifikasi_sistem" value="true" class="sr-only peer" {{ $notifSistem === 'true' ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-white/[0.1] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </label>

                <div class="pt-6 border-t border-white/[0.05] flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 h-10 px-6 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all">
                        <i class="bi bi-check-lg"></i> Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

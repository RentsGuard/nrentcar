@extends('layout')

@section('title', 'Pengaturan - RentSCar')

@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Pengaturan</h1>
        <p class="text-white/50 text-sm mt-1">Konfigurasi dan pengaturan sistem.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass-card p-6">
            <div class="flex flex-col items-center text-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-[#C1121F]/10 flex items-center justify-center">
                    <i class="bi bi-shield-check text-2xl text-[#C1121F]"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white">Role & Akses</h3>
                    <p class="text-xs text-white/50 mt-1">Kelola hak akses dan role pengguna</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 h-9 px-4 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline mt-2">
                    <i class="bi bi-gear"></i> Atur
                </a>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="flex flex-col items-center text-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                    <i class="bi bi-palette text-2xl text-emerald-400"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white">Tampilan</h3>
                    <p class="text-xs text-white/50 mt-1">Sesuaikan tema dan preferensi</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 h-9 px-4 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline mt-2">
                    <i class="bi bi-gear"></i> Atur
                </a>
            </div>
        </div>

        <div class="glass-card p-6">
            <div class="flex flex-col items-center text-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center">
                    <i class="bi bi-bell text-2xl text-amber-400"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white">Notifikasi</h3>
                    <p class="text-xs text-white/50 mt-1">Pengaturan notifikasi sistem</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 h-9 px-4 rounded-lg bg-white/[0.06] text-white/80 hover:bg-white/[0.1] text-sm transition-colors no-underline mt-2">
                    <i class="bi bi-gear"></i> Atur
                </a>
            </div>
        </div>
    </div>

    <div class="glass-card p-6">
        <h3 class="text-base font-semibold text-white mb-4">Informasi Sistem</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="p-3 rounded-lg bg-white/[0.03] border border-white/[0.05] flex justify-between">
                <span class="text-white/50">Versi Aplikasi</span>
                <span class="text-white font-medium">1.0.0</span>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.03] border border-white/[0.05] flex justify-between">
                <span class="text-white/50">Laravel Version</span>
                <span class="text-white font-medium">{{ app()->version() }}</span>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.03] border border-white/[0.05] flex justify-between">
                <span class="text-white/50">PHP Version</span>
                <span class="text-white font-medium">{{ PHP_VERSION }}</span>
            </div>
            <div class="p-3 rounded-lg bg-white/[0.03] border border-white/[0.05] flex justify-between">
                <span class="text-white/50">Database</span>
                <span class="text-white font-medium">MySQL / MariaDB</span>
            </div>
        </div>
    </div>

    <div class="glass-card p-6">
        <h3 class="text-base font-semibold text-white mb-4">Aktivitas Terbaru</h3>
        <div class="space-y-3">
            <div class="flex items-center gap-3 p-3 rounded-lg bg-white/[0.02] border border-white/[0.05]">
                <div class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></div>
                <p class="text-sm text-white/70 flex-1">Sistem berjalan normal</p>
                <span class="text-xs text-white/40">Sekarang</span>
            </div>
            <div class="flex items-center gap-3 p-3 rounded-lg bg-white/[0.02] border border-white/[0.05]">
                <div class="w-2 h-2 rounded-full bg-[#C1121F] shrink-0"></div>
                <p class="text-sm text-white/70 flex-1">{{ auth()->user()->nama_user }} login ke sistem</p>
                <span class="text-xs text-white/40">{{ now()->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

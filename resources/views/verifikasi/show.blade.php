@extends('layout')

@section('title', 'Detail Verifikasi - RentSCar')

@section('page-title', 'Detail Verifikasi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/verifikasi" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Verifikasi</h1>
            <p class="text-white/50 text-sm mt-1">{{ $verifikasi->customer->nama_customer ?? '-' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-base font-semibold text-white mb-4">Informasi Verifikasi</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-white/50">Customer</span>
                        <p class="text-white font-medium mt-0.5">{{ $verifikasi->customer->nama_customer ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">NIK</span>
                        <p class="text-white font-medium mt-0.5 font-mono text-xs">{{ $verifikasi->customer->nik ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Tanggal Verifikasi</span>
                        <p class="text-white font-medium mt-0.5">{{ $verifikasi->tanggal_verifikasi ? $verifikasi->tanggal_verifikasi->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                        <span class="text-white/50">Status</span>
                        @php
                        $sc = match($verifikasi->status_verifikasi) { 'disetujui' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'ditolak' => 'bg-red-500/10 text-red-400 border-red-500/20', 'menunggu' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', default => 'bg-white/[0.1] text-white/80' };
                        $sl = match($verifikasi->status_verifikasi) { 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', 'menunggu' => 'Menunggu', default => $verifikasi->status_verifikasi };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border mt-1 {{ $sc }}">{{ $sl }}</span>
                    </div>
                </div>
                @if($verifikasi->catatan_verifikasi)
                <div class="mt-6 pt-4 border-t border-white/[0.05]">
                    <span class="text-sm text-white/50">Catatan Verifikasi</span>
                    <p class="text-sm text-white/80 mt-2 p-3 rounded-lg bg-white/[0.03] border border-white/[0.05]">{{ $verifikasi->catatan_verifikasi }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="glass-card p-6">
                <h3 class="text-sm font-semibold text-white/70 uppercase tracking-wider mb-3">Verifikator</h3>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                        {{ strtoupper(substr($verifikasi->verifier->nama_user ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">{{ $verifikasi->verifier->nama_user ?? '-' }}</p>
                        <p class="text-xs text-white/50">Verifikator</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="/verifikasi/{{ $verifikasi->id }}/edit" class="flex-1 inline-flex items-center justify-center gap-2 h-10 rounded-lg bg-white/[0.08] text-white hover:bg-white/[0.12] text-sm transition-colors no-underline">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

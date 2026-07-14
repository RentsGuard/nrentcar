@extends('layout')

@section('title', 'Edit Pengembalian - RentSCar')

@section('page-title', 'Edit Pengembalian')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">Perbarui data pengembalian.</p>
        </div>
    </div>

    <form action="/pengembalian/{{ $pengembalian->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Pengembalian</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Pengembalian</label>
                        <input type="datetime-local" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian?->format('Y-m-d\TH:i')) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_pengembalian') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Kerusakan (Rp)</label>
                        <input type="number" name="denda_kerusakan" value="{{ old('denda_kerusakan', $pengembalian->denda_kerusakan ?? 0) }}" min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('denda_kerusakan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kondisi Mobil</label>
                        <input type="text" name="kondisi_mobil" value="{{ old('kondisi_mobil', $pengembalian->kondisi_mobil) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('kondisi_mobil') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Status</label>
                        @php
                        $sc = match($pengembalian->status_pengembalian) {
                            'tepat_waktu' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'telat' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                            'rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            'telat_dan_rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            'awal' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                            default => 'bg-white/[0.1] text-white/80'
                        };
                        $sl = match($pengembalian->status_pengembalian) {
                            'tepat_waktu' => 'Tepat Waktu',
                            'telat' => 'Telat',
                            'rusak' => 'Rusak',
                            'telat_dan_rusak' => 'Telat & Rusak',
                            'awal' => 'Awal',
                            default => $pengembalian->status_pengembalian
                        };
                        @endphp
                        <div class="h-10 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Telat (hari)</label>
                        <div class="h-10 flex items-center text-white font-medium">{{ $pengembalian->telat_jam ?? 0 }} hari</div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda / Hari</label>
                        <div class="h-10 flex items-center text-white font-medium">Rp {{ number_format($pengembalian->denda_per_jam ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Telat</label>
                        <div class="h-10 flex items-center text-white font-medium">Rp {{ number_format($pengembalian->denda_telat ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Total Denda</label>
                        <div class="h-10 flex items-center text-base font-bold text-[#C1121F]">Rp {{ number_format($pengembalian->total_denda ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
                        <textarea name="catatan" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan', $pengembalian->catatan) }}</textarea>
                        @error('catatan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Denda telat dihitung otomatis per hari. Denda kerusakan dapat disesuaikan. Simpan untuk re-kalkulasi.
                </div>

                <div class="pt-6 border-t border-white/[0.05] flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 h-10 px-6 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

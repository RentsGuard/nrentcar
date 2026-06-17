@extends('layout')

@section('title', 'Pengembalian Baru - RentSCar')

@section('page-title', 'Pengembalian Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Pengembalian Baru</h1>
            <p class="text-white/50 text-sm mt-1">Catat pengembalian mobil dan hitung denda.</p>
        </div>
    </div>

    <form action="/pengembalian" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Data Pengembalian</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Penyewaan</label>
                        <select name="penyewaan_id" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih Penyewaan --</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Kembali (Real)</label>
                        <input type="datetime-local" name="tanggal_kembali_real" value="{{ old('tanggal_kembali_real') }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Kerusakan (Rp)</label>
                        <input type="number" name="denda_kerusakan" value="{{ old('denda_kerusakan', 0) }}" min="0" placeholder="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
                        <textarea name="catatan" rows="2" placeholder="Kondisi mobil saat kembali..." class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Foto Kondisi (opsional)</label>
                        <input type="file" name="foto_kondisi" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all">
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Denda telat dihitung otomatis per jam jika melewati tanggal kembali yang dijadwalkan. Denda kerusakan diisi manual jika ada.
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

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
<<<<<<< HEAD
            <p class="text-white/50 text-sm mt-1">Perbarui data pengembalian dan denda.</p>
        </div>
    </div>

    <form action="/pengembalian/{{ $pengembalian->id }}" method="POST" enctype="multipart/form-data">
=======
            <p class="text-white/50 text-sm mt-1">Perbarui data pengembalian.</p>
        </div>
    </div>

    <form action="/pengembalian/{{ $pengembalian->id }}" method="POST">
>>>>>>> aqsha
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
<<<<<<< HEAD
                        <label class="text-sm font-medium text-white/80">Tanggal Kembali (Real)</label>
                        <input type="datetime-local" name="tanggal_kembali_real" value="{{ old('tanggal_kembali_real', $pengembalian->tanggal_kembali_real?->format('Y-m-d\TH:i')) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Kerusakan (Rp)</label>
                        <input type="number" name="denda_kerusakan" value="{{ old('denda_kerusakan', $pengembalian->denda_kerusakan ?? 0) }}" min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
=======
                        <label class="text-sm font-medium text-white/80">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian?->format('Y-m-d')) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm">Rp</span>
                            <input type="number" name="denda" value="{{ old('denda', $pengembalian->denda ?? 0) }}" min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kondisi Mobil</label>
                        <input type="text" name="kondisi_mobil" value="{{ old('kondisi_mobil', $pengembalian->kondisi_mobil) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
>>>>>>> aqsha
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
<<<<<<< HEAD
                        <textarea name="catatan" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan', $pengembalian->catatan) }}</textarea>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Foto Kondisi</label>
                        @if($pengembalian->foto_kondisi)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$pengembalian->foto_kondisi) }}" alt="foto kondisi" class="w-32 h-24 object-cover rounded-lg border border-white/10">
                        </div>
                        @endif
                        <input type="file" name="foto_kondisi" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all">
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Denda telat dihitung otomatis saat penyimpanan. Denda kerusakan dapat disesuaikan.
=======
                        <textarea name="catatan" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan', $pengembalian->catatan) }}</textarea>
                    </div>
>>>>>>> aqsha
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

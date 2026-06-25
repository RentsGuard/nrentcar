@extends('layout')

@section('title', 'Tambah Mobil - RentSCar')

@section('page-title', 'Tambah Mobil')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/mobil" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Mobil</h1>
            <p class="text-white/50 text-sm mt-1">Input data kendaraan baru untuk armada.</p>
        </div>
    </div>

    <form action="/mobil" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Mobil</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Nama Mobil</label>
                        <input type="text" name="nama_mobil" value="{{ old('nama_mobil') }}" required placeholder="Contoh: Toyota Avanza" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Plat Nomor</label>
                        <input type="text" name="plat_mobil" value="{{ old('plat_mobil') }}" required placeholder="B 1234 XYZ" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tahun Mobil</label>
                        <input type="number" name="tahun_mobil" value="{{ old('tahun_mobil') }}" required min="2000" max="2030" placeholder="2024" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tipe Mobil</label>
                        <select name="tipe_mobil" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            @foreach(['Matic', 'Manual'] as $t)
                            <option value="{{ $t }}" {{ old('tipe_mobil') == $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Baris</label>
                        <input type="number" name="kapasitas_mobil" value="{{ old('kapasitas_mobil', 4) }}" required min="1" max="20" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Bahan Bakar</label>
                        <select name="bahan_bakar" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            @foreach(['Bensin', 'Solar', 'Listrik', 'Hybrid'] as $b)
                            <option value="{{ $b }}" {{ old('bahan_bakar') == $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Harga Sewa / Hari</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></span>
                            <input type="number" name="harga_mobil" value="{{ old('harga_mobil') }}" required min="0" placeholder="500000" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Status</label>
                        <select name="status_mobil" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="tersedia" {{ old('status_mobil') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="disewa" {{ old('status_mobil') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                            <option value="maintenance" {{ old('status_mobil') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                </div>

                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Foto Mobil</h3>
                </div>

                <div class="space-y-2">
                    <input type="file" name="foto_mobil" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all">
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

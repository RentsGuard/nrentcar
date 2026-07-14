@extends('layout')

@section('title', 'Edit Penyewaan - RentSCar')

@section('page-title', 'Edit Penyewaan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/penyewaan" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Penyewaan</h1>
            <p class="text-white/50 text-sm mt-1">Perbarui data transaksi penyewaan.</p>
        </div>
    </div>

    <form action="/penyewaan/{{ $penyewaan->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="{{ old('tanggal_sewa', $penyewaan->tanggal_sewa?->format('Y-m-d')) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_sewa') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Jam Sewa</label>
                        <input type="time" name="jam_sewa" id="jam_sewa" value="{{ old('jam_sewa', $penyewaan->jam_sewa ? \Carbon\Carbon::parse($penyewaan->jam_sewa)->format('H:i') : '08:00') }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('jam_sewa') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $penyewaan->tanggal_kembali?->format('Y-m-d')) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_kembali') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Jam Kembali</label>
                        <input type="time" name="jam_kembali" id="jam_kembali" value="{{ old('jam_kembali', $penyewaan->jam_kembali ? \Carbon\Carbon::parse($penyewaan->jam_kembali)->format('H:i') : '17:00') }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('jam_kembali') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Lama Sewa (Hari)</label>
                        <div class="h-10 flex items-center text-white/80 text-sm" id="lama_sewa_display">{{ $penyewaan->lama_sewa }} hari</div>
                        <input type="hidden" name="lama_sewa" id="lama_sewa" value="{{ old('lama_sewa', $penyewaan->lama_sewa) }}">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Total Harga</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm">Rp</span>
                            <input type="number" name="total_harga" value="{{ old('total_harga', $penyewaan->total_harga) }}" required min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                        @error('total_harga') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda / Hari</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm">Rp</span>
                            <input type="number" name="denda_per_jam" value="{{ old('denda_per_jam', $penyewaan->denda_per_jam ?? 350000) }}" required min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                        @error('denda_per_jam') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
                        <textarea name="catatan" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan', $penyewaan->catatan) }}</textarea>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Lama sewa & total denda telat dihitung otomatis.
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

@push('scripts')
<script>
function calcLamaSewa() {
    const tglSewa = document.getElementById('tanggal_sewa').value;
    const jamSewa = document.getElementById('jam_sewa').value || '08:00';
    const tglKembali = document.getElementById('tanggal_kembali').value;
    const jamKembali = document.getElementById('jam_kembali').value || '17:00';
    const display = document.getElementById('lama_sewa_display');
    const hidden = document.getElementById('lama_sewa');
    if (!tglSewa || !tglKembali) { return; }
    const mulai = new Date(tglSewa + 'T' + jamSewa);
    const selesai = new Date(tglKembali + 'T' + jamKembali);
    if (selesai <= mulai) { display.textContent = '0 (cek tanggal)'; hidden.value = 1; return; }
    const diffMs = selesai - mulai;
    const diffJam = diffMs / (1000 * 60 * 60);
    const hari = Math.ceil(diffJam / 24);
    display.textContent = hari + ' hari';
    hidden.value = hari;
}
document.getElementById('tanggal_sewa').addEventListener('change', calcLamaSewa);
document.getElementById('jam_sewa').addEventListener('change', calcLamaSewa);
document.getElementById('tanggal_kembali').addEventListener('change', calcLamaSewa);
document.getElementById('jam_kembali').addEventListener('change', calcLamaSewa);
</script>
@endpush

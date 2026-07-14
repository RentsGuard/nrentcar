@extends('layout')

@section('title', 'Catat Pengembalian - RentSCar')

@section('page-title', 'Catat Pengembalian')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengembalian" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Catat Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">Catat pengembalian mobil dari penyewaan aktif.</p>
        </div>
    </div>

    <form action="/pengembalian" method="POST">
        @csrf
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Pengembalian</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Penyewaan Aktif</label>
                        <select name="penyewaan_id" id="penyewaanSelect" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih Penyewaan --</option>
                            @foreach($penyewaans as $s)
                            <option value="{{ $s->id }}" data-tgl-kembali="{{ $s->tanggal_kembali?->format('Y-m-d') }}" data-jam-kembali="{{ $s->jam_kembali ?? '17:00' }}" data-denda-per-jam="{{ $s->denda_per_jam ?? 0 }}" {{ old('penyewaan_id') == $s->id ? 'selected' : '' }}>
                                RNT-{{ str_pad($s->id, 3, '0', STR_PAD_LEFT) }} - {{ $s->customer->nama_customer ?? '-' }} ({{ $s->mobil->nama_mobil ?? '-' }})
                            </option>
                            @endforeach
                        </select>
                        @error('penyewaan_id') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                        <div id="expectedReturn" class="hidden text-xs text-white/50 mt-2 p-2 rounded-lg bg-white/[0.03] border border-white/[0.05]">
                            <span class="text-white/70">Jatuh tempo:</span>
                            <span id="expectedReturnText" class="text-white font-medium"></span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal & Jam Pengembalian</label>
                        <input type="datetime-local" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', now()->format('Y-m-d\TH:i')) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_pengembalian') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Kerusakan (Rp)</label>
                        <input type="number" name="denda_kerusakan" value="{{ old('denda_kerusakan', 0) }}" min="0" placeholder="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('denda_kerusakan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kondisi Mobil</label>
                        <input type="text" name="kondisi_mobil" value="{{ old('kondisi_mobil') }}" placeholder="Baik, LECET, dll" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('kondisi_mobil') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
                        <textarea name="catatan" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan') }}</textarea>
                        @error('catatan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Denda telat dihitung otomatis per hari jika melewati tanggal kembali yang dijadwalkan. Denda kerusakan diisi manual jika ada.
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
document.getElementById('penyewaanSelect').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    const box = document.getElementById('expectedReturn');
    const text = document.getElementById('expectedReturnText');
    if (opt && opt.value) {
        const tgl = opt.dataset.tglKembali;
        const jam = opt.dataset.jamKembali;
        text.textContent = tgl + ' ' + jam;
        box.classList.remove('hidden');
    } else {
        box.classList.add('hidden');
    }
});
</script>
@endpush

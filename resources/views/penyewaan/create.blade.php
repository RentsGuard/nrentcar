@extends('layout')

@section('title', 'Sewa Baru - RentSCar')

@section('page-title', 'Sewa Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/penyewaan" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Sewa Baru</h1>
            <p class="text-white/50 text-sm mt-1">Input transaksi penyewaan mobil baru.</p>
        </div>
    </div>

    <form action="/penyewaan" method="POST">
        @csrf
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Data Penyewaan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Customer</label>
                            <select name="customer_id" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $c)
                                <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->nama_customer }} - {{ $c->nik }}</option>
                                @endforeach
                            </select>
                            @error('customer_id') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Mobil</label>
                            <select name="mobil_id" id="mobilSelect" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                                <option value="">-- Pilih Mobil --</option>
                                @foreach($mobils as $m)
                                <option value="{{ $m->id }}" data-harga-mobil="{{ $m->harga_mobil }}" {{ old('mobil_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_mobil }} - {{ $m->plat_mobil }} (Rp{{ number_format($m->harga_mobil, 0, ',', '.') }}/hari)</option>
                                @endforeach
                            </select>
                            @error('mobil_id') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="{{ old('tanggal_sewa') }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_sewa') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Jam Sewa</label>
                        <input type="time" name="jam_sewa" id="jam_sewa" value="{{ old('jam_sewa', '08:00') }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('jam_sewa') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('tanggal_kembali') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Jam Kembali</label>
                        <input type="time" name="jam_kembali" id="jam_kembali" value="{{ old('jam_kembali', '17:00') }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        @error('jam_kembali') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Lama Sewa (Hari)</label>
                        <div class="h-10 flex items-center text-white/80 text-sm" id="lama_sewa_display">-</div>
                        <input type="hidden" name="lama_sewa" id="lama_sewa" value="{{ old('lama_sewa', 1) }}">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Total Harga <span class="text-white/40 font-normal">(otomatis)</span></label>
                        <div class="h-10 flex items-center px-3 rounded-lg border border-white/[0.06] bg-white/[0.02] text-white font-semibold text-sm" id="total_harga_display">Rp 0</div>
                        <p class="text-[11px] text-white/30">Lama sewa &times; harga sewa/hari mobil terpilih.</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda / Hari</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm">Rp</span>
                            <input type="number" name="denda_per_jam" value="{{ old('denda_per_jam', 350000) }}" required min="0" placeholder="350000" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Catatan</label>
                        <textarea name="catatan" rows="2" placeholder="Opsional" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-amber-500/5 border border-amber-500/10 text-amber-400 text-xs">
                    <i class="bi bi-info-circle"></i> Lama sewa & total harga dihitung otomatis dari tanggal/jam dan harga sewa mobil. Total denda telat dihitung otomatis saat pengembalian. Denda per hari disesuaikan dengan harga mobil.
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
function formatRupiah(num) {
    return 'Rp ' + Math.round(num).toLocaleString('id-ID');
}

function calcLamaSewa() {
    const tglSewa = document.getElementById('tanggal_sewa').value;
    const jamSewa = document.getElementById('jam_sewa').value || '08:00';
    const tglKembali = document.getElementById('tanggal_kembali').value;
    const jamKembali = document.getElementById('jam_kembali').value || '17:00';
    const display = document.getElementById('lama_sewa_display');
    const hidden = document.getElementById('lama_sewa');

    let hari = 1;
    if (!tglSewa || !tglKembali) {
        display.textContent = '-';
        hidden.value = 1;
    } else {
        const mulai = new Date(tglSewa + 'T' + jamSewa);
        const selesai = new Date(tglKembali + 'T' + jamKembali);
        if (selesai <= mulai) {
            display.textContent = '0 (cek tanggal)';
            hidden.value = 1;
            hari = 0;
        } else {
            const diffMs = selesai - mulai;
            const diffJam = diffMs / (1000 * 60 * 60);
            hari = Math.ceil(diffJam / 24);
            display.textContent = hari + ' hari';
            hidden.value = hari;
        }
    }

    calcTotalHarga(hari);
}

function calcTotalHarga(lamaSewa) {
    const select = document.getElementById('mobilSelect');
    const opt = select.options[select.selectedIndex];
    const totalDisplay = document.getElementById('total_harga_display');

    const hargaPerHari = (opt && opt.value) ? parseFloat(opt.dataset.hargaMobil) || 0 : 0;
    const totalHarga = lamaSewa * hargaPerHari;

    totalDisplay.textContent = formatRupiah(totalHarga);
}

document.getElementById('tanggal_sewa').addEventListener('change', calcLamaSewa);
document.getElementById('jam_sewa').addEventListener('change', calcLamaSewa);
document.getElementById('tanggal_kembali').addEventListener('change', calcLamaSewa);
document.getElementById('jam_kembali').addEventListener('change', calcLamaSewa);
document.getElementById('mobilSelect').addEventListener('change', calcLamaSewa);

calcLamaSewa();
</script>
@endpush
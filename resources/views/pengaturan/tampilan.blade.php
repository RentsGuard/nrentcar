@extends('layout')

@section('title', 'Tampilan - RentSCar')

@section('page-title', 'Tampilan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/pengaturan" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Tampilan</h1>
            <p class="text-white/50 text-sm mt-1">Sesuaikan tema dan preferensi sistem.</p>
        </div>
    </div>

    <form action="/pengaturan/tampilan" method="POST">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Aplikasi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Nama Aplikasi</label>
                        <input type="text" name="app_name" value="{{ old('app_name', $appName) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Warna Aksent</label>
                        <div class="flex gap-3">
                            <input type="color" name="app_accent_color" value="{{ old('app_accent_color', $accentColor) }}" class="w-12 h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] cursor-pointer">
                            <input type="text" name="app_accent_color_hex" value="{{ old('app_accent_color', $accentColor) }}" class="flex-1 h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] font-mono" readonly>
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Deskripsi Aplikasi</label>
                        <textarea name="app_description" rows="2" class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">{{ old('app_description', $appDesc) }}</textarea>
                    </div>
                </div>

                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Biaya & Denda</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Denda Keterlambatan / Hari</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm">Rp</span>
                            <input type="number" name="rental_denda_per_hari" value="{{ old('rental_denda_per_hari', $dendaPerHari) }}" required min="0" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white pl-10 pr-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        </div>
                    </div>
                </div>

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

@push('scripts')
<script>
document.querySelector('input[type=color]').addEventListener('input', function() {
    document.querySelector('input[name=app_accent_color_hex]').value = this.value;
});
</script>
@endpush

@extends('layout')

@section('title', 'Laporan Akhir - RentSCar')

@section('page-title', 'Laporan Akhir')

@section('content')
<div class="space-y-6">
    @include('laporan.tabs')

    <div class="glass-card overflow-visible">
        <div class="p-5 border-b border-white/[0.05] bg-white/[0.015]">
            <form method="GET" action="/laporan/akhir">
                <div class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="text-xs text-white/50 block mb-1.5">Cari</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari customer, mobil, plat..."
                                class="w-full px-3 py-2.5 pl-10 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors">
                            <i class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-white/50 block mb-1.5">Periode</label>
                        <select name="filter_date" id="filter_date" onchange="toggleFilter()"
                            class="w-full sm:w-40 px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm appearance-none focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors"
                            style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2214%22 height=%2214%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">Semua</option>
                            <option value="hari" {{ request('filter_date') === 'hari' ? 'selected' : '' }}>Per Hari</option>
                            <option value="minggu" {{ request('filter_date') === 'minggu' ? 'selected' : '' }}>Per Minggu</option>
                            <option value="bulan" {{ request('filter_date') === 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                            <option value="tahun" {{ request('filter_date') === 'tahun' ? 'selected' : '' }}>Per Tahun</option>
                            <option value="rentang" {{ request('filter_date') === 'rentang' ? 'selected' : '' }}>Rentang</option>
                        </select>
                    </div>

                    <div id="single_group">
                        <label class="text-xs text-white/50 block mb-1.5" id="single_label">Tanggal</label>
                        <input type="date" name="filter_value" id="filter_value" value="{{ request('filter_value') }}"
                            class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors [color-scheme:dark]">
                    </div>

                    <div id="rentang_group" class="{{ request('filter_date') === 'rentang' ? '' : 'hidden' }}">
                        <div class="flex flex-wrap gap-2 items-end">
                            <div>
                                <label class="text-xs text-white/50 block mb-1.5">Dari</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                    class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors [color-scheme:dark]">
                            </div>
                            <div>
                                <label class="text-xs text-white/50 block mb-1.5">Sampai</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors [color-scheme:dark]">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs text-white/50 block mb-1.5 invisible select-none"></label>
                        <button type="submit"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#C1121F] text-white hover:bg-[#a30f1a] transition-colors shadow-[0_4px_15px_rgba(193,18,31,0.3)]">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>

                    @if(request('filter_date'))
                    <div>
                        <label class="text-xs text-white/50 block mb-1.5 invisible select-none"></label>
                        <a href="/laporan/akhir"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-white/[0.08] text-white/60 hover:text-white hover:bg-white/[0.05] transition-all no-underline">
                            <i class="bi bi-x-lg text-xs"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs text-white/50 uppercase tracking-wider border-b border-white/[0.05]">
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">ID</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Customer</th>                
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Mobil</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">No. HP</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Plat</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Tgl Sewa</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Tgl Kembali</th>
                        <th class="px-5 py-3.5 font-semibold text-right whitespace-nowrap">Lama</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Total Harga</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Status</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Keterangan</th>
                    </tr>
                 </thead>

        <tbody class="divide-y divide-white/[0.04]">
            @forelse($penyewaans as $p)
            <tr class="hover:bg-white/[0.02] transition-colors even:bg-white/[0.015]">

                {{-- ID --}}
                <td class="px-5 py-3.5 whitespace-nowrap text-white font-medium">
                    RNT-{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}
                </td>

                {{-- Customer --}}
                <td class="px-5 py-3.5 whitespace-nowrap">
                    <div class="text-white font-medium">
                        {{ $p->customer->nama_customer ?? '-' }}
                    </div>
                </td>

                {{-- Mobil --}}
                <td class="px-5 py-3.5 whitespace-nowrap">
                    <div class="text-white font-medium">
                        {{ $p->mobil->nama_mobil ?? '-' }}
                    </div>
                </td>

                {{-- No HP --}}
                <td class="px-5 py-3.5 whitespace-nowrap text-white/70">
                    {{ $p->customer->no_hp ?? '-' }}
                </td>

                {{-- Plat --}}
                <td class="px-5 py-3.5 whitespace-nowrap text-white/70 font-mono">
                    {{ $p->mobil->plat_mobil ?? '-' }}
                </td>

                {{-- Tanggal Sewa --}}
                <td class="px-5 py-3.5 whitespace-nowrap text-white/80">
                    {{ $p->tanggal_sewa?->format('d/m/Y') ?? '-' }}
                </td>

                {{-- Tanggal Kembali --}}
                <td class="px-5 py-3.5 whitespace-nowrap text-white/80">
                    {{ $p->tanggal_kembali?->format('d/m/Y') ?? '-' }}
                </td>

                {{-- Lama --}}
                <td class="px-5 py-3.5 text-center whitespace-nowrap text-white">
                    {{ $p->lama_sewa }} Hari
                </td>

                {{-- Total Harga --}}
                <td class="px-5 py-3.5 text-right whitespace-nowrap font-semibold text-[#C1121F]">
                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                </td>

                {{-- Status --}}
                <td class="px-5 py-3.5 text-center">
                    @if($p->status === 'selesai')
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-400 text-xs font-semibold">
                            Selesai
                        </span>
                    @elseif($p->status === 'aktif')
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-amber-500/15 text-amber-400 text-xs font-semibold">
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-500/15 text-red-400 text-xs font-semibold">
                            Dibatalkan
                        </span>
                    @endif
                </td>

                {{-- Keterangan --}}
                <td class="px-5 py-3.5 text-white/60 text-xs">
                    {{ $p->pengembalian->catatan ?? $p->catatan ?? '-' }}
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="11" class="px-5 py-16 text-center">
                    <div class="flex flex-col items-center gap-3 text-white/40">
                        <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center">
                            <i class="bi bi-inbox text-2xl"></i>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-white/60">
                                Tidak ada data penyewaan
                            </p>
                            <p class="text-xs text-white/40 mt-1">
                                Belum ada transaksi pada periode ini.
                            </p>
                        </div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

        @if($penyewaans->isNotEmpty())
        <div class="px-5 py-3.5 border-t border-white/[0.05] bg-white/[0.015] flex flex-wrap items-center justify-between gap-3 text-sm">
            <span class="text-white/50">{{ $penyewaans->count() }} data</span>
            @if(request('filter_date'))
            <span class="text-white/50">Periode: <strong class="text-white font-semibold">{{ $label ?? '—' }}</strong></span>
            @endif
            <div class="flex gap-3">
                <a href="/laporan/akhir/cetak?{{ http_build_query(request()->query()) }}" target="_blank"
                    class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-[#C1121F] text-white text-sm font-semibold hover:bg-[#a30f1a] transition-all no-underline shadow-[0_4px_15px_rgba(193,18,31,0.3)]">
                    <i class="bi bi-printer text-xs"></i> Cetak
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function getWeekStr(d) {
    var dt = new Date(d.getTime());
    var day = dt.getDay() || 7;
    dt.setDate(dt.getDate() + 4 - day);
    var y = dt.getFullYear();
    var start = new Date(y, 0, 1);
    var n = Math.ceil((((dt - start) / 86400000) + start.getDay() + 1) / 7);
    return y + '-W' + String(n).padStart(2, '0');
}

function toggleFilter() {
    var v = document.getElementById('filter_date').value;
    var fv = document.getElementById('filter_value');
    var label = document.getElementById('single_label');
    var single = document.getElementById('single_group');
    var rentang = document.getElementById('rentang_group');
    var now = new Date();

    single.classList.remove('hidden');
    rentang.classList.add('hidden');

    if (v === '' || v === 'hari') {
        fv.type = 'date';
        label.textContent = 'Tanggal';
        if (!fv.value) fv.value = now.toISOString().slice(0,10);
    } else if (v === 'minggu') {
        fv.type = 'week';
        label.textContent = 'Minggu ke-';
        if (!fv.value) fv.value = getWeekStr(now);
    } else if (v === 'bulan') {
        fv.type = 'month';
        label.textContent = 'Bulan';
        if (!fv.value) fv.value = now.toISOString().slice(0,7);
    } else if (v === 'tahun') {
        fv.type = 'number';
        label.textContent = 'Tahun';
        fv.placeholder = now.getFullYear();
        if (!fv.value) fv.value = now.getFullYear().toString();
    } else if (v === 'rentang') {
        single.classList.add('hidden');
        rentang.classList.remove('hidden');
        if (!document.getElementById('start_date').value)
            document.getElementById('start_date').value = now.toISOString().slice(0,10);
        if (!document.getElementById('end_date').value)
            document.getElementById('end_date').value = now.toISOString().slice(0,10);
    }
}
toggleFilter();
</script>
@endpush

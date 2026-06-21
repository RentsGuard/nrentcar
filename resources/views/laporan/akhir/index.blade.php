@extends('layout')

@section('title', 'Laporan Akhir - RentSCar')

@section('page-title', 'Laporan Akhir')

@section('content')
<div class="space-y-6">
    @include('laporan.tabs')

    <div class="glass-card overflow-hidden">
        <div class="p-5 border-b border-white/[0.05] bg-white/[0.015]">
            <form method="GET" action="/laporan/akhir">
                <div class="flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="text-xs text-white/50 block mb-1.5">Periode</label>
                        <select name="filter_date" id="filter_date" onchange="toggleFilter()"
                            class="w-full sm:w-40 px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm appearance-none focus:border-[#C1121F]/50 focus:outline-none transition-colors"
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
                            class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors [color-scheme:dark]">
                    </div>

                    <div id="rentang_group" class="{{ request('filter_date') === 'rentang' ? '' : 'hidden' }}">
                        <div class="flex flex-wrap gap-2 items-end">
                            <div>
                                <label class="text-xs text-white/50 block mb-1.5">Dari</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                    class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors [color-scheme:dark]">
                            </div>
                            <div>
                                <label class="text-xs text-white/50 block mb-1.5">Sampai</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="w-full sm:w-44 px-3 py-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:border-[#C1121F]/50 focus:outline-none transition-colors [color-scheme:dark]">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs text-white/50 block mb-1.5 invisible select-none">_</label>
                        <button type="submit"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#C1121F] text-white hover:bg-[#a30f1a] transition-colors shadow-[0_4px_15px_rgba(193,18,31,0.3)]">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>

                    @if(request('filter_date'))
                    <div>
                        <label class="text-xs text-white/50 block mb-1.5 invisible select-none">_</label>
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
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">User</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Unit</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Tanggal</th>
                        <th class="px-5 py-3.5 font-semibold text-right whitespace-nowrap">Hari</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Trouble</th>
                        <th class="px-5 py-3.5 font-semibold text-center whitespace-nowrap">Ket</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($penyewaans as $p)
                    <tr class="hover:bg-white/[0.02] transition-colors even:bg-white/[0.015]">
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="text-white font-medium">{{ $p->customer->nama_customer ?? '-' }}</div>
                            <div class="text-[11px] text-white/40 mt-0.5">{{ $p->customer->no_hp ?? '-' }}</div>
                        </td>
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="text-white font-medium">{{ $p->mobil->nama_mobil ?? '-' }}</div>
                            <div class="text-[11px] text-white/40 mt-0.5 font-mono">{{ $p->mobil->plat_mobil ?? '-' }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-white/80 font-medium whitespace-nowrap">{{ $p->tanggal_sewa?->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5 text-white/80 text-right font-medium whitespace-nowrap">{{ $p->lama_sewa }}<span class="text-white/30 text-[11px] ml-0.5">hr</span></td>
                        <td class="px-5 py-3.5 text-white/60 text-xs max-w-[240px] break-words">{{ $p->pengembalian?->catatan ?? $p->catatan ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-center">
                            @if($p->status === 'selesai')
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-emerald-500/15 text-emerald-400"><i class="bi bi-check-lg"></i></span>
                            @elseif($p->status === 'aktif')
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-amber-500/15 text-amber-400" title="Aktif"><i class="bi bi-arrow-right"></i></span>
                            @else
                            <span class="text-white/20 text-lg">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-white/40">
                                <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center">
                                    <i class="bi bi-inbox text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white/60">Tidak ada data penyewaan</p>
                                    <p class="text-xs text-white/40 mt-1">Belum ada transaksi pada periode ini.</p>
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
function toggleFilter() {
    var v = document.getElementById('filter_date').value;
    var fv = document.getElementById('filter_value');
    var label = document.getElementById('single_label');
    var single = document.getElementById('single_group');
    var rentang = document.getElementById('rentang_group');

    single.classList.remove('hidden');
    rentang.classList.add('hidden');

    if (v === '' || v === 'hari') {
        fv.type = 'date';
        label.textContent = 'Tanggal';
    } else if (v === 'minggu') {
        fv.type = 'date';
        label.textContent = 'Minggu';
    } else if (v === 'bulan') {
        fv.type = 'month';
        label.textContent = 'Bulan';
    } else if (v === 'tahun') {
        fv.type = 'number';
        label.textContent = 'Tahun';
        fv.placeholder = '2026';
    } else if (v === 'rentang') {
        single.classList.add('hidden');
        rentang.classList.remove('hidden');
    }
}
toggleFilter();
</script>
@endpush

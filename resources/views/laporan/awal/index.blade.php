@extends('layout')

@section('title', 'Laporan Awal - RentSCar')

@section('page-title', 'Laporan Awal')

@section('content')
<div class="space-y-6">
    @include('laporan.tabs')

    <div class="glass-card overflow-hidden">
        <div class="p-5 border-b border-white/[0.05] bg-white/[0.015]">
            <form method="GET" action="/laporan/awal">
                <div class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="text-xs text-white/50 block mb-1.5">Pilih Customer</label>
                        <select name="customer_id" onchange="this.form.submit()"
                            class="w-full px-3 py-2.5 rounded-xl bg-[#0D0D0D] border border-white/[0.1] text-white text-sm appearance-none focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] focus:outline-none transition-colors"
                            style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2214%22 height=%2214%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">— Semua Customer —</option>
                            @foreach($customers as $c)
                            <option value="{{ $c->id }}" {{ request('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->nama_customer }} ({{ $c->penyewaan_count }} sewa)</option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('customer_id'))
                    <div>
                        <label class="text-xs text-white/50 block mb-1.5 invisible select-none">_</label>
                        <a href="/laporan/awal"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-white/[0.08] text-white/60 hover:text-white hover:bg-white/[0.05] transition-all no-underline">
                            <i class="bi bi-x-lg text-xs"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </form>
        </div>

        @if($selectedCustomer)
        <div class="px-5 py-4 border-b border-white/[0.05] bg-white/[0.02]">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div class="min-w-0">
                    <h3 class="text-base font-semibold text-white tracking-tight">{{ $selectedCustomer->nama_customer }}</h3>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-white/50 mt-1">
                        <span class="font-mono text-xs">{{ $selectedCustomer->nik }}</span>
                        <span class="text-white/20 hidden sm:inline">&middot;</span>
                        <span>{{ $selectedCustomer->no_hp }}</span>
                        <span class="text-white/20 hidden sm:inline">&middot;</span>
                        <span class="text-white/40 max-w-[200px] xl:max-w-[260px] truncate" title="{{ $selectedCustomer->alamat_customer }}">{{ $selectedCustomer->alamat_customer }}</span>
                    </div>
                </div>
                <div class="shrink-0 text-sm text-white/60 bg-white/[0.04] px-3.5 py-1.5 rounded-lg border border-white/[0.06] whitespace-nowrap">
                    <span class="font-semibold text-white">{{ $penyewaans->count() }}</span> transaksi
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs text-white/50 uppercase tracking-wider border-b border-white/[0.05]">
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">ID</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Mobil</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Plat</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Tgl Sewa</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Tgl Kembali</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Lama</th>
                        <th class="px-5 py-3.5 font-semibold text-right whitespace-nowrap">Total</th>
                        <th class="px-5 py-3.5 font-semibold whitespace-nowrap">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-right whitespace-nowrap">Cetak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($penyewaans as $p)
                    <tr class="hover:bg-white/[0.02] transition-colors even:bg-white/[0.015]">
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <span class="font-mono text-xs text-white/70 font-medium">RNT-{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-white font-medium whitespace-nowrap">{{ $p->mobil->nama_mobil ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-white/60 font-mono text-xs whitespace-nowrap">{{ $p->mobil->plat_mobil ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-white/80 whitespace-nowrap">{{ $p->tanggal_sewa?->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5 text-white/80 whitespace-nowrap">{{ $p->tanggal_kembali?->format('d/m/Y') }}</td>
                        <td class="px-5 py-3.5 text-white/80 whitespace-nowrap">{{ $p->lama_sewa }}<span class="text-white/30 text-[11px] ml-0.5">hr</span></td>
                        <td class="px-5 py-3.5 text-white font-semibold text-right whitespace-nowrap">Rp{{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            @php
                            $sc = match($p->status) {
                                'aktif' => 'bg-amber-500/12 text-amber-300 border-amber-500/20',
                                'selesai' => 'bg-emerald-500/12 text-emerald-300 border-emerald-500/20',
                                'dibatalkan' => 'bg-red-500/12 text-red-300 border-red-500/20',
                                default => 'bg-white/[0.06] text-white/60 border-white/[0.1]'
                            };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $sc }}">{{ ucfirst($p->status) }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right whitespace-nowrap">
                            <a href="/laporan/awal/cetak/{{ $p->id }}" target="_blank"
                                class="inline-flex items-center gap-1.5 h-8 px-3.5 rounded-lg bg-[#C1121F] text-white text-[11px] font-bold uppercase tracking-wider hover:bg-[#a30f1a] transition-all no-underline shadow-[0_0_16px_-4px_rgba(193,18,31,0.5)]">
                                <i class="bi bi-printer text-xs"></i> Cetak
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-white/40">
                                <div class="w-14 h-14 rounded-2xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center">
                                    <i class="bi bi-inbox text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white/60">Tidak ada data penyewaan</p>
                                    <p class="text-xs text-white/40 mt-1">Customer ini belum memiliki transaksi.</p>
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
            <span class="text-white/50">{{ $penyewaans->count() }} transaksi</span>
            <span class="text-white/50 shrink min-w-0">
                Total: <strong class="text-white font-semibold truncate max-w-[180px] sm:max-w-none inline-block align-bottom">Rp{{ number_format($penyewaans->sum('total_harga'), 0, ',', '.') }}</strong>
            </span>
        </div>
        @endif

        @else
        <div class="py-20 text-center">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-white/[0.04] border border-white/[0.06] flex items-center justify-center mb-5">
                <i class="bi bi-file-earmark-text text-3xl text-white/30"></i>
            </div>
            <h3 class="text-base font-semibold text-white/80 mb-1.5">Pilih Customer</h3>
            <p class="text-sm text-white/40 max-w-xs mx-auto leading-relaxed">Pilih customer untuk melihat dan mencetak Tanda Terima penyewaan.</p>
        </div>
        @endif
    </div>
</div>
@endsection

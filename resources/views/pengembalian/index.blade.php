@extends('layout')

@section('title', 'Pengembalian - RentSCar')

@section('page-title', 'Pengembalian')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">Catat pengembalian mobil dari penyewaan aktif.</p>
        </div>
        <a href="/pengembalian/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Catat Pengembalian
        </a>
    </div>

    <div class="glass-card">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <form method="GET" action="/pengembalian" class="flex flex-wrap items-end gap-3">
                <div class="relative w-full sm:w-60">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari customer atau mobil...">
                </div>
                <div class="w-full sm:w-44">
                    <select name="status" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua Status</option>
                        <option value="tepat_waktu" {{ request('status') === 'tepat_waktu' ? 'selected' : '' }}>Tepat Waktu</option>
                        <option value="telat" {{ request('status') === 'telat' ? 'selected' : '' }}>Telat</option>
                        <option value="rusak" {{ request('status') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="telat_dan_rusak" {{ request('status') === 'telat_dan_rusak' ? 'selected' : '' }}>Telat & Rusak</option>
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-xs hover:bg-[#a30f1a] transition-all">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                <a href="/pengembalian" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg border border-white/[0.1] text-white/70 hover:text-white hover:bg-white/[0.05] transition-all no-underline text-xs">
                    <i class="bi bi-x-lg"></i> Reset
                </a>
                @endif
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">ID Sewa</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Mobil</th>
                        <th class="px-6 py-4 font-medium">Tgl Dikembalikan</th>
                        <th class="px-6 py-4 font-medium">Total Denda</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($pengembalians as $p)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-medium text-white">{{ 'RNT-'.str_pad($p->penyewaan_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $p->penyewaan?->customer?->nama_customer ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $p->penyewaan?->mobil?->nama_mobil ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $p->tanggal_pengembalian ? $p->tanggal_pengembalian->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if($p->total_denda > 0)
                            <span class="text-red-400 font-medium">Rp {{ number_format($p->total_denda, 0, ',', '.') }}</span>
                            @if($p->status_denda === 'lunas')
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-medium border bg-emerald-500/10 text-emerald-400 border-emerald-500/20 ml-1">Lunas</span>
                            @else
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-medium border bg-amber-500/10 text-amber-400 border-amber-500/20 ml-1">Belum</span>
                            @endif
                            @else
                            <span class="text-emerald-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $sc = match($p->status_pengembalian) {
                                'tepat_waktu' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                'telat' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                'rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                'telat_dan_rusak' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                default => 'bg-white/[0.1] text-white/80'
                            };
                            $sl = match($p->status_pengembalian) {
                                'tepat_waktu' => 'Tepat Waktu',
                                'telat' => 'Telat',
                                'rusak' => 'Rusak',
                                'telat_dan_rusak' => 'Telat & Rusak',
                                default => $p->status_pengembalian
                            };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/pengembalian/{{ $p->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-white/[0.06] text-white/60 hover:text-white hover:bg-white/[0.06] transition-all no-underline" title="Detail">
                                    <i class="bi bi-eye text-sm"></i>
                                </a>
                                <a href="/pengembalian/{{ $p->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg border border-white/[0.06] text-white/60 hover:text-white hover:bg-white/[0.06] transition-all no-underline" title="Edit">
                                    <i class="bi bi-pencil text-sm"></i>
                                </a>
                                <form action="/pengembalian/{{ $p->id }}" method="POST" onsubmit="return confirm('Hapus data pengembalian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg border border-white/[0.06] text-red-400/60 hover:text-red-400 hover:bg-red-500/10 transition-all" title="Hapus">
                                        <i class="bi bi-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-white/40">
                            <i class="bi bi-arrow-return-left text-3xl block mb-3"></i>
                            <p class="text-sm">Belum ada data pengembalian.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

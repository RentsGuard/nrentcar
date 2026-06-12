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
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">ID Sewa</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Mobil</th>
                        <th class="px-6 py-4 font-medium">Tgl Kembali</th>
                        <th class="px-6 py-4 font-medium">Denda</th>
                        <th class="px-6 py-4 font-medium">Kondisi</th>
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
                        <td class="px-6 py-4 text-white/80">Rp {{ number_format($p->denda ?? 0, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="text-white/80">{{ $p->kondisi_mobil ?? '-' }}</span>
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

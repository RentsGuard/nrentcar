@extends('layout')

@section('title', 'Pengembalian - RentSCar')

@section('page-title', 'Pengembalian')

@section('content')
<div class="space-y-6">
<<<<<<< HEAD
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Pengembalian</h1>
            <p class="text-white/50 text-sm mt-1">Kelola pengembalian mobil dan denda.</p>
        </div>
        <a href="/pengembalian/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Pengembalian Baru
        </a>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <div class="relative w-full sm:w-72">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                <input type="text" id="searchInput" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari pengembalian...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="pengembalianTable">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">Sewa ID</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Mobil</th>
                        <th class="px-6 py-4 font-medium">Tgl Kembali Real</th>
                        <th class="px-6 py-4 font-medium">Denda</th>
                        <th class="px-6 py-4 font-medium">Status</th>
=======
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
>>>>>>> aqsha
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($pengembalians as $p)
                    <tr class="hover:bg-white/[0.02] transition-colors">
<<<<<<< HEAD
                        <td class="px-6 py-4 font-mono text-xs text-white/70">RNT-{{ str_pad($p->penyewaan_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs shrink-0">{{ strtoupper(substr($p->penyewaan->customer->nama_customer ?? '?', 0, 1)) }}</div>
                                <span class="font-medium text-white">{{ $p->penyewaan->customer->nama_customer ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-white/80">{{ $p->penyewaan->mobil->nama_mobil ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $p->tanggal_kembali_real ? $p->tanggal_kembali_real->format('d/m/Y H:i') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if($p->total_denda > 0)
                            <span class="text-red-400 font-medium">Rp {{ number_format($p->total_denda, 0, ',', '.') }}</span>
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
                                <a href="/pengembalian/{{ $p->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/pengembalian/{{ $p->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
=======
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
>>>>>>> aqsha
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
<<<<<<< HEAD
                        <td colspan="7" class="px-6 py-8 text-center text-white/50">Belum ada data pengembalian.</td>
=======
                        <td colspan="7" class="px-6 py-12 text-center text-white/40">
                            <i class="bi bi-arrow-return-left text-3xl block mb-3"></i>
                            <p class="text-sm">Belum ada data pengembalian.</p>
                        </td>
>>>>>>> aqsha
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
<<<<<<< HEAD

        <div class="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
            <div>Menampilkan {{ count($pengembalians) }} data</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('#pengembalianTable tbody tr').forEach(function(r) {
        r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endpush
=======
    </div>
</div>
@endsection
>>>>>>> aqsha

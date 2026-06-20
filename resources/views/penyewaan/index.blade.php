@extends('layout')

@section('title', 'Data Penyewaan - RentSCar')

@section('page-title', 'Penyewaan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Data Penyewaan</h1>
            <p class="text-white/50 text-sm mt-1">Kelola transaksi penyewaan mobil.</p>
        </div>
        <a href="/penyewaan/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Sewa Baru
        </a>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <div class="relative w-full sm:w-72">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                <input type="text" id="searchInput" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari penyewaan...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="penyewaanTable">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">ID</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Mobil</th>
                        <th class="px-6 py-4 font-medium">Tanggal Sewa</th>
                        <th class="px-6 py-4 font-medium">Tanggal Kembali</th>
                        <th class="px-6 py-4 font-medium">Total</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($penyewaans as $sewa)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-white/70">RNT-{{ str_pad($sewa->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-white/80">{{ $sewa->customer->nama_customer ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded bg-white/[0.05] flex items-center justify-center">
                                    <i class="bi bi-car-front text-xs text-white/60"></i>
                                </div>
                                <span class="text-white/80">{{ $sewa->mobil->nama_mobil ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-white/60">{{ $sewa->tanggal_sewa ? $sewa->tanggal_sewa->format('d/m/Y') : '-' }}<br><span class="text-[11px] text-white/40">{{ $sewa->jam_sewa ?? '' }}</span></td>
                        <td class="px-6 py-4 text-white/60">{{ $sewa->tanggal_kembali ? $sewa->tanggal_kembali->format('d/m/Y') : '-' }}<br><span class="text-[11px] text-white/40">{{ $sewa->jam_kembali ?? '' }}</span></td>
                        <td class="px-6 py-4 font-medium text-white">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                            $sc = match($sewa->status) { 'aktif' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'selesai' => 'bg-white/[0.1] text-white', 'dibatalkan' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-white/[0.1] text-white/80' };
                            $sl = match($sewa->status) { 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan', default => $sewa->status };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/penyewaan/{{ $sewa->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/penyewaan/{{ $sewa->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($sewa->status === 'aktif')
                                <form action="/penyewaan/{{ $sewa->id }}/batalkan" method="POST" onsubmit="return confirm('Yakin batalkan penyewaan ini? Mobil akan kembali tersedia.')">
                                    @csrf @method('PUT')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-500/10 transition-colors" title="Batalkan">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-white/50">Belum ada data penyewaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
            <div>Menampilkan {{ count($penyewaans) }} data</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('#penyewaanTable tbody tr').forEach(function(r) {
        r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endpush

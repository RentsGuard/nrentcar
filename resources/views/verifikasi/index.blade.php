@extends('layout')

@section('title', 'Verifikasi Customer - RentSCar')

@section('page-title', 'Verifikasi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Verifikasi</h1>
            <p class="text-white/50 text-sm mt-1">Verifikasi data customer untuk kelengkapan dokumen.</p>
        </div>
        <a href="/verifikasi/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Verifikasi Baru
        </a>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <div class="relative w-full sm:w-72">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                <input type="text" id="searchInput" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari verifikasi...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="verifikasiTable">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">NIK</th>
                        <th class="px-6 py-4 font-medium">Tanggal Verifikasi</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Verifikator</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($verifikasis as $v)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs shrink-0">{{ strtoupper(substr($v->customer->nama_customer ?? '?', 0, 1)) }}</div>
                                <span class="font-medium text-white">{{ $v->customer->nama_customer ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-white/70">{{ $v->customer->nik ?? '-' }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $v->tanggal_verifikasi ? $v->tanggal_verifikasi->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4">
                            @php
                            $sc = match($v->status_verifikasi) { 'disetujui' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'ditolak' => 'bg-red-500/10 text-red-400 border-red-500/20', 'menunggu' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', default => 'bg-white/[0.1] text-white/80' };
                            $sl = match($v->status_verifikasi) { 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', 'menunggu' => 'Menunggu', default => $v->status_verifikasi };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $sc }}">{{ $sl }}</span>
                        </td>
                        <td class="px-6 py-4 text-white/70">{{ $v->verifier->nama_user ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/verifikasi/{{ $v->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/verifikasi/{{ $v->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-white/50">Belum ada data verifikasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
            <div>Menampilkan {{ count($verifikasis) }} data</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('#verifikasiTable tbody tr').forEach(function(r) {
        r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endpush

@extends('layout')

@section('title', 'Data Customer - RentSCar')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Data Customer</h1>
            <p class="text-white/50 text-sm mt-1">Kelola data pelanggan dan informasi KTP.</p>
        </div>
        <a href="/customer/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Tambah Customer
        </a>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="p-4 border-b border-white/[0.05] bg-white/[0.01]">
            <form method="GET" action="/customer" class="flex flex-wrap items-end gap-3">
                <div class="relative w-full sm:w-60">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari nama atau NIK...">
                </div>
                <div class="w-full sm:w-44">
                    <select name="filter_verifikasi" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">Semua Status</option>
                        <option value="belum" {{ request('filter_verifikasi') === 'belum' ? 'selected' : '' }}>Belum diverifikasi</option>
                        <option value="disetujui" {{ request('filter_verifikasi') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('filter_verifikasi') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-xs hover:bg-[#a30f1a] transition-all">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'filter_verifikasi']))
                <a href="/customer" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg border border-white/[0.1] text-white/70 hover:text-white hover:bg-white/[0.05] transition-all no-underline text-xs">
                    <i class="bi bi-x-lg"></i> Reset
                </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="customerTable">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">NIK</th>
                        <th class="px-6 py-4 font-medium">Nama Customer</th>
                        <th class="px-6 py-4 font-medium">No. HP</th>
                        <th class="px-6 py-4 font-medium">Kota</th>
                        <th class="px-6 py-4 font-medium">Verifikasi</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-white/70">{{ $customer->nik }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs shrink-0">{{ strtoupper(substr($customer->nama_customer, 0, 1)) }}</div>
                                <div>
                                    <div class="font-medium text-white">{{ $customer->nama_customer }}</div>
                                    <div class="text-xs text-white/50">{{ $customer->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-white/80">{{ $customer->no_hp }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $customer->kota_kabupaten ?? '-' }}{{ $customer->provinsi ? ', '.$customer->provinsi : '' }}</td>
                        <td class="px-6 py-4">
                            @php $vc = match($customer->status_verifikasi) { 'disetujui' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'ditolak' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }; @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border {{ $vc }}">{{ ucfirst($customer->status_verifikasi ?? 'Belum') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/customer/{{ $customer->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/customer/{{ $customer->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-white/50">Tidak ada data customer.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/[0.05] flex flex-wrap items-center justify-between gap-3 text-sm text-white/50 bg-white/[0.01]">
            <div>{{ $customers->firstItem() ?? 0 }}–{{ $customers->lastItem() ?? 0 }} dari {{ $customers->total() }} data</div>
            @if($customers->hasPages())
            {{ $customers->links('partials.pagination') }}
            @endif
        </div>
    </div>
</div>
@endsection

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
            <div class="relative w-full sm:w-72">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-sm"></i>
                <input type="text" id="searchInput" class="w-full h-10 pl-9 pr-3 rounded-lg border border-white/[0.1] bg-black/20 text-white text-sm outline-none placeholder:text-white/40 transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]" placeholder="Cari nama atau NIK...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="customerTable">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">NIK</th>
                        <th class="px-6 py-4 font-medium">Nama Customer</th>
                        <th class="px-6 py-4 font-medium">No. HP</th>
                        <th class="px-6 py-4 font-medium">Kota/Kab</th>
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
                        <td class="px-6 py-4 text-white/60">{{ $customer->kota_kabupaten ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/customer/{{ $customer->id }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/customer/{{ $customer->id }}/edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-white/70 hover:bg-white/[0.08] transition-colors" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="/customer/{{ $customer->id }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-500/10 transition-colors" title="Hapus" data-name="{{ $customer->nama_customer }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-white/50">Tidak ada data customer.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
            <div>Menampilkan {{ count($customers) }} data</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('#customerTable tbody tr').forEach(function(r) {
        r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
document.querySelectorAll('.btn-delete').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var form = this.closest('form');
        var name = this.dataset.name;
        Swal.fire({
            title: 'Hapus ' + name + '?',
            text: 'Tindakan ini tidak dapat dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C1121F',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            background: '#141414',
            color: '#fff',
        }).then(function(r) { if (r.isConfirmed) form.submit(); });
    });
});
</script>
@endpush

@extends('layout')

@section('title', 'Role & Akses - RentSCar')

@section('page-title', 'Role & Akses')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Role & Akses</h1>
            <p class="text-white/50 text-sm mt-1">Kelola hak akses dan role pengguna sistem.</p>
        </div>
        <a href="/staff/create" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-plus-lg"></i> Tambah Staff
        </a>
    </div>

    <div class="glass-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                    <tr>
                        <th class="px-6 py-4 font-medium">User</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Role</th>
                        <th class="px-6 py-4 font-medium">Penyewaan</th>
                        <th class="px-6 py-4 font-medium">Verif. Cust</th>
                        <th class="px-6 py-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.05]">
                    @forelse($users as $user)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold text-xs">{{ strtoupper(substr($user->nama_user, 0, 1)) }}</div>
                                <span class="font-medium text-white">{{ $user->nama_user }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-white/70">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if($user->role === 'admin')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-[#C1121F]/10 text-[#C1121F] border-[#C1121F]/20">Admin</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-white/[0.05] text-white/70 border-white/10">Staff</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-white/60">{{ $user->penyewaan_count }}</td>
                        <td class="px-6 py-4 text-white/60">{{ $user->verified_customers_count }}</td>
                        <td class="px-6 py-4 text-right">
                            @if(auth()->user()->role === 'admin' && $user->id !== auth()->id())
                            <a href="/staff/{{ $user->id }}/edit" class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg text-white/70 hover:bg-white/[0.08] text-xs transition-colors no-underline">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            @else
                            <span class="text-xs text-white/30">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-white/50">Tidak ada data pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

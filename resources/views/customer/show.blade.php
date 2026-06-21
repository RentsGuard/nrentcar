@extends('layout')

@section('title', 'Detail Customer - RentSCar')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/customer" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-white tracking-tight">Detail Customer</h1>
            <p class="text-white/50 text-sm mt-1">Informasi lengkap data pelanggan.</p>
        </div>
        <a href="/customer/{{ $customer->id }}/edit" class="inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all no-underline">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Akun</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Nama Lengkap</p>
                        <p class="text-sm text-white font-medium mt-1">{{ $customer->nama_customer }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Email</p>
                        <p class="text-sm text-white mt-1">{{ $customer->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">No. HP</p>
                        <p class="text-sm text-white mt-1">{{ $customer->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">NIK</p>
                        <p class="text-sm text-white mt-1 font-mono">{{ $customer->nik }}</p>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi KTP</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Tempat / Tgl Lahir</p>
                        <p class="text-sm text-white mt-1">{{ $customer->tempat_lahir ?? '-' }}@if($customer->tanggal_lahir), {{ $customer->tanggal_lahir->format('d M Y') }}@endif</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Jenis Kelamin</p>
                        <p class="text-sm text-white mt-1">{{ $customer->jenis_kelamin == 'L' ? 'Laki-laki' : ($customer->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Golongan Darah</p>
                        <p class="text-sm text-white mt-1">{{ $customer->golongan_darah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Agama</p>
                        <p class="text-sm text-white mt-1">{{ $customer->agama ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Status Perkawinan</p>
                        <p class="text-sm text-white mt-1">{{ $customer->status_perkawinan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Pekerjaan</p>
                        <p class="text-sm text-white mt-1">{{ $customer->pekerjaan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Kewarganegaraan</p>
                        <p class="text-sm text-white mt-1">{{ $customer->kewarganegaraan ?? 'WNI' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Berlaku Hingga</p>
                        <p class="text-sm text-white mt-1">{{ $customer->berlaku_hingga ? $customer->berlaku_hingga->format('d M Y') : 'Seumur Hidup' }}</p>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Alamat</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <p class="text-xs text-white/50 uppercase tracking-wide">Alamat Lengkap</p>
                        <p class="text-sm text-white mt-1">{{ $customer->alamat_customer }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">RT / RW</p>
                        <p class="text-sm text-white mt-1">{{ $customer->rt_rw ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Kelurahan</p>
                        <p class="text-sm text-white mt-1">{{ $customer->kelurahan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Kecamatan</p>
                        <p class="text-sm text-white mt-1">{{ $customer->kecamatan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Kota / Kabupaten</p>
                        <p class="text-sm text-white mt-1">{{ $customer->kota_kabupaten ?? '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-white/50 uppercase tracking-wide">Provinsi</p>
                        <p class="text-sm text-white mt-1">{{ $customer->provinsi ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Foto KTP</h3>
                </div>
                <div class="p-6">
                    @if($customer->foto_ktp)
                    <img src="{{ asset('storage/'.$customer->foto_ktp) }}" alt="KTP {{ $customer->nama_customer }}" class="w-full rounded-lg border border-white/[0.1]">
                    @else
                    <div class="flex flex-col items-center justify-center py-8 text-white/40">
                        <i class="bi bi-card-image text-4xl mb-3"></i>
                        <p class="text-sm">Belum ada foto KTP</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Verifikasi</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Status</p>
                        @php
                        $vc = match($customer->status_verifikasi) { 'disetujui' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'ditolak' => 'bg-red-500/10 text-red-400 border-red-500/20', default => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $vc }} mt-1">{{ ucfirst($customer->status_verifikasi ?? 'Belum diverifikasi') }}</span>
                    </div>
                    @if($customer->verified_by && $customer->verifikator)
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Diverifikasi Oleh</p>
                        <p class="text-sm text-white mt-1">{{ $customer->verifikator->nama_user }}</p>
                    </div>
                    @endif
                    @if($customer->tanggal_verifikasi)
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Tanggal Verifikasi</p>
                        <p class="text-sm text-white mt-1">{{ $customer->tanggal_verifikasi->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                    @if($customer->catatan_verifikasi)
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Catatan</p>
                        <p class="text-sm text-white/80 mt-1">{{ $customer->catatan_verifikasi }}</p>
                    </div>
                    @endif
                    @if(auth()->user()->role === 'admin')
                    <div class="pt-2">
                        <form action="/customer/{{ $customer->id }}/verify" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="text-xs text-white/50 uppercase tracking-wide block mb-1.5">Ubah Status</label>
                                <select name="action" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                                    <option value="">Belum diverifikasi</option>
                                    <option value="disetujui" {{ $customer->status_verifikasi === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $customer->status_verifikasi === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 h-9 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-xs hover:bg-[#a30f1a] transition-all">
                                <i class="bi bi-check-lg"></i> Simpan Verifikasi
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Info Sistem</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Dibuat</p>
                        <p class="text-sm text-white mt-1">{{ $customer->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wide">Diperbarui</p>
                        <p class="text-sm text-white mt-1">{{ $customer->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

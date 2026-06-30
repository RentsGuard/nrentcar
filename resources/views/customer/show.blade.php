@extends('layout')

@section('title', 'Detail Customer - RentSCar')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
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

    {{-- Statistik Ringkasan --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass-card p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center shrink-0">
                <i class="bi bi-journal-text text-blue-400"></i>
            </div>
            <div>
                <p class="text-xs text-white/50 uppercase tracking-wide">Total Sewa</p>
                <p class="text-xl font-bold text-white">{{ $totalSewa }}</p>
            </div>
        </div>
        <div class="glass-card p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0">
                <i class="bi bi-car-front text-emerald-400"></i>
            </div>
            <div>
                <p class="text-xs text-white/50 uppercase tracking-wide">Sewa Aktif</p>
                <p class="text-xl font-bold text-white">{{ $penyewaanAktif }}</p>
            </div>
        </div>
        <div class="glass-card p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center shrink-0">
                <i class="bi bi-exclamation-triangle text-red-400"></i>
            </div>
            <div>
                <p class="text-xs text-white/50 uppercase tracking-wide">Pelanggaran</p>
                <p class="text-xl font-bold text-white">{{ $riwayatKesalahan->count() }}</p>
            </div>
        </div>
        <div class="glass-card p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center shrink-0">
                <i class="bi bi-cash-stack text-orange-400"></i>
            </div>
            <div>
                <p class="text-xs text-white/50 uppercase tracking-wide">Total Denda</p>
                <p class="text-sm font-bold text-white">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
            </div>
        </div>
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

            {{-- ============================================================ --}}
            {{-- RIWAYAT PENYEWAAN                                            --}}
            {{-- ============================================================ --}}
            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                            <i class="bi bi-clock-history text-blue-400 text-sm"></i>
                        </div>
                        <h3 class="text-base font-semibold text-white">Riwayat Penyewaan</h3>
                    </div>
                    <span class="text-xs text-white/40 font-medium">{{ $customer->penyewaan->count() }} transaksi</span>
                </div>

                @if($customer->penyewaan->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 text-white/30">
                    <i class="bi bi-journal-x text-4xl mb-3"></i>
                    <p class="text-sm">Belum ada riwayat penyewaan</p>
                </div>
                @else
                <div class="divide-y divide-white/[0.04]">
                    @foreach($customer->penyewaan as $sewa)
                    @php
                        $statusColor = match($sewa->status) {
                            'aktif'      => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                            'selesai'    => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'dibatalkan' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            'menunggu'   => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                            default      => 'bg-white/5 text-white/50 border-white/10',
                        };
                        $statusLabel = match($sewa->status) {
                            'aktif'      => 'Aktif',
                            'selesai'    => 'Selesai',
                            'dibatalkan' => 'Dibatalkan',
                            'menunggu'   => 'Menunggu',
                            default      => ucfirst($sewa->status),
                        };
                    @endphp
                    <div class="px-6 py-4 hover:bg-white/[0.02] transition-colors">
                        <div class="flex items-start gap-4">
                            {{-- Foto Mobil / Ikon --}}
                            <div class="w-14 h-14 rounded-xl overflow-hidden bg-white/[0.04] border border-white/[0.07] shrink-0 flex items-center justify-center">
                                @if($sewa->mobil && $sewa->mobil->foto_mobil)
                                    <img src="{{ asset('storage/'.$sewa->mobil->foto_mobil) }}" alt="{{ $sewa->mobil->nama_mobil }}" class="w-full h-full object-cover">
                                @else
                                    <i class="bi bi-car-front text-white/30 text-2xl"></i>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-semibold text-white truncate">
                                        {{ $sewa->mobil->nama_mobil ?? 'Mobil dihapus' }}
                                    </p>
                                    @if($sewa->mobil)
                                    <span class="text-xs text-white/40 font-mono">{{ $sewa->mobil->plat_mobil }}</span>
                                    @endif
                                    <span class="ml-auto inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border {{ $statusColor }}">{{ $statusLabel }}</span>
                                </div>
                                <div class="flex items-center gap-4 mt-1.5 text-xs text-white/50 flex-wrap">
                                    <span><i class="bi bi-calendar3 mr-1"></i>{{ $sewa->tanggal_sewa->format('d M Y') }} &rarr; {{ $sewa->tanggal_kembali->format('d M Y') }}</span>
                                    <span><i class="bi bi-clock mr-1"></i>{{ $sewa->lama_sewa }} hari</span>
                                    <span class="font-medium text-white/70"><i class="bi bi-cash mr-1"></i>Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</span>
                                </div>
                                @if($sewa->pengembalian)
                                @php
                                    $kondisiColor = match($sewa->pengembalian->status_pengembalian) {
                                        'telat'          => 'text-yellow-400',
                                        'rusak'          => 'text-red-400',
                                        'telat_dan_rusak'=> 'text-red-500',
                                        default          => 'text-emerald-400',
                                    };
                                    $kondisiLabel = match($sewa->pengembalian->status_pengembalian) {
                                        'telat'          => 'Telat Kembali',
                                        'rusak'          => 'Kondisi Rusak',
                                        'telat_dan_rusak'=> 'Telat & Rusak',
                                        default          => 'Tepat Waktu',
                                    };
                                @endphp
                                <div class="mt-1.5 flex items-center gap-3 text-xs flex-wrap">
                                    <span class="{{ $kondisiColor }}"><i class="bi bi-info-circle mr-1"></i>{{ $kondisiLabel }}</span>
                                    @if($sewa->pengembalian->total_denda > 0)
                                    <span class="text-red-400"><i class="bi bi-receipt mr-1"></i>Denda: Rp {{ number_format($sewa->pengembalian->total_denda, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <a href="/penyewaan/{{ $sewa->id }}" class="shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-white/[0.04] hover:bg-white/[0.08] text-white/50 hover:text-white transition-colors no-underline" title="Lihat Detail">
                                <i class="bi bi-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- ============================================================ --}}
            {{-- RIWAYAT KESALAHAN / PELANGGARAN                             --}}
            {{-- ============================================================ --}}
            <div class="glass-card">
                <div class="px-6 py-5 border-b border-white/[0.05] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center">
                            <i class="bi bi-exclamation-triangle text-red-400 text-sm"></i>
                        </div>
                        <h3 class="text-base font-semibold text-white">Riwayat Pelanggaran</h3>
                    </div>
                    @if($riwayatKesalahan->isNotEmpty())
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-red-500/10 text-red-400 border-red-500/20">
                        {{ $riwayatKesalahan->count() }} kejadian
                    </span>
                    @endif
                </div>

                @if($riwayatKesalahan->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 text-white/30">
                    <i class="bi bi-shield-check text-4xl mb-3 text-emerald-500/40"></i>
                    <p class="text-sm text-emerald-400/60">Tidak ada riwayat pelanggaran</p>
                    <p class="text-xs text-white/30 mt-1">Customer ini memiliki rekam jejak yang baik</p>
                </div>
                @else
                <div class="divide-y divide-white/[0.04]">
                    @foreach($riwayatKesalahan as $p)
                    @php
                        $pg = $p->pengembalian;
                        $jenisColor = match($pg->status_pengembalian) {
                            'telat'          => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'bi-clock-history'],
                            'rusak'          => ['bg' => 'bg-red-500/10',    'text' => 'text-red-400',    'border' => 'border-red-500/20',    'icon' => 'bi-tools'],
                            'telat_dan_rusak'=> ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'bi-exclamation-octagon'],
                            default          => ['bg' => 'bg-white/5',       'text' => 'text-white/50',   'border' => 'border-white/10',      'icon' => 'bi-dash'],
                        };
                        $jenisLabel = match($pg->status_pengembalian) {
                            'telat'          => 'Telat Kembali',
                            'rusak'          => 'Kerusakan Mobil',
                            'telat_dan_rusak'=> 'Telat & Kerusakan',
                            default          => ucfirst($pg->status_pengembalian),
                        };
                    @endphp
                    <div class="px-6 py-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl {{ $jenisColor['bg'] }} border {{ $jenisColor['border'] }} flex items-center justify-center shrink-0">
                                <i class="bi {{ $jenisColor['icon'] }} {{ $jenisColor['text'] }} text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-sm font-semibold {{ $jenisColor['text'] }}">{{ $jenisLabel }}</span>
                                    <span class="text-xs text-white/40">&mdash;</span>
                                    <span class="text-sm text-white/80">{{ $p->mobil->nama_mobil ?? 'Mobil dihapus' }}</span>
                                    @if($p->mobil)
                                    <span class="text-xs text-white/40 font-mono">{{ $p->mobil->plat_mobil }}</span>
                                    @endif
                                </div>
                                <p class="text-xs text-white/50 mt-1">
                                    <i class="bi bi-calendar-event mr-1"></i>Dikembalikan: {{ $pg->tanggal_pengembalian->format('d M Y, H:i') }}
                                </p>

                                {{-- Detail Denda --}}
                                <div class="mt-3 grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    @if($pg->telat_jam)
                                    <div class="rounded-lg bg-yellow-500/5 border border-yellow-500/10 px-3 py-2">
                                        <p class="text-xs text-white/40">Telat</p>
                                        <p class="text-sm font-semibold text-yellow-400">{{ $pg->telat_jam }} jam</p>
                                    </div>
                                    @endif
                                    @if($pg->denda_telat > 0)
                                    <div class="rounded-lg bg-yellow-500/5 border border-yellow-500/10 px-3 py-2">
                                        <p class="text-xs text-white/40">Denda Telat</p>
                                        <p class="text-sm font-semibold text-yellow-400">Rp {{ number_format($pg->denda_telat, 0, ',', '.') }}</p>
                                    </div>
                                    @endif
                                    @if($pg->denda_kerusakan > 0)
                                    <div class="rounded-lg bg-red-500/5 border border-red-500/10 px-3 py-2">
                                        <p class="text-xs text-white/40">Denda Kerusakan</p>
                                        <p class="text-sm font-semibold text-red-400">Rp {{ number_format($pg->denda_kerusakan, 0, ',', '.') }}</p>
                                    </div>
                                    @endif
                                    @if($pg->total_denda > 0)
                                    <div class="rounded-lg bg-orange-500/5 border border-orange-500/10 px-3 py-2">
                                        <p class="text-xs text-white/40">Total Denda</p>
                                        <p class="text-sm font-bold text-orange-400">Rp {{ number_format($pg->total_denda, 0, ',', '.') }}</p>
                                    </div>
                                    @endif
                                </div>

                                @if($pg->kondisi_mobil)
                                <div class="mt-3 p-3 rounded-lg bg-white/[0.03] border border-white/[0.06]">
                                    <p class="text-xs text-white/40 mb-1">Kondisi Mobil</p>
                                    <p class="text-xs text-white/70">{{ $pg->kondisi_mobil }}</p>
                                </div>
                                @endif

                                @if($pg->catatan)
                                <div class="mt-2 p-3 rounded-lg bg-white/[0.03] border border-white/[0.06]">
                                    <p class="text-xs text-white/40 mb-1">Catatan Petugas</p>
                                    <p class="text-xs text-white/70">{{ $pg->catatan }}</p>
                                </div>
                                @endif

                                <div class="mt-3 flex items-center gap-2">
                                    @if($pg->status_denda === 'lunas')
                                    <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <i class="bi bi-check-circle"></i> Denda Lunas
                                    </span>
                                    @elseif($pg->total_denda > 0)
                                    <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-full bg-red-500/10 text-red-400 border border-red-500/20">
                                        <i class="bi bi-x-circle"></i> Denda Belum Lunas
                                    </span>
                                    @endif
                                    <a href="/penyewaan/{{ $p->id }}" class="text-xs text-white/40 hover:text-white transition-colors no-underline ml-auto">
                                        Lihat Penyewaan <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
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

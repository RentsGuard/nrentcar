@extends('layout')

@section('title', 'Edit Customer - RentSCar')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="/customer" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Customer</h1>
            <p class="text-white/50 text-sm mt-1">Perbarui data pelanggan.</p>
        </div>
    </div>

    <form action="/customer/{{ $customer->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Akun</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Nama Lengkap</label>
                        <input type="text" name="nama_customer" value="{{ old('nama_customer', $customer->nama_customer) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('nama_customer') border-red-500 @enderror">
                        @error('nama_customer') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Email</label>
                        <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $customer->no_hp) }}" required class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('no_hp') border-red-500 @enderror">
                        @error('no_hp') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi KTP</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $customer->nik) }}" required maxlength="16" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('nik') border-red-500 @enderror">
                        @error('nik') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $customer->tempat_lahir) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('tempat_lahir') border-red-500 @enderror">
                        @error('tempat_lahir') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $customer->tanggal_lahir?->format('Y-m-d')) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('tanggal_lahir') border-red-500 @enderror">
                        @error('tanggal_lahir') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $customer->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $customer->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Golongan Darah</label>
                        <select name="golongan_darah" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            @foreach(['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $gol)
                            <option value="{{ $gol }}" {{ old('golongan_darah', $customer->golongan_darah) == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                            @endforeach
                        </select>
                        @error('golongan_darah') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Agama</label>
                        <select name="agama" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                            <option value="{{ $ag }}" {{ old('agama', $customer->agama) == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                        @error('agama') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Status Perkawinan</label>
                        <select name="status_perkawinan" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            @foreach(['Belum Kawin', 'Kawin', 'Cerai'] as $st)
                            <option value="{{ $st }}" {{ old('status_perkawinan', $customer->status_perkawinan) == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                        @error('status_perkawinan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $customer->pekerjaan) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('pekerjaan') border-red-500 @enderror">
                        @error('pekerjaan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $customer->kewarganegaraan ?? 'WNI') }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('kewarganegaraan') border-red-500 @enderror">
                        @error('kewarganegaraan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-white/80 mb-1.5 block">Berlaku Hingga</label>
                        <p class="text-sm text-white/70 px-1">Seumur Hidup</p>
                    </div>
                </div>

                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Foto KTP</h3>
                </div>

                <div class="space-y-2">
                    @if($customer->foto_ktp)
                    <div class="mb-3">
                        <img src="{{ $customer->foto_ktp_url }}" alt="KTP {{ $customer->nama_customer }}" class="w-48 rounded-lg border border-white/[0.1]">
                        <p class="text-xs text-white/50 mt-1">KTP saat ini. Upload baru untuk mengganti.</p>
                    </div>
                    @endif
                    <p class="text-xs text-white/50 mt-1">Upload foto KTP (max 2MB, format JPG/PNG).</p>
                    <input type="file" name="foto_ktp" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all @error('foto_ktp') border-red-500 @enderror">
                    @error('foto_ktp') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                @if(auth()->user()->role === 'admin')
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Verifikasi</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Status Verifikasi</label>
                        <select name="status_verifikasi" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                            <option value="">-- Pilih --</option>
                            <option value="disetujui" {{ old('status_verifikasi', $customer->status_verifikasi) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ old('status_verifikasi', $customer->status_verifikasi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Diverifikasi Oleh</label>
                        <input type="text" value="{{ $customer->verifikator?->nama_user ?? 'Otomatis' }}" disabled class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D]/50 text-white/60 px-3 text-sm cursor-not-allowed">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Tanggal Verifikasi</label>
                        <input type="text" value="{{ $customer->tanggal_verifikasi ? $customer->tanggal_verifikasi->format('d/m/Y H:i') : '-' }}" disabled class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D]/50 text-white/60 px-3 text-sm cursor-not-allowed">
                    </div>
                </div>
                @endif

                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Alamat</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-sm font-medium text-white/80">Alamat</label>
                        <textarea name="alamat_customer" rows="2" required class="w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 py-2 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('alamat_customer') border-red-500 @enderror">{{ old('alamat_customer', $customer->alamat_customer) }}</textarea>
                        @error('alamat_customer') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">RT/RW</label>
                        <input type="text" name="rt_rw" value="{{ old('rt_rw', $customer->rt_rw) }}" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('rt_rw') border-red-500 @enderror">
                        @error('rt_rw') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $customer->provinsi) }}" placeholder="Contoh: JAWA BARAT" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('provinsi') border-red-500 @enderror">
                        @error('provinsi') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kota/Kabupaten</label>
                        <input type="text" name="kota_kabupaten" value="{{ old('kota_kabupaten', $customer->kota_kabupaten) }}" placeholder="Contoh: KABUPATEN BANDUNG" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('kota_kabupaten') border-red-500 @enderror">
                        @error('kota_kabupaten') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $customer->kecamatan) }}" placeholder="Contoh: CICENDO" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('kecamatan') border-red-500 @enderror">
                        @error('kecamatan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-white/80">Kelurahan</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $customer->kelurahan) }}" placeholder="Contoh: PASIRKALIKI" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('kelurahan') border-red-500 @enderror">
                        @error('kelurahan') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-white/[0.05] flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 h-10 px-6 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


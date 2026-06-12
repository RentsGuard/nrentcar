@extends('layout')

@section('title', 'Edit Staff - RentSCar')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('staff.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Staff</h1>
            <p class="text-white/50 text-sm mt-1">Perbarui informasi akun staff.</p>
        </div>
    </div>

    <form action="{{ route('staff.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="pb-4 border-b border-white/[0.05]">
                    <h3 class="text-base font-semibold text-white">Informasi Akun</h3>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Nama Lengkap</label>
                    <input type="text" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required placeholder="Masukkan nama lengkap" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('nama_user') border-red-500 @enderror">
                    @error('nama_user') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="nama@rentscar.id" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Foto Profil</label>
                    @if($user->foto_profil)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$user->foto_profil) }}" alt="{{ $user->nama_user }}" class="w-16 h-16 rounded-full object-cover border-2 border-white/10">
                    </div>
                    @endif
                    <input type="file" name="foto_profil" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all @error('foto_profil') border-red-500 @enderror">
                    @error('foto_profil') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Role</label>
                    <select name="role" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 text-sm outline-none transition-colors focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] appearance-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.5)%22 stroke-width=%222%22%3E%3Cpath d=%22M6 9l6 6 6-6%22/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="pt-6 border-t border-white/[0.05] flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 h-10 px-6 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="glass-card">
            <div class="p-6">
            <div class="pb-4 border-b border-white/[0.05]">
                <h3 class="text-base font-semibold text-white">Reset Password</h3>
            </div>

            <form action="{{ route('staff.reset-password', $user->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="flex items-end gap-4">
                    <div class="flex-1 space-y-2">
                        <label class="text-sm font-medium text-white/80">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="new_password" id="pwReset" required minlength="6" placeholder="Min. 6 karakter" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 pr-10 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('new_password') border-red-500 @enderror">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition-colors" onclick="togglePw('pwReset','pwResetIcon')">
                                <i class="bi bi-eye" id="pwResetIcon"></i>
                            </button>
                        </div>
                        @error('new_password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="shrink-0 inline-flex items-center gap-2 h-10 px-4 rounded-lg bg-[#C1121F] text-white font-semibold text-sm shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] hover:bg-[#a30f1a] transition-all" onclick="return confirm('Reset password {{ $user->nama_user }}?')">
                        <i class="bi bi-shield-lock"></i> Reset
                    </button>
                </div>
            </form>
            </div>
    </div>
</div>
@endsection

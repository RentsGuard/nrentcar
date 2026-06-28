@extends('layout')

@section('title', 'Edit Profil - RentSCar')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ url(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/staff/dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/[0.03] text-white/70 hover:bg-white/[0.08] hover:text-white transition-colors no-underline">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Profil</h1>
            <p class="text-white/50 text-sm mt-1">Perbarui informasi akun Anda.</p>
        </div>
    </div>

    <form action="/profile" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="glass-card">
            <div class="p-6 space-y-6">
                <div class="flex items-center gap-4 pb-6 border-b border-white/[0.05]">
                    <div class="relative">
                        @if($user->foto_profil)
                        <img src="{{ asset('storage/'.$user->foto_profil) }}" alt="{{ $user->nama_user }}" class="w-16 h-16 rounded-full object-cover border-2 border-white/10">
                        @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">{{ strtoupper(substr($user->nama_user, 0, 1)) }}</div>
                        @endif
                    </div>
                    <div>
                        <p class="text-white font-semibold text-base">{{ $user->nama_user }}</p>
                        <p class="text-white/60 text-sm">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Foto Profil</label>
                    <input type="file" name="foto_profil" id="fotoProfilInput" accept="image/jpeg,image/png" class="w-full text-sm text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-white/20 file:bg-[#C1121F] file:text-white file:font-semibold file:text-sm hover:file:bg-[#a30f1a] transition-all @error('foto_profil') border-red-500 @enderror">
                    <div id="fotoPreview" class="hidden mt-3">
                        <img class="w-24 h-24 rounded-full object-cover border-2 border-white/10 shadow-lg">
                    </div>
                    @error('foto_profil') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
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
                    <label class="text-sm font-medium text-white/80">Password Baru <span class="text-white/40 font-normal">(Kosongkan jika tidak ingin mengubah)</span></label>
                    <div class="relative">
                        <input type="password" name="password" id="pwProfile" placeholder="Masukkan password baru" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 pr-10 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('password') border-red-500 @enderror">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition-colors" onclick="togglePw('pwProfile','pwProfileIcon')">
                            <i class="bi bi-eye" id="pwProfileIcon"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
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

@push('scripts')
<script>
document.getElementById('fotoProfilInput')?.addEventListener('change', function(e) {
    var preview = document.getElementById('fotoPreview');
    var img = preview.querySelector('img');
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(ev) { img.src = ev.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(file);
    } else { preview.classList.add('hidden'); }
});
</script>
@endpush

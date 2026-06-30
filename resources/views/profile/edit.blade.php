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
        <div class="glass-card relative overflow-visible" style="margin-top:96px; overflow: visible;">

            <!-- FOTO PROFIL -->
            <div class="absolute left-1/2 z-10 w-48" style="top:-96px; transform: translateX(-50%);">

                <label for="fotoProfilInput" class="relative group cursor-pointer block w-48 h-48" style="width:192px;height:192px;">

                    @if($user->foto_profil)
                        <img
                            id="previewFoto"
                            src="{{ asset('storage/'.$user->foto_profil) }}"
                            class="block w-48 h-48 rounded-full object-cover border-[6px] border-[#151515] shadow-2xl"
                            style="width:192px;height:192px;border-radius:9999px;object-fit:cover;border:6px solid #151515;">
                    @else
                        <div
                            id="previewFoto"
                            class="flex w-48 h-48 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 border-[6px] border-[#151515] items-center justify-center text-white text-6xl font-bold shadow-2xl"
                            style="width:192px;height:192px;border-radius:9999px;border:6px solid #151515;display:flex;align-items:center;justify-content:center;background:linear-gradient(to top right,#C1121F,#ef4444);">

                            {{ strtoupper(substr($user->nama_user,0,1)) }}

                        </div>
                    @endif

                    <div class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                        <i class="bi bi-camera-fill text-white text-5xl"></i>

                    </div>

                </label>

                <input
                    type="file"
                    id="fotoProfilInput"
                    name="foto_profil"
                    accept="image/*"
                    class="hidden">

            </div>

            <div class="p-6 space-y-6" style="padding-top:112px;">

                <div class="text-center pb-6 border-b border-white/[0.05]">

                    <h2 class="text-3xl text-white font-bold">
                        {{ $user->nama_user }}
                    </h2>

                    <p class="text-white/60 mt-1">
                        {{ ucfirst($user->role) }}
                    </p>

                </div>

                @error('foto_profil') <p class="text-xs text-red-400 mt-1 text-center">{{ $message }}</p> @enderror

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
                    <label class="text-sm font-medium text-white/80">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="pwCurrent" placeholder="Masukkan password saat ini" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 pr-10 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)] @error('current_password') border-red-500 @enderror">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition-colors" onclick="togglePw('pwCurrent','pwCurrentIcon')">
                            <i class="bi bi-eye" id="pwCurrentIcon"></i>
                        </button>
                    </div>
                    @error('current_password') <p class="text-xs text-red-400 mt-1">{{ $message }}</p> @enderror
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

                <div class="space-y-2">
                    <label class="text-sm font-medium text-white/80">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="pwProfileConfirm" placeholder="Ulangi password baru" class="w-full h-10 rounded-lg border border-white/[0.1] bg-[#0D0D0D] text-white px-3 pr-10 text-sm outline-none transition-colors placeholder:text-white/40 focus:border-[#C1121F]/50 focus:shadow-[0_0_0_2px_rgba(193,18,31,0.3)]">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition-colors" onclick="togglePw('pwProfileConfirm','pwProfileConfirmIcon')">
                            <i class="bi bi-eye" id="pwProfileConfirmIcon"></i>
                        </button>
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

@push('scripts')
<script>
document.getElementById("fotoProfilInput").addEventListener("change", function(e){

    const file = e.target.files[0];

    if(!file) return;

    const reader = new FileReader();

    reader.onload = function(event){

        let foto = document.getElementById("previewFoto");

        if(foto.tagName==="IMG"){

            foto.src = event.target.result;

        }else{

            let img=document.createElement("img");

            img.src=event.target.result;
            img.id="previewFoto";

            img.className="block w-48 h-48 rounded-full object-cover border-[6px] border-[#151515] shadow-2xl";
            img.style.width="192px";
            img.style.height="192px";
            img.style.borderRadius="9999px";
            img.style.objectFit="cover";
            img.style.border="6px solid #151515";

            foto.replaceWith(img);

        }

    }

    reader.readAsDataURL(file);

});
</script>
@endpush
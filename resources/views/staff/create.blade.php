@extends('layout')

@section('title', 'Tambah Staff - RentSCar')

@section('content')
<div style="max-width: 672px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('staff.index') }}" class="btn-ghost btn-icon" style="border-radius: 50%; background: rgba(255,255,255,0.03);">
            <i class="bi bi-arrow-left" style="font-size: 18px;"></i>
        </a>
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: white; letter-spacing: -0.02em; margin: 0;">Tambah Staff</h1>
            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin: 4px 0 0 0;">Buat akun baru untuk pengguna sistem.</p>
        </div>
    </div>

    <form action="{{ route('staff.store') }}" method="POST">
        @csrf
        <div class="glass-card" style="padding: 24px;">
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_user" class="form-input-custom @error('nama_user') error @enderror" placeholder="Masukkan nama lengkap" value="{{ old('nama_user') }}" required>
                    @error('nama_user') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input-custom @error('email') error @enderror" placeholder="nama@rentscar.id" value="{{ old('email') }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="form-label">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="passwordField" class="form-input-custom @error('password') error @enderror" placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePassword()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(255,255,255,0.4); cursor: pointer; padding: 0;">
                            <i class="bi bi-eye" id="passwordIcon" style="font-size: 16px;"></i>
                        </button>
                    </div>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select-custom">
                        <option value="staff" selected>Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div style="padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: flex-end; gap: 12px;">
                    <a href="{{ route('staff.index') }}" class="btn-ghost" style="padding: 10px 16px;">Batal</a>
                    <button type="submit" class="btn-glass" style="background: #C1121F; color: white; border: none; box-shadow: 0 0 24px -6px rgba(193,18,31,0.6); padding: 10px 16px;">
                        <i class="bi bi-check-lg" style="margin-right: 8px;"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function togglePassword() {
    const field = document.getElementById('passwordField');
    const icon = document.getElementById('passwordIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush

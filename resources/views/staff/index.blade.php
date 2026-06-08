@extends('layout')

@section('title', 'Manajemen Staff - RentSCar')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: white; letter-spacing: -0.02em; margin: 0;">Manajemen Staff</h1>
            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin: 4px 0 0 0;">Kelola akun pengguna dan hak akses sistem.</p>
        </div>
        <a href="{{ route('staff.create') }}" style="text-decoration: none;">
            <button style="height: 40px; padding: 0 16px; border-radius: 8px; background: #C1121F; color: white; border: none; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; cursor: pointer; box-shadow: 0 0 24px -6px rgba(193,18,31,0.6);">
                <i class="bi bi-plus-lg"></i> Tambah Staff
            </button>
        </a>
    </div>

    <div class="glass-card" style="padding: 0;">
        <div class="filter-bar">
            <div style="position: relative; width: 288px;">
                <i class="bi bi-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.4); font-size: 14px;"></i>
                <input type="text" id="searchInput" class="form-input-custom" style="padding-left: 36px;" placeholder="Cari nama atau email...">
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table-custom" id="staffTable">
                <thead>
                    <tr>
                        <th>Nama Staff</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="avatar-circle">{{ strtoupper(substr($user->nama_user, 0, 1)) }}</div>
                                <div>
                                    <div style="font-weight: 500; color: white;">{{ $user->nama_user }}</div>
                                    <div style="font-size: 12px; color: rgba(255,255,255,0.5);">USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="color: rgba(255,255,255,0.8);">{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                            <span class="badge-custom" style="background: rgba(193,18,31,0.2); color: #C1121F; border: 1px solid rgba(193,18,31,0.3);">Admin</span>
                            @else
                            <span class="badge-custom outline">Staff</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                <a href="/staff/{{ $user->id }}/edit" class="btn-ghost btn-icon-sm" title="Edit">
                                    <i class="bi bi-pencil" style="color: rgba(255,255,255,0.7); font-size: 14px;"></i>
                                </a>
                                @if($user->role !== 'admin')
                                <form action="/staff/{{ $user->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun staff ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-ghost btn-icon-sm" title="Hapus" style="color: #f87171;">
                                        <i class="bi bi-trash" style="font-size: 14px;"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 32px; color: rgba(255,255,255,0.5);">Tidak ada data staff yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div>Menampilkan {{ count($users) }} data</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    document.querySelectorAll('#staffTable tbody tr').forEach(function(row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
});
</script>
@endpush

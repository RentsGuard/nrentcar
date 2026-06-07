@extends('layout')

@section('content')

<h2>Edit Akun Staff</h2>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('staff.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Staff</label>
                <input type="text" name="nama_user" class="form-control" value="{{ old('nama_user', $user->nama_user) }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="btn btn-danger">
                Simpan
            </button>

            <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </form>
    </div>
</div>

@endsection

@extends('layout')

@section('content')

<h2>Tambah Akun Staff</h2>
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('staff.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Staff</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-danger">
                Simpan
            </button>

        </form>

@endsection
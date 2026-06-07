@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Kelola Akun Staff</h2>

    <a href="/staff/create" class="btn btn-danger">
        + Tambah Staff
    </a>

</div>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

<div class="card bg-dark border-0 shadow">

    <div class="card-body">

        <table class="table table-dark table-hover align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $index => $user)

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $user->nama_user }}</td>

                        <td>{{ $user->email }}</td>

                        <td>

                            <span class="badge bg-primary">
                                Staff
                            </span>

                        </td>

                        <td>

                            <a href="/staff/{{ $user->id }}/edit"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="/staff/{{ $user->id }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus akun?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            Data staff kosong
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection

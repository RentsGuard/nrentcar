<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'staff')->latest()->get();

        return view('staff.index', compact('users'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
        ]);

        return redirect('/staff')
                ->with('success', 'Staff berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);

        return view('staff.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);

        $validated = $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->update([
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
        ]);

        return redirect('/staff')
                ->with('success', 'Data staff berhasil diupdate');
    }

    public function destroy($id)
    {
        User::where('role', 'staff')->findOrFail($id)->delete();

        return redirect('/staff')
                ->with('success', 'Data staff berhasil dihapus');
    }
}

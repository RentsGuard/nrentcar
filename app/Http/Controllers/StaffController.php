<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'staff')->latest()->paginate(15);

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
            'password' => ['required', 'string', 'min:8'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $data = [
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
        ];

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $user = User::create($data);

        activity()->performedOn($user)->log("Staff {$user->nama_user} created");

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
            'password' => ['nullable', 'string', 'min:8'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $data = [
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
            'role' => 'staff',
        ];

        if ($validated['password'] ?? null) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $user->update($data);

        activity()->performedOn($user)->log("Staff {$user->nama_user} updated");

        return redirect('/staff')
            ->with('success', 'Data staff berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $name = $user->nama_user;

        Penyewaan::where('user_id', $user->id)->update(['user_id' => null]);
        $user->delete();

        activity()->log("Staff {$name} deleted");

        return redirect('/staff')
            ->with('success', 'Data staff berhasil dihapus');
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::where('role', 'staff')->findOrFail($id);

        $validated = $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        activity()->performedOn($user)->log("Staff {$user->nama_user} password reset by admin");

        return redirect('/staff')
            ->with('success', "Password staff {$user->nama_user} berhasil direset");
    }
}

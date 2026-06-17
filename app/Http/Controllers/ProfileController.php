<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
        ];

        if ($validated['password']) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $user->update($data);

        activity()->performedOn($user)->log("Profile {$user->nama_user} updated");

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}

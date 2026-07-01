<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $key = 'login:'.$request->input('email').'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return back()->with('error', "Terlalu banyak percobaan login. Coba lagi {$minutes} menit lagi.")
                ->withInput($request->only('email'));
        }

        $remember = $request->boolean('remember_me');

        if (! Auth::attempt($request->only('email', 'password'), $remember)) {
            RateLimiter::hit($key, 60);
            $attemptsLeft = max(0, 5 - RateLimiter::attempts($key));

            return back()->with('error', 'Login gagal')
                ->with('attempts_left', $attemptsLeft)
                ->withInput($request->only('email'));
        }

        RateLimiter::clear($key);

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'staff') {
            return redirect('/staff/dashboard');
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

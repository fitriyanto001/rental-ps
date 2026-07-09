<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')
                ->with('toast_success', 'Selamat datang kembali, Admin!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Login instan sebagai tamu / dosen.
     */
    public function loginGuest(Request $request)
    {
        $guestUser = \App\Models\User::firstOrCreate(
            ['email' => 'tamu@ajisps.com'],
            [
                'name'     => 'Dosen Penilai / Tamu',
                'password' => \Illuminate\Support\Facades\Hash::make('tamu123'),
            ]
        );

        Auth::login($guestUser);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard')
            ->with('toast_success', 'Selamat datang! Anda masuk sebagai Tamu / Dosen Penilai.');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('toast_success', 'Anda telah berhasil keluar dari sistem.');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Menampilkan form login admin
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Login dengan guard admin
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {

            $user = Auth::guard('admin')->user();

            // Pastikan role = admin
            if ($user->role !== 'admin') {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'email' => 'Hanya admin yang bisa login.'
                ])->withInput();
            }

            // Login berhasil
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

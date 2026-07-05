<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'member') {
                return redirect()->route('my.dashboard')
                                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            } else {
                // Admin & Staff
                return redirect()->route('admin.dashboard')
                                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('info', 'Anda telah berhasil logout.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat User
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'member',
        ]);

        // Buat data Gym Member otomatis
        \App\Models\GymMember::create([
            'user_id' => $user->id,
            'member_code' => 'MEM-' . strtoupper(substr(uniqid(), -6)),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '', // bisa diisi nanti di profile
            'start_date' => now(),
            'expire_date' => now()->addMonths(1), // default 1 bulan
            'membership_type' => 'monthly',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('my.dashboard')
                        ->with('success', 'Registrasi berhasil! Selamat datang di Gym Management.');
    }
}
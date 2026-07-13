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
            'membership_type' => 'required|in:monthly,quarterly,annual',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'member',
        ]);

        \App\Models\GymMember::create([
            'user_id' => $user->id,
            'member_code' => 'MEM-' . strtoupper(substr(uniqid(), -6)),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '',
            'membership_type' => $request->membership_type,
            'start_date' => now(),
            'expire_date' => now()->addMonths($request->membership_type === 'monthly' ? 1 : ($request->membership_type === 'quarterly' ? 3 : 12)),
            'status' => 'active',
            'membership_status' => 'pending',   // Pending konfirmasi admin
        ]);

        Auth::login($user);

        return redirect()->route('my.dashboard')
                        ->with('info', 'Pendaftaran berhasil. Membership Anda sedang menunggu konfirmasi Admin.');
    }
}
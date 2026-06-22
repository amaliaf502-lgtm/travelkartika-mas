<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLogin(Request $request): View
    {
        // Simpan intended URL ke session jika ada parameter redirect
        if ($request->has('redirect')) {
            session(['url.intended' => $request->get('redirect')]);
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Cek apakah ada intended URL
            $intendedUrl = $request->session()->pull('url.intended');

            // Jika user adalah admin
            if (Auth::user()->is_admin) {
                // Redirect admin ke intended url, atau ke dashboard jika intended url bukan admin
                if (!$intendedUrl || !str_contains($intendedUrl, '/admin')) {
                    return redirect($intendedUrl ?? route('admin.dashboard'))->with('success', 'Login berhasil!');
                }
                return redirect($intendedUrl)->with('success', 'Login berhasil!');
            }

            // User biasa (Jamaah)
            // Jika intended URL adalah halaman admin, paksa ke home
            if ($intendedUrl && str_contains($intendedUrl, '/admin')) {
                return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang di Travelkartika Mas.');
            }

            // Redirect biasa ke intended url atau home
            return redirect($intendedUrl ?? route('home'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'no_hp'    => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'no_hp'    => $validated['no_hp'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Logout berhasil!');
    }
}

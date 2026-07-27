<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => __('Kredensial yang diberikan tidak cocok dengan data kami.'),
            ]);
        }

        $user = Auth::user();
        $isAdmin = false;

        if ($user) {
            if (method_exists($user, 'isAdmin')) {
                $isAdmin = (bool) $user->isAdmin();
            } elseif (isset($user->is_admin)) {
                $isAdmin = (bool) $user->is_admin;
            } elseif (isset($user->role)) {
                $isAdmin = ($user->role === 'admin');
            }
        }

        if (! $isAdmin) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => __('Akun Anda tidak memiliki akses admin.'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

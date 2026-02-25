<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.home');
        }

        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $validated = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($validated)) {
            return redirect()->back()->with(['error' => 'Email atau password yang anda masukkan salah.']);
        }

        $user = Auth::user();

        if ($user->role === 'customer') {
            return $this->logout($request);
        }

        return redirect()->route('dashboard.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

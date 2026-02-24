<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
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

        if ($user->role !== 'superadmin') {
            return $this->logout();
        }

        return redirect()->route('dashboard.home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

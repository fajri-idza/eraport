<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class GuruAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('guru')->check()) {
            return redirect('/guru/dashboard');
        }
        return view('auth.guru-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('guru')->attempt($credentials)) {
            return redirect()->intended('/guru/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::guard('guru')->logout();
        return redirect('/guru/login');
    }
}

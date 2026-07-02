<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // SHOW LOGIN PAGE
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // LOGIN FUNCTION
public function login(Request $request)
{
    $credentials = [
        'email' => trim($request->email),
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        return redirect('/login');
    }

    return back()->withErrors([
        'login' => 'Invalid email or password.',
    ]);
}
    // LOGOUT FUNCTION
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
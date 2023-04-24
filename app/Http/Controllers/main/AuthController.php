<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('main.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            if (Auth::user()->status === 'Admin')
                return redirect()->intended('/admin');
            elseif (Auth::user()->status === 'Supervisor')
                return redirect()->intended('/supervisor');
            elseif (Auth::user()->status === 'Student')
                return redirect()->intended('/student/presences');
        }

        return back()->with('auth', 'Username atau Password Salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

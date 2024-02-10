<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;




class AuthController extends Controller
{
    public function login()
    {
        return view('loginView');
    }

    public function authenticating(Request $request)
    {


        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) { //letak kesalahan

            $request->session()->regenerate();
            return redirect('/rumpi.com/home');
        }
        
        session()->put('status', 'gagal');
        session()->put('message', 'Login Gagal');
        return view('loginView');
        
    }

    public function logout(Request $request)
    { //dd('logout');
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('admin.session.login-session');

    }

    // public function store()
    // {
    //     $attributes = request()->validate([
    //         'email'=>'required|email',
    //         'password'=>'required'
    //     ]);

    //     if(Auth::attempt($attributes))
    //     {
    //         session()->regenerate();
    //         return redirect('dashboard')->with(['success'=>'You are logged in.']);
    //     }
    //     else{

    //         return back()->withErrors(['email'=>'Email or password invalid.']);
    //     }
    // }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            // 🔀 Redirect berdasarkan role
            return auth()->user()->is_admin
                ? redirect()->intended('/dashboard') // Admin
                : redirect()->intended('/menu');     // Customer
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }



    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}

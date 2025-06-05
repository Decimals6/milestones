<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('admin.session.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email|max:45|unique:users',
            'password' => 'required|min:6',
            'address' => 'required|max:45',
            'phone' => 'nullable|max:15',
            'agreement' => 'accepted'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'is_admin' => false
        ]);

        auth()->login($user);

        return redirect('/menu');
    }


}

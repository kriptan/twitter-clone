<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(){

        // In form if the password name is password, then confirm name is password_confirmation, in built in laravel it will check if both are same
        $validated = request()->validate([
            'name' =>'required|min:3|max:50',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3|max:255',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }
}

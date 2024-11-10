<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        // In form if the password name is password, then confirm name is password_confirmation, in built in laravel it will check if both are same
        $validated = request()->validate([
            'name' =>'required|min:3|max:50',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);
        // Send the email
        // https://mailtrap.io/
        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validated = request()->validate([
            'email' =>'required|email',
            'password' => 'required|min:3|max:255',
        ]);

        if (auth()->attempt($validated)) {
            // clear the sessions of previos user
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'User logged in successfully.');
        } else {
            return redirect()->route('login')->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', 'User logged out successfully.');
    }
}

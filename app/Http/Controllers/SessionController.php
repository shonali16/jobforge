<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{
    public function create()
    {
        Log::info('Login page accessed');
        return view('auth.login');
    }

    public function store()
    {
        Log::info('Login attempt', ['email' => request('email')]);

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            Log::warning('Login failed', ['email' => request('email')]);
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        request()->session()->regenerate(); 

        Log::info('User logged in successfully', ['user_id' => Auth::id()]);
        return redirect('/');
    }

    public function destroy()
    {
        $user_id = Auth::id();
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Log::info('User logged out', ['user_id' => $user_id]);
        return redirect('/');
    }
}

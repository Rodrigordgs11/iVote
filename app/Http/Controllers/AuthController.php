<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $customMessages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email field must not exceed :max characters.',
            'email.unique' => 'The email address is already taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'phone_number.required' => 'The phone field is required.',
            'phone_number.max' => 'The phone field must not exceed :max characters.',
            'phone_number.unique' => 'The phone number already exists.',
        ];

        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users'],
        ], $customMessages);

        $user = \App\Models\User::factory()->create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'phone_number' => $credentials['phone_number'],
            'user_type' => 'User',
        ]);

        return redirect()->route('login')->with('success', 'Login with success!');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'result' => 'The provided credentials do not match our records.',
        ])->onlyInput('result');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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

        User::create([
            'id' => Uuid::uuid4(),
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'phone_number' => $credentials['phone_number'],
            'user_type' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Register with success!');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $customMessages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email field must not exceed :max characters.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ];

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ], $customMessages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->user_type === 'admin') return redirect()->route('dashboard');
            else return redirect()->route('home'); 
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

    public function verifyEmail(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? redirect()->route('login')->with('success', 'An email has been sent to you!')
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'confirm-password', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password reseted with success!')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
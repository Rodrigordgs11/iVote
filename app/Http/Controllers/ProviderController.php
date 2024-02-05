<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        try {
            $SocialUser = Socialite::driver($provider)->user();
            if(User::where('email', $SocialUser->email)->whereNull('provider_id')->exists()) {
                return redirect()->route('login')->with(['erros' => 'This email is already taken. Please login with your email and password.']);
            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $SocialUser->id,
            ])->first();

            if(!$user) {
                $user = User::create([
                    'name' => $SocialUser->name,
                    'email' => $SocialUser->email,
                    'password' => bcrypt(Str::random(8)),
                    'user_type' => 'user',
                    'provider' => $provider,
                    'provider_id' => $SocialUser->id,
                    'provider_token' => $SocialUser->token,
                    'provider_refresh_token' => $SocialUser->refreshToken,
                ]);
            }

            Auth::login($user);   
            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong with your ' . $provider . ' login. Please try again.');
        }
    }
}
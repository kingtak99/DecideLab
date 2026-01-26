<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User exists, log them in
                Auth::login($user);

                $request->session()->regenerate();
            } else {
                // User doesn't exist, create a new one
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Random password since they won't use it
                    'email_verified_at' => now(), // Google accounts are pre-verified
                ]);

                Auth::login($user);

                $request->session()->regenerate();
            }

            // Redirect to localized home page
            $locale = session('locale', config('app.locale', 'ar'));
            return redirect("/{$locale}");
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Unable to login with Google. Please try again.']);
        }
    }
}
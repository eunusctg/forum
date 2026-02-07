<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(['email' => $socialUser->getEmail()], [
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'username' => str($socialUser->getNickname() ?? $socialUser->getName())->slug() . rand(100, 999),
            'password' => bcrypt(str()->random(48)),
            'social_accounts' => [$provider => $socialUser->getId()],
            'email_verified_at' => now(),
        ]);

        Auth::login($user, true);

        return redirect()->route('home');
    }
}

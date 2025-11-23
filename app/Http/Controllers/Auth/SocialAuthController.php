<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to the provider's authentication page
     */
    public function redirect($provider)
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle the provider's callback
     */
    public function callback($provider)
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }

        // Find or create user (bypass barangay scope for social auth lookup)
        $user = User::allBarangays()
            ->where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (!$user) {
            // Check if user exists with same email (bypass scope)
            $user = User::allBarangays()
                ->where('email', $socialUser->getEmail())
                ->first();

            if ($user) {
                // Link social account to existing user
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                // Create new user
                $name = $socialUser->getName() ?? $socialUser->getNickname();
                if (!$name && $socialUser->getEmail()) {
                    $name = explode('@', $socialUser->getEmail())[0];
                }
                $name = $name ?? 'User';
                
                $user = User::create([
                    'name' => $name,
                    'email' => $socialUser->getEmail() ?? $socialUser->getId() . '@' . $provider . '.local',
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'password' => null, // Social auth users don't need password
                    'email_verified_at' => now(), // Social providers verify emails
                ]);

                // Assign default role
                $user->assignRole('anonymous');
            }
        } else {
            // Update avatar in case it changed
            if ($socialUser->getAvatar()) {
                $user->update(['avatar' => $socialUser->getAvatar()]);
            }
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard', absolute: true));
    }

    /**
     * Validate that the provider is supported
     */
    protected function validateProvider($provider)
    {
        $allowedProviders = ['facebook', 'google', 'apple'];
        
        if (!in_array($provider, $allowedProviders)) {
            abort(404, 'Provider not supported');
        }
    }
}

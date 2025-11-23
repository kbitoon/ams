<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Bypass barangay scope during authentication to find user by email/password
        $user = \App\Models\User::allBarangays()
            ->where('email', $this->email)
            ->first();

        // Verify password if user exists
        if (!$user || !\Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'),
            ]);
        }

        // Check if user belongs to current barangay (if BARANGAY_ID is set)
        $currentBarangayId = \App\Services\BarangayService::getCurrentBarangayId();
        if ($currentBarangayId) {
            // If user has no barangay_id, assign them to current barangay
            if (empty($user->barangay_id)) {
                $user->barangay_id = $currentBarangayId;
                $user->save();
            } elseif ($user->barangay_id != $currentBarangayId) {
                // User belongs to different barangay
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'form.email' => trans('auth.failed'),
                ]);
            }
        } else {
            // If BARANGAY_ID is not set, assign user to NULL or first barangay
            // This handles backward compatibility
            if (empty($user->barangay_id)) {
                // Keep barangay_id as NULL for backward compatibility
            }
        }

        // Log the user in
        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}

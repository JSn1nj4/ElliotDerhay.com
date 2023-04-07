<?php

namespace App\Http\Requests\Auth;

use App\Features\AdminLogin;
use App\Models\Lockout;
use Illuminate\Auth\Events\Lockout as LockoutEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Pennant\Feature;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
		if (Feature::inactive(AdminLogin::class)) $this->throwDefault();

		$this->checkIfShouldLockOut();

		$this->ensureIsNotLockedOut();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
			sleep(3);

            RateLimiter::hit($this->throttleKey());

            $this->throwDefault();
        }

        RateLimiter::clear($this->throttleKey());
    }

	/**
	 * @return void
	 * @throws ValidationException
	 */
	public function ensureIsNotLockedOut(): void
	{
		if(!Lockout::whereIpAddress($this->ip())->exists()) return;

		sleep(3);

		$this->throwDefault();
	}

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkIfShouldLockOut(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new LockoutEvent($this));
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }

	/**
	 * Throw the default ValidationException
	 * @return void
	 * @throws ValidationException
	 */
	private function throwDefault(): void
	{
		throw ValidationException::withMessages([
			'email' => trans('auth.failed'),
		]);
	}
}

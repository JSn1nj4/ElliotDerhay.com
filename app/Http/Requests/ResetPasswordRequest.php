<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

/**
 * @property-read string $email
 * @property-read string $password
 * @property-read string $token
 */
class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'token' => ['required'],
			'email' => ['required', 'email'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandRequest extends FormRequest
{
    public function authorize(): bool
    {
		return User::whereId(\Auth::id())->exists();
    }

    public function rules(): array
    {
        return [
            'signature' => [
				'required',
				'string',
				'unique:commands,signature,'.$this->command->id,
			],
			'description' => [
				'required',
				'string',
			],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCommandRequest extends FormRequest
{
    public function authorize(): bool
    {
		return Gate::has('admin');
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

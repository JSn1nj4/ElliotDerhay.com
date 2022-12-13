<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\CommandAllowed;
use Illuminate\Foundation\Http\FormRequest;

class RunCommandRequest extends FormRequest
{
	private array $whitelist = [
		'github:event:prune',
		'github:event:pull',
		'github:user:update',
		'token:prune',
		'tweet:prune',
		'tweet:pull',
		'twitter:user:update',
	];

    public function authorize(): bool
    {
		return User::whereId(\Auth::id())->exists();
    }

	public function messages(): array
	{
		return array_merge(parent::messages(), [
			'command.exists' => sprintf(trans('commands.run_failed'), $this->signature),
		]);
	}

	public function rules(): array
    {
        return [
            'command' => [
				'required',
				'string',
				'exists:App\Models\Command,signature',
				new CommandAllowed($this->whitelist),
			],
        ];
    }
}

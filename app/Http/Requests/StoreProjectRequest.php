<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::whereId(\Auth::id())->exists();
    }

	/**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => File::image()->max(5 * 1024),
			'name' => [
				'required',
				'max:180',
			],
			'link' => [
				'required',
				'unique:projects',
				'max:2048',
			],
			'demo_link' => [
				'unique:projects',
				'max:2048',
			],
			'short_desc' => 'required',
        ];
    }
}

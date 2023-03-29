<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
		return Gate::has('admin');
    }

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
				'url',
				'unique:projects',
				'max:2048',
			],
			'demo_link' => [
				'nullable',
				'url',
				Rule::unique('projects')->whereNotNull('demo_link'),
				'max:2048',
			],
			'short_desc' => 'required',
        ];
    }
}

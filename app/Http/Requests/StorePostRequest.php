<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::has('admin');
    }

	public function prepareForValidation(): void
	{
		$this->merge([
			'slug' => Str::slug($this->slug ?? $this->title),
		]);
	}

    public function rules(): array
    {
        return [
			'cover_image' => File::image()->max(5 * 1024),
            'title' => [
				'required',
				'max:180',
			],
			'slug' => [
				'required',
				'unique:posts',
				'max:180',
			],
			'body' => 'required',
        ];
    }
}

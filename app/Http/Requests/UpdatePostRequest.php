<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdatePostRequest extends FormRequest
{
	public function authorize(): bool
	{
		return Gate::has('admin');
	}

	public function prepareForValidation(): void
	{
		$this->merge([
			'slug' => Str::slug($this->slug ?? $this->title ?? ''),
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
				Rule::unique('posts')
					->whereNotNull('slug')
					->ignore($this->post->id),
				'max:180',
			],
			'body' => 'required',
		];
	}
}

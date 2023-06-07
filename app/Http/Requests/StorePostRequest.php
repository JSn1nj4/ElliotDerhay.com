<?php

namespace App\Http\Requests;

use App\Traits\CanSanitizeInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

/**
 * @property string $tags
 * @property string $title
 * @property string $slug
 */
class StorePostRequest extends FormRequest {
	use CanSanitizeInputs;

	public function authorize(): bool
	{
		return Gate::has('admin');
	}

	public function prepareForValidation(): void
	{
		$this->merge([
			// 'categories' => $this->sanitize($this->categories ?? ''),
			'slug' => Str::slug($this->slug ?? $this->title ?? ''),
			'tags' => $this->sanitize($this->tags ?? ''),
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
			'search_title' => 'max:180',
			'search_description' => 'max:250',
			'slug' => [
				'required',
				'unique:posts',
				'max:180',
			],
			'body' => 'required',
			// 'categories' => 'string',
			'tags' => 'string',
		];
	}
}

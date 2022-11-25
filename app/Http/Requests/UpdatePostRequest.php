<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
{
	public function authorize()
	{
		return User::whereId(\Auth::id())->exists();
	}

	public function prepareForValidation()
	{
		$this->merge([
			'slug' => Str::slug($this->slug ?? $this->title),
		]);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'cover_image' => 'string',
			'title' => [
				'required',
				'max:180',
			],
			'slug' => [
				'required',
				'unique:posts,slug,'.$this->post->id,
				'max:180',
			],
			'body' => 'required',
		];
	}
}

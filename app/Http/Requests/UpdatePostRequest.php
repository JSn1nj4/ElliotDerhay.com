<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
	public function authorize()
	{
		return User::whereId(\Auth::id())->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'cover_image' => 'optional',
			'title' => [
				'required',
				'max:180',
			],
			'slug' => [
				'unique:posts,slug,'.$this->post->id,
				'max:180',
			],
			'body' => 'required',
		];
	}
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * @property \App\Models\Post $post
 */
class UpdatePostRequest extends StorePostRequest
{
	public function rules(): array
	{
		return [...parent::rules(), 'slug' => [
			'required',
			Rule::unique('posts')
				->whereNotNull('slug')
				->ignore($this->post->id),
			'max:180',
		]];
	}
}

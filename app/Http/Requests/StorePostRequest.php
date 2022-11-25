<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
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
				'unique:posts',
				'max:180',
			],
			'body' => 'required',
        ];
    }
}
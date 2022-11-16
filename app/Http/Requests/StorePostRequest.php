<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

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

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'thumbnail' => 'string',
			'name' => [
				'required',
				'max:180',
			],
			'link' => [
				'required',
				'unique:projects,link,'.$this->project->id,
				'max:2048',
			],
			'demo_link' => [
				'unique:projects,demo_link,'.$this->project->id,
				'max:2048',
			],
			'short_desc' => 'required',
        ];
    }
}

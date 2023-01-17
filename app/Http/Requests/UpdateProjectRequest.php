<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;

class UpdateProjectRequest extends FormRequest
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

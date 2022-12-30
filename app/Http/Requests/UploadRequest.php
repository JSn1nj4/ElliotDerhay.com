<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class UploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::has('upload-files');
    }

    public function rules(): array
    {
        return [
			'file' => [
				'required',
				File::types(['png', 'jpg'])->max(5 * 1024),
			],
		];
    }
}

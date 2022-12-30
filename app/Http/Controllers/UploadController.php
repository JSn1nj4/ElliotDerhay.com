<?php

namespace App\Http\Controllers;

use App\Contracts\UploadServiceContract;
use App\Http\Requests\UploadRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UploadController extends Controller
{
	public function __construct(
		private readonly UploadServiceContract $service,
	) {}

	public function __invoke(UploadRequest $request): Response|RedirectResponse
    {
		Media::create($this->service
			->image($request->validated('file'))
			->toArray());

		return back();
    }
}

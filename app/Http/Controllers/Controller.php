<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function dispatchIf(bool $condition, ShouldQueue $job)
	{
		return $condition ? $this->dispatch($job) : false;
	}

	public function dispatchSyncIf(bool $condition, ShouldQueue $job)
	{
		return $condition ? $this->dispatchSync($job) : false;
	}
}

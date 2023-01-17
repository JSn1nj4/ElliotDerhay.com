<?php

namespace App\Http\Controllers;

use App\Jobs\BaseQueueableJob;
use App\Jobs\BaseSyncJob;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function dispatchIf(bool $condition, BaseQueueableJob|BaseSyncJob $job)
	{
		return $condition ? $this->dispatch($job) : false;
	}

	public function dispatchSyncIf(bool $condition, BaseQueueableJob|BaseSyncJob $job)
	{
		return $condition ? $this->dispatchSync($job) : false;
	}
}

<?php

namespace App\Jobs;

use App\DataTransferObjects\SocialPostDTO;
use App\Services\XService;

class PostToXJob extends BaseQueueableJob
{
	/**
	 * Create a new job instance.
	 */
	public function __construct(public SocialPostDTO $dto)
	{
		//
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$x = app(XService::class);

		$result = $x->post($this->dto);

		if (!$result->succeeded) $this->fail($result->message);
	}
}

<?php

namespace App\Jobs;

use App\Models\LoginActivity;
use Illuminate\Foundation\Bus\Dispatchable;

class LoginSucceeded
{
	use Dispatchable;

	/**
	 * Create a new job instance.
	 */
	public function __construct(
		#[\SensitiveParameter] public readonly string $email,
		#[\SensitiveParameter] public readonly string $ip_address,
	) {}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		LoginActivity::create([
			'email' => $this->email,
			'succeeded' => true,
			'ip_address' => $this->ip_address,
		]);
	}
}

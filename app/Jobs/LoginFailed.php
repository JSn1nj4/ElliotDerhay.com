<?php

namespace App\Jobs;

use App\Models\LoginActivity;
use Illuminate\Foundation\Bus\Dispatchable;

class LoginFailed
{
	use Dispatchable;

	/**
	 * Create a new job instance.
	 */
	public function __construct(
		#[\SensitiveParameter] public readonly string $email,
		public readonly string|null                   $info,
		#[\SensitiveParameter] public readonly string $ip_address,
	) {}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		LoginActivity::create([
			'email' => $this->email,
			'succeeded' => false,
			'info' => $this->info,
			'ip_address' => $this->ip_address,
		]);
	}
}

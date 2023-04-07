<?php

namespace App\Console\Commands;

use App\Events\AdminLoginFeatureStatusEvent;
use App\Features\AdminLogin;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class AdminLoginFeatureStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:login_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status of admin login feature.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
		$message = match (Feature::active(AdminLogin::class)) {
			true => "The admin login feature is currently enabled.",
			false => "The admin login feature is currently disabled.",
		};

		$this->info($message);

		AdminLoginFeatureStatusEvent::dispatch(self::SUCCESS, $message);

		return self::SUCCESS;
    }
}

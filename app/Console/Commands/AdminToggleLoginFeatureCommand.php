<?php

namespace App\Console\Commands;

use App\Events\AdminLoginFeatureToggleEvent;
use App\Features\AdminLogin;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class AdminToggleLoginFeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:toggle_login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Turn login feature on or off.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Feature::toggleForEveryone(AdminLogin::class);

		$message = match (Feature::active(AdminLogin::class)) {
			true => "Admin login feature activated",
			false => "Admin login feature deactivated",
		};

		$this->info($message);

		AdminLoginFeatureToggleEvent::dispatch(self::SUCCESS, $message);

		return self::SUCCESS;
    }
}

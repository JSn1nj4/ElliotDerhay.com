<?php

namespace App\Console\Commands;

use App\Events\GithubFeatureStatusEvent;
use App\Features\GithubFeed;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class GithubFeatureStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:feature_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check GitHub feed feature status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $message = match (Feature::active(GithubFeed::class)) {
			true => 'The GitHub feed feature is enabled.',
			false => 'The GitHub feed feature is disabled.',
		};

		$this->info($message);

		GithubFeatureStatusEvent::dispatch(self::SUCCESS, $message);
    }
}

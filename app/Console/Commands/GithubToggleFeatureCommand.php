<?php

namespace App\Console\Commands;

use App\Events\GithubToggleFeatureEvent;
use App\Features\GithubFeed;
use App\Providers\FeatureServiceProvider;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class GithubToggleFeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:toggle_feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toggle the GitHub feed feature';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Feature::toggleForEveryone(GithubFeed::class);

		$message = match (Feature::active(GithubFeed::class)) {
			true => 'Github feed feature activated',
			false => 'Github feed feature deactivated',
		};

		$this->info($message);

		GithubToggleFeatureEvent::dispatch(self::SUCCESS, $message);
    }
}

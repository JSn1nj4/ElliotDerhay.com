<?php

namespace App\Console\Commands;

use App\Events\TwitterToggleFeatureEvent;
use App\Features\TwitterFeed;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class TwitterToggleFeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:toggle_feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually toggle the TwitterFeed feature on and off.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Feature::toggle(TwitterFeed::class);

		$message = match (Feature::inactive(TwitterFeed::class)) {
			true => "TwitterFeed feature deactivated",
			false => "TwitterFeed feature activated",
		};

		$this->info($message);

		TwitterToggleFeatureEvent::dispatch(self::SUCCESS, $message);

		return self::SUCCESS;
    }
}

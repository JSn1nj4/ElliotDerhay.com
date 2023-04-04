<?php

namespace App\Console\Commands;

use App\Events\TwitterFeatureStatusEvent;
use App\Features\TwitterFeed;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class TwitterFeatureStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:feature_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status of TwitterFeed feature';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
		$message = match (Feature::inactive(TwitterFeed::class)) {
			true => "The TwitterFeed feature is currently disabled.",
			false => "The TwitterFeed feature is currently enabled.",
		};

		$this->info($message);

		TwitterFeatureStatusEvent::dispatch(self::SUCCESS, $message);

		return self::SUCCESS;
    }
}

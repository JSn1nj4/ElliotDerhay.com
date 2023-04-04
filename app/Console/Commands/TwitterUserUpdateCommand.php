<?php

namespace App\Console\Commands;

use App\DataTransferObjects\TwitterUserDTO;
use App\Enums\CreateMode;
use App\Events\TwitterUsersUpdatedEvent;
use App\Features\TwitterFeed;
use App\Models\TwitterUser;
use App\Services\Twitter\TwitterService;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class TwitterUserUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stored Twitter user data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TwitterService $twitter): int
    {
		if (Feature::inactive(TwitterFeed::class)) {
			$this->error("The TwitterFeed feature is currently disabled.");

			TwitterUsersUpdatedEvent::dispatch(self::FAILURE, "TwitterFeed feature is disabled.");

			return self::FAILURE;
		}

		$this->info("Finding users...");

		$users = TwitterUser::all();

		$this->info("Fetching fresh user data...");

		$twitter->getUsers($users)
			->each(fn (TwitterUserDTO $dto): TwitterUser => TwitterUser::fromDTO($dto, CreateMode::UpdateOrCreate));

		$this->info("Twitter users updated!");

		TwitterUsersUpdatedEvent::dispatch(self::SUCCESS);

        return self::SUCCESS;
    }
}

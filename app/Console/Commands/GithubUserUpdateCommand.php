<?php

namespace App\Console\Commands;

use App\DataTransferObjects\GithubUserDTO;
use App\Enums\CreateMode;
use App\Events\GithubUsersUpdatedEvent;
use App\Features\GithubFeed;
use App\Models\GithubUser;
use App\Services\Github\GithubService;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class GithubUserUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update local copy of GitHub user data.';

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
    public function handle(GithubService $github): int
	{
		if (Feature::inactive(GithubFeed::class)) {
			$this->error("The GitHub feed feature is currently disabled.");

			GithubUsersUpdatedEvent::dispatch(self::FAILURE, "GitHub feed feature is disabled.");

			return self::FAILURE;
		}

		$this->info("Finding users...");

		$users = GithubUser::all();

		$this->info("Fetching fresh user data...");

		$github->getUsers($users)
		->each(fn (GithubUserDTO $dto): GithubUser => GithubUser::fromDTO($dto, CreateMode::UpdateOrCreate));

		$this->info("GitHub users updated!");

		GithubUsersUpdatedEvent::dispatch(self::SUCCESS);

		return self::SUCCESS;
    }
}

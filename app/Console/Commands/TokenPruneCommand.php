<?php

namespace App\Console\Commands;

use App\Events\TokensPrunedEvent;
use App\Models\Token;
use Illuminate\Console\Command;

class TokenPruneCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'token:prune';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete all expired tokens.';

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
	public function handle()
	{
		Token::expired()->delete();

		TokensPrunedEvent::dispatch(self::SUCCESS);

		return self::SUCCESS;
	}
}

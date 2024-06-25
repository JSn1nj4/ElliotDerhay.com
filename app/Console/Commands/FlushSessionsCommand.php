<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Largely based on this SO answer: https://stackoverflow.com/a/58881919/3470278
 */
class FlushSessionsCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'session:flush';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Flush all login sessions.';

	/**
	 * Execute the console command.
	 */
	public function handle(): int
	{
		$return = match (config('session.driver')) {
			'file' => $this->flushSessionsFolder(),
			default => $this->flushSessionsTable(),
		};

		$this->info('Sessions cleared!');

		return $return;
	}

	private function flushSessionsFolder(): int
	{
		$this->info('Clearing session storage.');

		$ignore = ['.gitignore', '.', '..'];

		$disk = Storage::build([
			'driver' => 'local',
			'root' => storage_path('framework/sessions'),
		]);

		collect($disk->allFiles())
			->reject(static fn ($item) => in_array($item, $ignore))
			->each(static fn ($item) => $disk->delete($item));

		return self::SUCCESS;
	}

	private function flushSessionsTable(): int
	{
		$this->info("Clearing sessions table.");

		$ids = DB::table(config('session.table'))
			->select('user_id')
			->distinct()
			->whereNotNull('user_id')
			->get()
			->map(static fn ($item) => $item->user_id);

		User::whereIn('id', $ids)->update(['remember_token' => null]);

		DB::table(config('session.table'))->truncate();

		return self::SUCCESS;
	}
}

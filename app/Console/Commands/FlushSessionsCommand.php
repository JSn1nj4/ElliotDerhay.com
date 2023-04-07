<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
		return $this->{match (config('session.driver')) {
			default => 'flushSessionsFolder',
		}}();
    }

	private function flushSessionsFolder(): int
	{
		$this->info('Clearing session storage.');

		$ignore = ['.gitignore', '.', '..'];

		collect(Storage::disk('sessions')->allFiles())
			->reject(fn ($item) => in_array($item, $ignore))
			->each(fn ($item) => Storage::disk('sessions')->delete($item));

		$this->info('Sessions cleared!');

		return self::SUCCESS;
	}
}

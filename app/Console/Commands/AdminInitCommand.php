<?php

namespace App\Console\Commands;

use App\Actions\HashPassword;
use App\Models\User;
use Illuminate\Console\Command;

class AdminInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:init {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(HashPassword $hashPassword): int
    {
		if (User::limit(1)->exists()) {
			$this->error("An admin user exists already. Please update that user instead of running 'admin:init'.");
			return self::FAILURE;
		}

		$user = User::create([
			'name' => $this->argument('name'),
			'email' => $this->argument('email'),
			'password' => $hashPassword($this->argument('password')),
		]);

		$this->info("Admin user created for email '{$user->email}'.");

        return self::SUCCESS;
    }
}

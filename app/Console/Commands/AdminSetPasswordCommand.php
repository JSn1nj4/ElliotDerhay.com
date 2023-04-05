<?php

namespace App\Console\Commands;

use App\Actions\HashPassword;
use App\Events\AdminSetPasswordEvent;
use App\Models\User;
use Illuminate\Console\Command;

class AdminSetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:set_password {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the admin password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(HashPassword $hashPassword): int
    {
        if (User::limit(1)->doesntExist()) {
			$this->error('Admin user does not exist. Run `admin:init` to configure admin user.');

			AdminSetPasswordEvent::dispatch(self::FAILURE, "Admin user did not exist.");

			return self::FAILURE;
		}

		$user = User::first();

		$user->update([
			'password' => $hashPassword($this->argument('password')),
		]);

		$this->info("Password reset for admin user with email '{$user->email}'.");

		AdminSetPasswordEvent::dispatch(self::SUCCESS);

		return self::SUCCESS;
    }
}

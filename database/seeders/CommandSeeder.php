<?php

namespace Database\Seeders;

use App\Models\Command;
use Illuminate\Database\Seeder;

class CommandSeeder extends Seeder
{
	private array $commands = [
		[
			'signature' => 'admin:init',
			'description' => 'Initialize admin login'
		],
		[
			'signature' => 'admin:login_status',
			'description' => 'Check status of the admin login feature'
		],
		[
			'signature' => 'admin:reset_password',
			'description' => 'Reset the admin password'
		],
		[
			'signature' => 'admin:toggle_login',
			'description' => 'Turn the admin login feature on or off'
		],
		[
			'signature' => 'github:event:prune',
			'description' => 'Prune old GitHub events'
		],
		[
			'signature' => 'github:event:pull',
			'description' => 'Fetch latest GitHub activity'
		],
		[
			'signature' => 'github:toggle_feature',
			'description' => 'Toggle the GitHub feed feature'
		],
		[
			'signature' => 'github:feature_status',
			'description' => 'Check status of the GitHub feed feature'
		],
		[
			'signature' => 'github:user:update',
			'description' => 'Update saved GitHub user data'
		],
		[
			'signature' => 'token:prune',
			'description' => 'Prune old tokens'
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		foreach ($this->commands as $command) {
			if (Command::where('signature', $command['signature'])->exists()) {
				continue;
			}

			Command::create($command);
		}
	}
}

<?php

namespace Database\Seeders;

use App\Models\Command;
use Illuminate\Database\Seeder;

class CommandSeeder extends Seeder
{
	private array $commands = [
		[
			'signature' => 'github:event:prune',
			'description' => 'Prune old GitHub events'
		],
		[
			'signature' => 'github:event:pull',
			'description' => 'Fetch latest GitHub activity'
		],
		[
			'signature' => 'github:user:update',
			'description' => 'Update saved GitHub user data'
		],
		[
			'signature' => 'token:prune',
			'description' => 'Prune old tokens'
		],
		[
			'signature' => 'tweet:prune',
			'description' => 'Prune old tweets'
		],
		[
			'signature' => 'tweet:pull',
			'description' => 'Fetch latest tweets'
		],
		[
			'signature' => 'twitter:user:update',
			'description' => 'Update saved Twitter user data'
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
	{
        foreach($this->commands as $command) {
			if(Command::where('signature', $command['signature'])->exists()) {
				continue;
			}

			Command::create($command);
		}
    }
}

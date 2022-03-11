<?php

namespace App\Providers;

use App\Actions\CreateTweetDTO;
use App\Actions\CreateTwitterUserDTO;
use App\Contracts\Actions\CreatesTweetDTO;
use App\Contracts\Actions\CreatesTwitterUserDTO;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
	public array $bindings = [
			CreatesTweetDTO::class => CreateTweetDTO::class,
			CreatesTwitterUserDTO::class => CreateTwitterUserDTO::class,
	];
}

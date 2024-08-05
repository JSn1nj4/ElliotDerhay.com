<?php

namespace App\Filament\Widgets;

use App\Models\LoginActivity;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class LastLoginWidget extends Widget
{
	protected int|string|array $columnSpan = 2;

	protected static string $view = 'filament.widgets.last-login-widget';

	public readonly Carbon $time;
	public readonly string $ip_address;

	public function mount()
	{
		$latest = LoginActivity::succeeded()->latest()->first();

		$this->time = $latest->created_at;
		$this->ip_address = $latest->ip_address;
	}
}

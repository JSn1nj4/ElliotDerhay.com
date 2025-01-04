<?php

namespace App\Filament\Widgets;

use App\DataTransferObjects\MastodonInstanceInfo;
use App\Enums\OauthConnectionHealth;
use Filament\Widgets\Widget;

class MastodonConnectionWidget extends Widget
{
	protected static string $view = 'filament.widgets.mastodon-connection-widget';

	protected function getViewData(): array
	{
		/** @var MastodonInstanceInfo $info */
		$info = resolve(MastodonInstanceInfo::class);

		return [
			'server' => $info->domain,
			'health' => OauthConnectionHealth::Expired,
		];
	}
}

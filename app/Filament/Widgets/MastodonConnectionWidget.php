<?php

namespace App\Filament\Widgets;

use App\DataTransferObjects\MastodonInstanceInfo;
use App\Enums\OauthConnectionHealth;
use App\Models\Token;
use Filament\Widgets\Widget;

class MastodonConnectionWidget extends Widget
{
	protected static string $view = 'filament.widgets.mastodon-connection-widget';

	protected function checkConnectionHealth(): OauthConnectionHealth
	{
		$token = Token::mastodon()->first();

		return match (true) {
			$token === null => OauthConnectionHealth::Expired, // nothing found
			$token->doesntExist() => OauthConnectionHealth::Expired, // scope covers 'expired'
			$token->expiresSoon() => OauthConnectionHealth::ExpiringSoon,
			default => OauthConnectionHealth::Good,
		};
	}

	protected function getViewData(): array
	{
		/** @var MastodonInstanceInfo $info */
		$info = resolve(MastodonInstanceInfo::class);

		return [
			'server' => $info->domain,
			'health' => $this->checkConnectionHealth(),
		];
	}
}

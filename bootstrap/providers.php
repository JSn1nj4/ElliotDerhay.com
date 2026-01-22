<?php

return [
	App\Providers\AppServiceProvider::class,
	App\Providers\AuthServiceProvider::class,
	App\Providers\EventServiceProvider::class,
	App\Providers\FeatureServiceProvider::class,
	App\Providers\Filament\AdminPanelProvider::class,
	App\Providers\NavigationProvider::class,
	\Mailjet\LaravelMailjet\MailjetServiceProvider::class,
];

<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

	'name' => env('APP_NAME', 'Laravel'),

	/*
	|--------------------------------------------------------------------------
	| Application Environment
	|--------------------------------------------------------------------------
	|
	| This value determines the "environment" your application is currently
	| running in. This may determine how you prefer to configure various
	| services the application utilizes. Set this in your ".env" file.
	|
	*/

	'env' => env('APP_ENV', 'production'),

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => (bool)env('APP_DEBUG', false),

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => env('APP_URL', 'http://localhost'),

	'asset_url' => env('ASSET_URL', null),

	/*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

	'timezone' => env('APP_TIMEZONE', 'UTC'),

	/*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

	'locale' => env('APP_LOCALE', 'en'),

	'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

	'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

	/*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

	'cipher' => 'AES-256-CBC',

	'key' => env('APP_KEY'),

	'previous_keys' => [
		...array_filter(
			explode(',', env('APP_PREVIOUS_KEYS', ''))
		),
	],

	/*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

	'maintenance' => [
		'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
		'store' => env('APP_MAINTENANCE_STORE', 'database'),
	],

	/*
	|--------------------------------------------------------------------------
	| Admin Command Settings
	|--------------------------------------------------------------------------
	|
	| Define settings related to manually running commands in the admin panel.
	|
	*/
	'commands' => [
		'whitelist' => array_map(
			'trim',
			array_values(explode(',', env('COMMANDS_WHITELIST', '')))
		),
	],

	/*
	|--------------------------------------------------------------------------
	| Schedule settings
	|--------------------------------------------------------------------------
	|
	| Define settings job and command scheduling.
	|
	*/

	'schedule' => [
		'default' => [
			'daily_time' => env('SCHEDULE_DEFAULT_DAILY_TIME', '0:0'),
			'weekly_time' => env('SCHEDULE_DEFAULT_WEEKLY_TIME', '0:0'),
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Upload Settings
	|--------------------------------------------------------------------------
	|
	| Define custom upload-related settings here.
	|
	*/
	'uploads' => [
		'disk' => env('UPLOAD_DISK', 'local'),
		'temp' => env('UPLOAD_TEMP_DISK', 'temp'),
		'hash' => env('UPLOAD_FILE_HASH', 'md5'),
	],

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => \Illuminate\Support\Facades\Facade::defaultAliases()->merge([
		'Mailjet' => \Mailjet\LaravelMailjet\Facades\Mailjet::class,
	])->toArray(),
];

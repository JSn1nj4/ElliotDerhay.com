<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

	'default' => env('FILESYSTEM_DISK', 'local'),

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	|
	| Below you may configure as many filesystem disks as necessary, and you
	| may even configure multiple disks for the same driver. Examples for
	| most supported storage drivers are configured here for reference.
	|
	| Supported Drivers: "local", "ftp", "sftp", "s3"
	|
	*/

	'disks' => [

		'local' => [
			'driver' => 'local',
			'root' => storage_path('app'),
			'throw' => false,
		],

		'debug' => [
			'driver' => 'local',
			'root' => storage_path('app/debug'),
		],

		'public' => [
			'driver' => 'local',
			'root' => storage_path('app/public'),
			'url' => env('APP_URL') . '/storage',
			'visibility' => 'public',
			'throw' => false,
		],

		'public-cache' => [
			'driver' => 'scoped',
			'disk' => 'public',
			'prefix' => 'cache',
		],

		'temp' => [
			'driver' => 'scoped',
			'disk' => 'local',
			'prefix' => 'temp',
		],

		's3' => [
			'driver' => 's3',
			'key' => env('AWS_ACCESS_KEY_ID'),
			'secret' => env('AWS_SECRET_ACCESS_KEY'),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => env('AWS_URL'),
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
			'throw' => false,
		],

		's3-assets' => [
			'driver' => 'scoped',
			'disk' => 's3',
			'prefix' => 'assets',
		],

		's3-uploads' => [
			'driver' => 'scoped',
			'disk' => 's3',
			'prefix' => 'uploads',
		],

	],

	/*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

	'links' => [
		public_path('storage') => storage_path('app/public'),
	],

];

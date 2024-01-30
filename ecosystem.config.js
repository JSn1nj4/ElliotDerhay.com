require('dotenv').config()

module.exports = {
	apps: [
		{
			name: 'laravel-serve',
			script: 'artisan',
			args: 'serve --host=elliotderhay.local --port=8008',
			interpreter: 'php',
			env: {
				...process.env,
				// Environment variables go here, e.g.,
				// APP_ENV: 'production',
				// APP_DEBUG: 'false',
			},
		},
		{
			name: 'laravel-queue',
			script: 'artisan',
			args: 'queue:work',
			interpreter: 'php',
			env: {
				...process.env,
				// Environment variables go here, e.g.,
				// APP_ENV: 'production',
				// APP_DEBUG: 'false',
			},
		},
		{
			name: 'vite-dev',
			script: './node_modules/.bin/yarn',
			args: 'dev',
			env: {
				...process.env,
				// Environment variables go here, e.g.
				// NODE_ENV: 'development',
			},
		},
	],
}

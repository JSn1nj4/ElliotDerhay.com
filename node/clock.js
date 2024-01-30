NODE_ENV = process.env.NODE_ENV || 'development'
if (NODE_ENV === 'development') {
	require('dotenv').config()
}

const cron = require('node-cron')
const Sentry = require('@sentry/node')
const {exec} = require('node:child_process')

Sentry.init({
	dsn: process.env.SENTRY_NODE_DSN,

	// We recommend adjusting this value in production, or using tracesSampler
	// for finer control
	tracesSampleRate: 1.0,
})

cron.schedule('0 * * * *', () => {
	exec(
		'cd /app && php artisan schedule:run >> /dev/null & 2>&1',
		(error, stdout, stderr) => {
			if (error === null) return

			console.error(error.message)
			Sentry.captureException(error)
		},
	)
})

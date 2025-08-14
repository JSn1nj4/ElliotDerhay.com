import {defineConfig, loadEnv} from 'vite'
import laravel, {refreshPaths} from 'laravel-vite-plugin'
import vuePlugin from '@vitejs/plugin-vue'
import * as fs from 'fs'
import {SecureServerOptions} from 'node:http2'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({mode}) => {
	Object.assign(process.env, loadEnv(mode, process.cwd()))

	return {
		plugins: [
			laravel({
				input: ['resources/css/app.css', 'resources/js/app.ts'],
				refresh: [
					{
						paths: refreshPaths.concat(['app/View/Renderers/**']),
					},
				],
			}),
			vuePlugin(),
			tailwindcss(),
		],

		server: {
			hmr: {
				host: hmrHost(process.env),
				clientPort: hmrPort(process.env),
			},
			host: serverHost(process.env?.VITE_SERVER_HOST),
			https: serverHttps(process.env),
			port: serverPort(process.env?.VITE_SERVER_PORT),
			strictPort: true,
			origin: allowOrigin(process.env),
			// whitelist origins for *.ddev.site, *.lndo.site, *.local, and *.test
			cors: {
				origin: /https?:\/\/([A-Za-z0-9\-.]+)?(\.((ddev|lndo)\.site)|test|local)(?::\d+)?$/,
			},
		},
	}
})

function allowOrigin(env: NodeJS.ProcessEnv): string | null {
	if (!env?.VITE_SERVER_HMR_HOST) return null

	const port = hmrPort(env)

	if (typeof port !== 'number') return null

	const origin = `${schemePrefix(env)}${hmrHost(env).replace(
		/:\d+$/,
		'',
	)}:${port}`

	console.log(`allowed origin: ${origin}`)

	return origin
}

function hmrHost(env: NodeJS.ProcessEnv): string {
	return typeof env?.VITE_SERVER_HMR_HOST === 'string'
		? env?.VITE_SERVER_HMR_HOST
		: 'localhost'
}

function hmrPort(env: NodeJS.ProcessEnv): number | undefined {
	if (
		!!env?.VITE_SERVER_HMR_CLIENTPORT &&
		typeof env?.VITE_SERVER_HMR_CLIENTPORT === 'string'
	) {
		return parseInt(env?.VITE_SERVER_HMR_CLIENTPORT)
	}

	if (!!env?.VITE_SERVER_PORT && typeof env?.VITE_SERVER_PORT === 'string') {
		return parseInt(env?.VITE_SERVER_PORT)
	}

	return undefined
}

function schemePrefix(env: NodeJS.ProcessEnv): string {
	const httpsKeys = Object.keys(serverHttps(env))

	return httpsKeys.includes('cert') && httpsKeys.includes('key')
		? 'https://'
		: 'http://'
}

function serverHost(host?: string): string | boolean {
	if (host === 'true') return true

	if (typeof host === 'string') return host

	return 'localhost'
}

function serverHttps(env: NodeJS.ProcessEnv): SecureServerOptions {
	const {VITE_CERT, VITE_CERT_KEY, VITE_SERVER_HTTPS} = env

	if (!VITE_CERT && !VITE_CERT_KEY) return {}

	if (VITE_SERVER_HTTPS !== 'true') return {}

	return {
		cert: fs.readFileSync(VITE_CERT),
		key: fs.readFileSync(VITE_CERT_KEY),
	}
}

function serverPort(port?: string): number {
	return port ? parseInt(port) : 5173
}

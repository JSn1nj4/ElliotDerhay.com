import {defineConfig, loadEnv} from 'vite'
import laravel, {refreshPaths} from 'laravel-vite-plugin'
import vuePlugin from '@vitejs/plugin-vue'
import * as fs from 'fs'
import {SecureServerOptions} from 'node:http2'

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
		],

		server: {
			hmr: {
				host: hmrHost(process.env?.VITE_SERVER_HMR_HOST),
			},
			host: serverHost(process.env?.VITE_SERVER_HOST),
			https: serverHttps(process.env),
			port: serverPort(process.env?.VITE_SERVER_PORT),
		},
	}
})

function hmrHost(host?: string): string {
	return !!host ? host : 'localhost'
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
	return port ? parseInt(port) : 24690
}

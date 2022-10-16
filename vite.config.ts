import {defineConfig, HmrOptions, loadEnv, ServerOptions, UserConfig} from 'vite'
import laravel from 'laravel-vite-plugin'
import vuePlugin from "@vitejs/plugin-vue"
import * as fs from "fs"

export default defineConfig(({ mode }) => {
	// setup
	Object.assign(process.env, loadEnv(mode, process.cwd()))
	const {
		VITE_SERVER_HOST,
		VITE_SERVER_HMR_HOST,
		VITE_SERVER_HTTPS,
		VITE_SERVER_PORT
	} = process.env

	// build hmr config
	const hmr: HmrOptions = {}
	if(VITE_SERVER_HMR_HOST) hmr.host = VITE_SERVER_HMR_HOST

	// build vite server config
	const server: ServerOptions = {}
	if(Object.keys(hmr).length > 0) server.hmr = hmr
	if(VITE_SERVER_HOST) server.host = VITE_SERVER_HOST !== 'true' ? VITE_SERVER_HOST : true
	if(VITE_SERVER_HTTPS) server.https = VITE_SERVER_HTTPS === 'true' ? {
		cert: fs.readFileSync('/certs/cert.crt'),
		key: fs.readFileSync('/certs/cert.key'),
    } :  false
	server.port = VITE_SERVER_PORT ? parseInt(VITE_SERVER_PORT) : 24690

	// build viteConfig object
	const viteConfig: UserConfig = {}
	if(Object.keys(server).length > 0) viteConfig.server = server
	viteConfig.plugins = [
		laravel({
				input: [
					'resources/css/app.css',
					'resources/js/app.ts',
				],
			refresh: true
		}),
		vuePlugin(),
	]

	return viteConfig
})

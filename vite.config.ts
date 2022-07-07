import {defineConfig, HmrOptions, loadEnv, ServerOptions, UserConfig} from 'vite'
import laravel from 'laravel-vite-plugin'
import vuePlugin from "@vitejs/plugin-vue"

export default defineConfig(({ mode }) => {
	// setup
	Object.assign(process.env, loadEnv(mode, process.cwd()))
	const {
		VITE_SERVER_HOST,
		VITE_SERVER_HTTPS
	} = process.env

	// build hmr config
	const hmr: HmrOptions = {}

	// build vite server config
	const server: ServerOptions = {}
	if(Object.keys(hmr).length > 0) server.hmr = hmr
	if(VITE_SERVER_HOST) server.host = VITE_SERVER_HOST !== 'true' ? VITE_SERVER_HOST : true
	if(VITE_SERVER_HTTPS) server.https = VITE_SERVER_HTTPS === 'true'

	// build viteConfig object
	const viteConfig: UserConfig = {}
	if(Object.keys(server).length > 0) viteConfig.server = server
	viteConfig.plugins = [
		laravel([
			'resources/css/app.css',
			'resources/js/app.ts',
		]),
		vuePlugin(),
	]

	return viteConfig
})

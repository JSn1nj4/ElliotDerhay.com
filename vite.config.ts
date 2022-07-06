import {defineConfig, HmrOptions, loadEnv, ServerOptions, UserConfig} from 'vite'
import laravel from 'laravel-vite-plugin'
import vuePlugin from "@vitejs/plugin-vue"

const mode = ({ mode }) => mode

Object.assign(process.env, loadEnv(mode, process.cwd()))

const hmr: HmrOptions = {}

const server: ServerOptions = {}

if(Object.keys(hmr).length > 0) server.hmr = hmr

if(!!process.env.VITE_SERVER_HOST) server.host = process.env.VITE_SERVER_HOST
server.https = !!process.env.VITE_SERVER_HTTPS && process.env.VITE_SERVER_HTTPS === 'true'

const viteConfig: UserConfig = {}

if(Object.keys(server).length > 0) viteConfig.server = server
viteConfig.plugins = [
	laravel([
		'resources/css/app.css',
		'resources/js/app.js',
	]),
	vuePlugin(),
]

export default defineConfig(viteConfig)

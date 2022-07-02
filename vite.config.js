import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";

export default defineConfig({
	plugins: [
		laravel([
			'resources/css/app.css',
			'resources/js/app.js',
		]),
		vuePlugin(),
	],
	server: {
		// host: true,
		// https: true,
		// port: 26789,
		// hmr: {
		// 	protocol: 'ws',
		// }
	},
});

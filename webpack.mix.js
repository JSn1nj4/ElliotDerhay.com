const mix = require('laravel-mix');
const atImport = require('postcss-import');
const tailwindcss = require('tailwindcss');
const mixins = require('postcss-mixins');
const simpleVars = require('postcss-simple-vars');
const nested = require('postcss-nested');

mix
	.webpackConfig({
		output: {
			publicPath: "/",
			chunkFilename: "js/modules/[name].js"
		}
	})
	.js("resources/js/app.js", "public/js")
	.js("resources/js/GAPopup.js", "public/js")
	.vue()
	.extract([
		"axios",
		"date-fns/format",
		"date-fns/formatDistanceToNow",
		"date-fns/locale/en-US",
		"vue",
	])
	.sourceMaps()
	.postCss("resources/css/app.css", "public/css", [
		atImport(),
		mixins({
			mixins: {
				transitions(mixin, settings) {
					settings = settings.indexOf('|') >= 0 ? settings.split('|') : [settings];

					let set = settings.reduce((set, val) => {
						return set === '' ? val : `${set}, ${val}`;
					}, '');

					mixin.replaceWith({
						prop: 'transition',
						value: set,
					});
				},
				textGlow(mixin, number = 1, color = '#00C49A') {
					let base = 2;
					let size = 2;
					let set = '';

					for(let i = 0; i < number; i++) {
						set = (set === '') ? `0 0 ${size}px ${color}` : `${set}, 0 0 ${size}px ${color}`;
						size *= base;
					}

					mixin.replaceWith({
						prop: 'text-shadow',
						value: set,
					});
				},
			}
		}),
		simpleVars(),
		nested(),
		tailwindcss(),
	])
	.options({
		processCssUrls: false
	})
	.version();

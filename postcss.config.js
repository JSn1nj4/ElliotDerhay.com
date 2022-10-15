module.exports = {
	plugins: {
		'postcss-import': {},
		'postcss-mixins': {
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
			},
		},
		'postcss-simple-vars': {},
		'tailwindcss/nesting': {},
		tailwindcss: {},
		autoprefixer: {},
	},
}

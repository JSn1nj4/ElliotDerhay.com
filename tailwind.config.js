import defaultTheme from 'tailwindcss/defaultTheme'
import colors from 'tailwindcss/colors'
import preset from './vendor/filament/filament/tailwind.config.preset'



const config = {
	// presets: [preset],
	content: [
		"app/**/*.php",
		"resources/**/*.js",
		"resources/**/*.vue",
		"resources/**/*.php",
		"./vendor/filament/**/*.blade.php"
	],

	theme: {
		spacing: {
			px: "1px",
			"0": "0",
			"0.5": "0.125rem",
			"1": "0.25rem",
			"2": "0.5rem",
			"3": "0.75rem",
			"4": "1rem",
			"5": "1.25rem",
			"6": "1.5rem",
			"7": "1.75rem",
			"8": "2rem",
			"9": "2.25rem",
			"10": "2.5rem",
			"12": "3rem",
			"16": "4rem",
			"20": "5rem",
			"24": "6rem",
			"32": "8rem",
			"40": "10rem",
			"48": "12rem",
			"56": "14rem",
			"60": "15rem",
			"64": "16rem",
			"72": "18rem",
			"80": "20rem",
			"96": "24rem",
			"128": "32rem",
		},

		// @TODO: Test new default breakpoints - 640, 768, 1024, 1280
		screens: {
			sm: "576px",
			md: "768px",
			lg: "992px",
			xl: "1200px"
		},

		fontFamily: {
			...defaultTheme.fontFamily,
			sans: [
				"Source Sans Pro",
				"ui-sans-serif",
				"system-ui",
				"-apple-system",
				"BlinkMacSystemFont",
				"Segoe UI",
				"Roboto",
				"Helvetica Neue",
				"Arial",
				"Noto Sans",
				"sans-serif",
				"Apple Color Emoji",
				"Segoe UI Emoji",
				"Segoe UI Symbol",
				"Noto Color Emoji"
			],
			mono: [
				"Source Code Pro",
				"Menlo",
				"Monaco",
				"Consolas",
				'"Liberation Mono"',
				'"Courier New"',
				"monospace"
			]
		},

		fontWeight: {
			extralight: 200,
			normal: 400,
			medium: 500,
			bold: 700
		},

		textColor: theme => theme("colors"),

		backgroundColor: theme => theme("colors"),

		borderColor: theme => ({
			...theme("colors"),
			DEFAULT: theme("colors.grey.200", "currentColor")
		}),

		maxWidth: {
			xs: "20rem",
			sm: "30rem",
			md: "40rem",
			lg: "50rem",
			xl: "60rem",
			"2xl": "70rem",
			"3xl": "80rem",
			"4xl": "90rem",
			"5xl": "100rem",
			full: "100%"
		},

		padding: theme => ({
			px2: "2px",
			...theme("spacing")
		}),

		listStyleType: {
			none: "none",
			disc: "disc",
			circle: "circle",
			square: "square",
			decimal: "decimal",
			"lower-roman": "lower-roman",
			"upper-roman": "upper-roman",
			"lower-alpha": "lower-alpha",
			"upper-alpha": "upper-alpha",
			plus: "+ ",
			minus: "- ",
			dollar: "$ ",
			hash: "# ",
			asterisk: "* ",
			at: "@ "
		},

		extend: {
			colors: {
				transparent: "transparent",
				current: "currentColor",

				black: "#000000",
				white: "#ffffff",

				caribbeanGreen: {
					'50': '#eafff7',
					'100': '#cdfeeb',
					'200': '#a0fadc',
					'300': '#63f2ca',
					'400': '#25e2b3',
					'500': '#00c49a',
					'600': '#00a481',
					'700': '#00836b',
					'800': '#006756',
					'900': '#005548',
					'950': '#00302a',
				},

				danger: colors.rose,
				success: colors.green,
				warning: colors.yellow,
			}
		}
	},
};

// late overrides
config.theme.extend.colors.primary = config.theme.extend.colors.caribbeanGreen

module.exports = config

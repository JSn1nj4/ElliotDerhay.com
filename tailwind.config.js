import defaultConfig from 'tailwindcss/defaultConfig'
import colors from 'tailwindcss/colors'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import theme from "tailwindcss/defaultTheme";

module.exports = {
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
			"1": "0.25rem",
			"2": "0.5rem",
			"3": "0.75rem",
			"4": "1rem",
			"5": "1.25rem",
			"6": "1.5rem",
			"8": "2rem",
			"10": "2.5rem",
			"12": "3rem",
			"16": "4rem",
			"20": "5rem",
			"24": "6rem",
			"32": "8rem",
			"40": "10rem",
			"48": "12rem",
			"56": "14rem",
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
			...defaultConfig.fontFamily,
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

				seaGreen: {
					"900": "#002e24",
					"800": "#005442",
					"600": "#00a682",
					"500": "#00C49A",
					"400": "#00ffc8",
					"200": "#6effe0",
					"100": "#bbfff0",
				},

				danger: colors.rose,
				primary: {
					"900": "#002e24",
					"800": "#005442",
					"600": "#00a682",
					"500": "#00C49A",
					"400": "#00ffc8",
					"200": "#6effe0",
					"100": "#bbfff0",
				},
				success: colors.green,
				warning: colors.yellow,
			}
		}
	},

	darkMode: "class",

	plugins: [
		forms,
		typography,
	],
};

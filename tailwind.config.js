/*

Tailwind - The Utility-First CSS Framework

A project by Adam Wathan (@adamwathan), Jonathan Reinink (@reinink),
David Hemphill (@davidhemphill) and Steve Schoger (@steveschoger).

Welcome to the Tailwind config file. This is where you can customize
Tailwind specifically for your project. Don't be intimidated by the
length of this file. It's really just a big JavaScript object and
we've done our very best to explain each section.

View the full documentation at https://tailwindcss.com.


|-------------------------------------------------------------------------------
| The default config
|-------------------------------------------------------------------------------
|
| This variable contains the default Tailwind config. You don't have
| to use it, but it can sometimes be helpful to have available. For
| example, you may choose to merge your custom configuration
| values with some of the Tailwind defaults.
|
*/

let defaultConfig = require('tailwindcss/defaultConfig');

module.exports = {
	purge: [
		"app/**/*.php",
		"resources/**/*.js",
		"resources/**/*.vue",
		"resources/**/*.php"
	],

	theme: {
		colors: {
			transparent: "transparent",

			black: "#000000",
			"gray-900": "#090909",
			"gray-800": "#151515",
			"gray-700": "#606f7b",
			"gray-600": "#8795a1",
			"gray-500": "#b8c2cc",
			"gray-400": "#dae1e7",
			"gray-200": "#f1f5f8",
			"gray-100": "#f8fafc",
			white: "#ffffff",

			"red-900": "#3b0d0c",
			"red-800": "#621b18",
			"red-600": "#cc1f1a",
			"red-500": "#e3342f",
			"red-400": "#ef5753",
			"red-200": "#f9acaa",
			"red-100": "#fcebea",

			"yellow-900": "#453411",
			"yellow-800": "#684f1d",
			"yellow-600": "#f2d024",
			"yellow-500": "#ffed4a",
			"yellow-400": "#fff382",
			"yellow-200": "#fff9c2",
			"yellow-100": "#fcfbeb",

			"green-900": "#0f2f21",
			"green-800": "#1a4731",
			"green-600": "#1f9d55",
			"green-500": "#38c172",
			"green-400": "#51d88a",
			"green-200": "#a2f5bf",
			"green-100": "#e3fcec",

			"sea-green-900": "#002e24",
			"sea-green-800": "#005442",
			"sea-green-600": "#00a682",
			"sea-green-500": "#00C49A",
			"sea-green-400": "#00e8b6",
			"sea-green-200": "#00f7c2",
			"sea-green-100": "#00ffc8",

			"teal-900": "#0d3331",
			"teal-800": "#20504f",
			"teal-600": "#38a89d",
			"teal-500": "#4dc0b5",
			"teal-400": "#64d5ca",
			"teal-200": "#a0f0ed",
			"teal-100": "#e8fffe"
		},

		darkMode: "class",

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
			"64": "16rem"
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
			backgroundImage: theme => ({
				"laptop-light":
					'url("https://s3.amazonaws.com/elliotderhay-com/banners/pexels-lukas-574073-scaled-light.jpg")',
				"laptop-dark":
					'url("https://s3.amazonaws.com/elliotderhay-com/banners/pexels-lukas-574073-scaled-dark.jpg")'
			})
		}
	}
};

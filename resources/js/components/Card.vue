<template>
	<div :class="classes" @click="click">
		<slot></slot>
	</div>
</template>
<script>
export default {
	name: "card",

	props: {
		size: String,
		url: String,
		type: {
			type: String,
			default: 'default'
		},
		margin: String,
		padding: String,
	},

	data: () => ({
		urlIsSet: false,
		cursorClass: '',
		typeClasses: {
			'default': 'rounded-lg border border-gray-600 trans-border-color hover:border-sea-green-500 bg-gray-900',
			'transparent': ''
		},
		marginVal: '',
		paddingVal: '',
	}),

	computed: {
		classes() {
			this.marginVal = (!this.margin && this.type === 'transparent' ? ''
				: (this.margin || 'my-4'));

			this.paddingVal = (!this.padding && this.type === 'transparent' ? 'px-4'
				: (this.padding || 'p-4'));

			return `relative ${this.marginVal} max-w-${this.size} w-full${this.cursorClass} z-30 ${this.paddingVal} ${this.typeClasses[this.type]}`;
		},
	},

	methods: {
		click() {
			if(this.urlIsSet) {
				open(this.url, '_blank');
			}
		}
	},

	mounted() {
		if(this.url && this.url.length > 0) {
			this.cursorClass = ' cursor-pointer';
			this.urlIsSet = true;
		}
	}
}
</script>

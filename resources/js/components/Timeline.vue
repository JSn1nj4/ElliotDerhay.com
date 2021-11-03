<template>
	<div class="timeline relative mb-4">

		<div v-if="showLine" :class="`${commonClasses} top-0 border-solid h-full`">&nbsp;</div>
		<slot></slot>
		<div v-if="showDottedLine" :class="`${commonClasses} bottom-0 border-dashed h-4 -mb-4`">&nbsp;</div>

	</div>
</template>
<script>
export default {
	name: "timeline",

	props: {
		showLine: {
			type: Boolean,
			default: true
		},
		showDottedLine: {
			type: Boolean,
			default: false
		},
		linePositionClass: {
			type: String,
			default: 'w-10'
		}
	},

	computed: {
		commonClasses() {
			return `absolute ${this.linePositionClass} border-r border-gray-600`
		}
	},
}
</script>

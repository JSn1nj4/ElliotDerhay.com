<template>
	<div class="timeline relative mb-4">

		<div v-if="showLine" :class="`${commonClasses} top-0 border-solid h-full`">&nbsp;</div>
		<slot />
		<div v-if="showDottedLine" :class="`${commonClasses} bottom-0 border-dashed h-4 -mb-4`">&nbsp;</div>

	</div>
</template>
<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(defineProps<{
	showLine?: boolean,
	showDottedLine?: boolean,
	linePositionClass?: string,
}>(), {
	showLine: true,
	showDottedLine: false,
	linePositionClass: 'w-10',
})

const commonClasses = computed(() => `absolute ${props.linePositionClass} border-r border-gray-600`)
</script>

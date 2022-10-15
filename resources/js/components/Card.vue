<template>
	<div :class="classes" @click="click">
		<slot></slot>
	</div>
</template>
<script setup lang="ts">
import { computed, onMounted, ref } from 'vue'

const props = withDefaults(defineProps<{
	size?: string,
	url?: string,
	type?: string,
	margin?: string,
	padding?: string
}>(), {
	size: '',
	url: '',
	type: 'default',
	margin: '',
	padding: '',
})

const urlIsSet = ref(false)
const cursorClass = ref('')
const typeClasses = ref({
	default: 'rounded-lg border border-gray-600 trans-border-color hover:border-sea-green-500 bg-gray-900',
	transparent: ''
})
const marginVal = ref('')
const paddingVal = ref('')

const classes = computed(() => {
	marginVal.value = (!props.margin && props.type === 'transparent' ? ''
		: (props.margin || 'my-4'))

	paddingVal.value = (!props.padding && props.type === 'transparent' ? 'px-4'
		: (props.padding || 'p-4'))

	return `relative ${marginVal.value} max-w-${props.size} w-full${cursorClass.value} z-30 ${paddingVal.value} ${typeClasses.value[props.type]}`
})

function click() {
	if(urlIsSet.value) {
		open(this.url, '_blank')
	}
}

onMounted(() => {
	if(props.url && props.url.length > 0) {
		cursorClass.value = ' cursor-pointer'
		urlIsSet.value = true
	}
})
</script>

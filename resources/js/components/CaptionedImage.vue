<template>
	<div class="relative block overflow-hidden">
		<img
			class="relative mx-auto object-contain"
			:src="src"
			:alt="alt"
			:title="title"
			:srcset="srcset"
		>
		<figcaption
			v-if="caption"
			class="caption absolute bottom-0 left-0 block w-full p-4 text-center bg-black/30"
		>
			{{ caption }}
		</figcaption>
	</div>
</template>

<script setup lang="ts">
type Url = string

// TODO: figure out why I have to redefine this interface instead of importing
interface ImageWithCaption {
	alt?: string
	srcset?: Url[]
	src: Url
	title?: string
	caption?: string
}

const props = defineProps<ImageWithCaption>()
</script>

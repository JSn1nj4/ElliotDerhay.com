<template>
	<section class="lightbox overlay fixed bg-black/50 z-50 w-screen min-h-screen top-0">
		<button class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div :style="{ gap }" class="flex flex-col justify-center items-center min-h-screen max-h-screen px-16 py-8 gap-4">
			<div class="relative w-full block overflow-hidden">
				<img :style="{ maxHeight }" class="" :class="props.classes" :src="props.src" :alt="props.alt" :title="props.title" :srcset="props.srcset">
			</div>
			<figcaption ref="caption" class="flex-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, repellat.</figcaption>
		</div>
	</section>
</template>

<script setup lang="ts">
import {computed, ref, unref} from "vue";
// import {Image} from "./components/Image.vue";
// init close button with close event
// define shape of expected lightbox data
	// src
	// alternate sources
	// alt
	// title
	// caption?

// receive update event
// show lightbox if hidden

// receive close event
// hide lightbox
// clear lightbox state

const captionHeight = ref<number>(100);

const gapVal = ref<number>(1);

const gap = computed<string>(() => {
	return `${unref(gapVal)}rem`
})

const maxHeight = computed<string>(() => {
	return `calc(100vh - ${unref(gapVal)}rem - ${unref(captionHeight)}px)`
})

const props = {
	alt: 'fake alt',
	classes: 'relative mx-auto object-contain',
	src: 'https://fakeimg.pl/768x576/282828/eae0d0/?retina=1',
	srcset: null,
	title: 'fake title',
}
</script>

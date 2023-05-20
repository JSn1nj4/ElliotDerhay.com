<template>
	<section class="lightbox overlay fixed bg-black/50 z-50 w-screen min-h-screen top-0">
		<button class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div class="relative min-h-screen max-h-screen px-16 py-8">
			<div class="relative block overflow-hidden">
				<img
					class="relative mx-auto object-contain"
					:src="props.src"
					:alt="props.alt"
					:title="props.title"
					:srcset="props.srcset">
				<figcaption
					v-if="props.caption"
					class="caption absolute bottom-0 left-0 block w-full p-4 text-center bg-black/30">
					{{ props.caption }}
				</figcaption>
			</div>
		</div>
	</section>
</template>

<script setup lang="ts">
import {computed, onActivated, onMounted, Ref, ref, unref} from "vue";
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

const props = {
	alt: 'fake alt',
	src: 'https://fakeimg.pl/768x576/282828/eae0d0/?retina=1',
	srcset: null,
	title: 'fake title',
	caption: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, repellat.',
}
</script>

<style lang="postcss">
.lightbox {
	img	{
		max-height: calc(100vh - theme(spacing.8) * 2);
	}
}
</style>

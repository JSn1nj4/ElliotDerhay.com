<template>
	<section class="lightbox overlay fixed bg-black/50 z-50 w-screen min-h-screen top-0">
		<button class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div class="flex flex-col justify-center items-center min-h-screen max-h-screen px-16 py-8 gap-4">
			<div class="relative w-full bg-red-100 block overflow-hidden">
				<img class="relative mx-auto object-contain" src="https://fakeimg.pl/768x576/282828/eae0d0/?retina=1" alt="fake alt" title="fake title" srcset="">
			</div>
			<figcaption class="flex-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, repellat.</figcaption>
		</div>
	</section>
</template>

<script setup lang="ts">
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
</script>

<style lang="postcss" scoped>
.lightbox {
	--spacing: 100px;

	img	{
		max-height: calc(100vh - var(--spacing));
	}
}
</style>

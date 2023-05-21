<template>
	<section class="lightbox overlay fixed bg-black/50 z-50 w-screen min-h-screen top-0">
		<button class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div class="relative min-h-screen max-h-screen px-16 py-8">
			<CaptionedImage
				:src="imageData.src"
				:srcset="imageData.srcset"
				:alt="imageData.alt"
				:title="imageData.title"
				:caption="imageData.caption"
			/>
		</div>
	</section>
</template>

<script setup lang="ts">
import CaptionedImage from "./components/CaptionedImage.vue";
import {ImageWithCaption} from "./components/ImageTypes";

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

const imageData: ImageWithCaption = {
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

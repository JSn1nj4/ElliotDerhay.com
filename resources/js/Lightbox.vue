<template>
	<section
		class="lightbox overlay fixed transition-opacity bg-black/50 w-screen min-h-screen top-0"
		:class="{
			'z-50': front,
			'-z-50': !front,
			'opacity-0': !visible,
		}"
		:style="{
			transitionDuration: speed,
			transitionTimingFunction: timing,
		}"
	>
		<button @click="triggerClose" class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div class="relative min-h-screen max-h-screen px-16 py-8">
			<CaptionedImage
				:src="image.src"
				:srcset="image.srcset"
				:alt="image.alt"
				:title="image.title"
				:caption="image.caption"
			/>
		</div>
	</section>
</template>

<script setup lang="ts">
import CaptionedImage from "./components/CaptionedImage.vue";
import {ImageWithCaption} from "./components/ImageTypes";
import {ref, Ref} from "vue";

type duration =
	| 0
	| 75
	| 100
	| 150
	| 200
	| 300
	| 500
	| 700
	| 1000

type timing =
	| 'linear'

const front: Ref<boolean> = ref(true) // TODO: default false
const visible: Ref<boolean> = ref(true) // TODO: default false

const image: Ref<ImageWithCaption> = ref({
	alt: 'fake alt',
	src: 'https://fakeimg.pl/768x576/282828/eae0d0/?retina=1',
	srcset: null,
	title: 'fake title',
	caption: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, repellat.',
})

function triggerClose(e) {
	visible.value = false

	setTimeout(() => {
		front.value = false

		triggerUpdate({ src: '' })
	}, props.speed)
}

function triggerUpdate(data: ImageWithCaption) {
	image.value = data
}

function triggerOpen(e) {
	// TODO: set image if has ImageWithCaption
	// triggerUpdate(e.imageData)

	if (front.value === false) front.value = true
	if (visible.value === true) return

	setTimeout(() => {
		visible.value = true
	}, props.speed)
}

const props = withDefaults(defineProps<{
	speed?: duration,
	timing?: timing,
	transition?: boolean,
}>(), {
	speed: 300,
	timing: "linear",
	transition: true,
})

// TODO: receive update event
</script>

<style lang="postcss">
.lightbox {
	img	{
		max-height: calc(100vh - theme(spacing.8) * 2);
	}
}
</style>

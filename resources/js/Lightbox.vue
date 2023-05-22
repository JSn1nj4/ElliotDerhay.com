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
		<button @click="maybeClose" class="absolute top-2 right-4 text-4xl z-50">&times;</button>
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

const defaultData = { src: '' }

const front: Ref<boolean> = ref(false)
const visible: Ref<boolean> = ref(false)

const image: Ref<ImageWithCaption> = ref(defaultData)

function maybeOpen() {
	if (visible.value === true) return

	front.value = true

	setTimeout(() => {
		visible.value = true
	}, props.speed)
}

function maybeClose() {
	if (front.value === false) return

	visible.value = false

	setTimeout(() => {
		front.value = false

		triggerUpdate(defaultData)
	}, props.speed)
}

function triggerUpdate(data: ImageWithCaption) {
	image.value = data
}

function receiveImage(e) {
	triggerUpdate(e.detail)
	maybeOpen()
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

document.addEventListener('lightbox.show', receiveImage)
</script>

<style lang="postcss">
.lightbox {
	img	{
		max-height: calc(100vh - theme(spacing.8) * 2);
	}
}
</style>

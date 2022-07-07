<template>
	<div class="atom-spinner" :style="`width: ${size}; height: ${size};`">
		<div class="spinner-inner">
			<div class="spinner-line" :style="`border-left-width: calc(${size} / 25); border-top-width: calc(${size} / 25); border-left-color: ${color};`"></div>
			<div class="spinner-line" :style="`border-left-width: calc(${size} / 25); border-top-width: calc(${size} / 25); border-left-color: ${color};`"></div>
			<div class="spinner-line" :style="`border-left-width: calc(${size} / 25); border-top-width: calc(${size} / 25); border-left-color: ${color};`"></div>
			<!--Chrome renders little circles malformed :(-->
			<div class="spinner-circle" :style="`color: ${color}; font-size: calc(${size} * 0.24);`">
				&#9679;
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">/**
 * Adapted from HTML version of Atom Spinner from "Epic Spinners"
 * spinner collection website: https://epic-spinners.epicmax.co/
 */
const props = withDefaults(defineProps<{
	size?: string,
	color?: string,
}>(), {
	size: '60px',
	color: '#00C49A',
})
</script>

<style scoped>
	.atom-spinner,
	.atom-spinner * {
		box-sizing: border-box;
	}

	.atom-spinner {
		overflow: hidden;
	}

	.atom-spinner .spinner-inner {
		position: relative;
		display: block;
		height: 100%;
		width: 100%;
	}

	.atom-spinner .spinner-circle {
		display: block;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.atom-spinner .spinner-line {
		position: absolute;
		width: 100%;
		height: 100%;
		border-radius: 50%;
		animation-duration: 1s;
		border-left-style: solid;
		border-top-style: solid;
		border-top-color: transparent;
	}

	.atom-spinner .spinner-line:nth-child(1) {
		animation: atom-spinner-animation-1 1s linear infinite;
		transform: rotateZ(120deg) rotateX(66deg) rotateZ(0deg);
	}
	.atom-spinner .spinner-line:nth-child(2) {
		animation: atom-spinner-animation-2 1s linear infinite;
		transform: rotateZ(240deg) rotateX(66deg) rotateZ(0deg);
	}
	.atom-spinner .spinner-line:nth-child(3) {
		animation: atom-spinner-animation-3 1s linear infinite;
		transform: rotateZ(360deg) rotateX(66deg) rotateZ(0deg);
	}

	@keyframes atom-spinner-animation-1 {
		100% {
			transform: rotateZ(120deg) rotateX(66deg) rotateZ(360deg);
		}
	}

	@keyframes atom-spinner-animation-2 {
		100% {
			transform: rotateZ(240deg) rotateX(66deg) rotateZ(360deg);
		}
	}

	@keyframes atom-spinner-animation-3 {
		100% {
			transform: rotateZ(360deg) rotateX(66deg) rotateZ(360deg);
		}
	}
</style>

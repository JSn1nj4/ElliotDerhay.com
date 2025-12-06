@props([
	'label'
])
<div
	class='justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300'
	x-data='<?= $dataLabel() ?>'
>
	@isset($label)
		<label class='' for='{{ $id }}'>{{ $label }}</label>
	@endisset
	<select
		class=''
		name='{{ $name }}'
		id='{{ $id }}'
		x-model='value'
		x-on:change='send'
	>
		{{ $slot }}
	</select>
</div>
<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('<?= $dataLabel() ?>', () => ({
			key: '<?= $eventKey ?>',
			dispatch: '<?= $dispatch ?>',
			listen: '<?= $listen ?>',
			value: '',

			init() {
				if (this.listen.length === 0) {
					return
				}

				document.addEventListener(this.listen, this.receive.bind(this))
			},

			send() {
				if (
					this.key.length === 0
					|| this.dispatch.length === 0
					|| this.value.length === 0
				) {
					return
				}

				document.dispatchEvent(new CustomEvent(this.dispatch, {
					detail: {[this.key]: this.value},
				}))

				console.log('sent change: ' + this.value)
			},

			receive(event) {
				if (this.key.length === 0) return

				const value = event?.detail?.[this.key]

				if (typeof value !== 'string' || value.length === 0) {
					return
				}

				console.log('received change: ' + value)

				this.value = value
			},
		}))
	})
</script>

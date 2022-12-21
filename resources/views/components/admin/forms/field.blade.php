<div class="flex flex-col mb-6 gap-2">
	<label for="{{ $field }}" class="{{ $large ? 'text-3xl' : 'text-2xl' }}">{{ $label }}</label>
	@unless($multiline)
		<x-ui.form.input
			id="{{ $field }}" name="{{ $field }}"
			error="{{ $errors->has($field) }}" value="{{ $value }}"
			text-size="{{ $large ? 'text-2xl' : 'text-lg' }}"
			padding="{{ $large ? 'p-3' : 'p-2' }}"
		/>
	@else
		<x-ui.form.text-area
			id="{{ $field }}" name="{{ $field }}"
			error="{{ $errors->has($field) }}" value="{{ $value }}"
			text-size="{{ $large ? 'text-2xl' : 'text-lg' }}"
			padding="{{ $large ? 'p-3' : 'p-2' }}"
		>
			{{ $value }}
		</x-ui.form.text-area>
	@endunless
</div>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-gray-900 dark:text-gray-200']) }}>
    {{ $value ?? $slot }}
</label>

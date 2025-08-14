@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-xs border-neutral-400 dark:border-neutral-700 border-2 focus:border-black dark:focus:border-white focus:ring-3 focus:ring-neutral-200 dark:focus:ring-neutral-800 focus:ring-opacity-50 dark:bg-neutral-700/30 p-2 text-lg']) !!}>

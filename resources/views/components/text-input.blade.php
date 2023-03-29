@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-400 dark:border-gray-700 border-2 focus:border-black dark:focus:border-white focus:ring focus:ring-gray-200 dark:focus:ring-gray-800 focus:ring-opacity-50 dark:bg-gray-700/30 p-2 text-lg']) !!}>

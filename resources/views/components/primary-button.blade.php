<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-seaGreen-600 border border-transparent rounded-md font-semibold text-md text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-700 active:bg-gray-900 dark:active:bg-seaGreen-600 focus:outline-none focus:border-gray-900 dark:focus:bg-seaGreen-600 focus:ring ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

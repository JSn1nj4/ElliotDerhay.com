<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-neutral-800 dark:bg-caribbeanGreen-600 border border-transparent rounded-md font-semibold text-md text-white uppercase tracking-widest hover:bg-neutral-700 dark:hover:bg-neutral-700 active:bg-neutral-900 dark:active:bg-caribbeanGreen-600 focus:outline-none focus:border-neutral-900 dark:focus:bg-caribbeanGreen-600 focus:ring ring-neutral-400 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

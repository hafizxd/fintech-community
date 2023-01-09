<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-gray-800 dark:bg-green-600 border border-transparent rounded-xl font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-500 focus:bg-green-600 dark:focus:bg-green-500 active:bg-gray-900 dark:active:bg-green-400 focus:outline-none focus:ring-1 focus:ring-green-400 dark:focus:ring-offset-green-900 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>

<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-md font-semibold text-xs text-text-light dark:text-text-dark uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

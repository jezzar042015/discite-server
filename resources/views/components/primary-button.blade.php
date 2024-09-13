<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center px-4 py-3 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

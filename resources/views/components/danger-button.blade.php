<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white hover:text-gray-900 bg-red-700 hover:bg-white 
    hover:border border-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 uppercase tracking-widest font-medium rounded-lg text-sm px-5 py-2.5 
    text-center mr-2 mb-2 dark:text-white dark:bg-gray-600  dark:hover:border-gray-600 dark:hover:text-gray-400 
    dark:focus:ring-gray-800']) }}>
    {{ $slot }}
</button>

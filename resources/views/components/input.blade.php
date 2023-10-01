@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600']) !!}>

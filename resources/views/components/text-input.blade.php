@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm dark:bg-gray-700']) !!}>

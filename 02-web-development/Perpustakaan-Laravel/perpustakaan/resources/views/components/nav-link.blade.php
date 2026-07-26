@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full text-left bg-white border border-gray-100 text-gray-900 font-semibold px-4 py-2 rounded-md shadow-sm'
        : 'block w-full text-left text-gray-900 hover:bg-gray-100 border-l border-transparent hover:text-gray-900 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out px-4 py-2 rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

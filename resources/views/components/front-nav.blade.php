@props(['active'])

@php
    $classes = $active ?? false ? 'block hover:text-red-300 md:hover:text-red-800 transition-colors duration-300 md:px-6 md:hover:bg-red-300 md:py-6 md:bg-red-300 md:text-red-800 text-red-300' : 'block hover:text-red-300 md:hover:text-red-800 transition-colors duration-300 md:px-6 md:hover:bg-red-300 md:py-6';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

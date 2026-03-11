@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-medico-azul-600 border-b-2 border-medico-azul-500 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-gray-600 hover:text-medico-azul-600 border-b-2 border-transparent hover:border-medico-azul-300 focus:outline-none focus:text-medico-azul-600 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

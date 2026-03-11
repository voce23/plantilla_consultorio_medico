@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-medico-azul-500 text-start text-base font-medium text-medico-azul-700 bg-medico-azul-50 focus:outline-none focus:text-medico-azul-800 focus:bg-medico-azul-100 focus:border-medico-azul-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-medico-azul-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-medico-azul-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

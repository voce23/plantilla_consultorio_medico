import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
    ],

    safelist: [
        // Footer colors
        'bg-medico-azul-900',
        'bg-medico-azul-800',
        'border-medico-azul-800',
        'text-medico-azul-100',
        'text-medico-azul-200',
        'hover:text-medico-verde-400',
        'text-medico-verde-400',
        'text-medico-verde-300',
        'hover:text-medico-verde-300',
        'bg-medico-verde-400',
        // Top bar colors
        'bg-medico-azul-500',
        'hover:text-medico-azul-100',
        // Hero section colors
        'from-clinico-blanco',
        'bg-clinico-blanco',
        'bg-clinico-gris',
        'text-medico-azul-700',
        'bg-medico-azul-100',
        'bg-medico-verde-100',
        'bg-medico-verde-500',
        'bg-medico-verde-600',
        'hover:bg-medico-verde-600',
        'hover:bg-medico-azul-600',
        'hover:bg-medico-azul-700',
        'text-medico-azul-600',
        'text-medico-verde-600',
        'from-medico-azul-600',
        'to-medico-azul-800',
        'hover:bg-medico-verde-400',
        'hover:text-medico-azul-700',
    ],

    theme: {
        extend: {
            colors: {
                'medico-azul': {
                    50: '#e6f0ff',
                    100: '#b3d1ff',
                    200: '#80b3ff',
                    300: '#4d94ff',
                    400: '#1a75ff',
                    500: '#0066CC',
                    600: '#0052a3',
                    700: '#003d7a',
                    800: '#002952',
                    900: '#001429',
                },
                'medico-verde': {
                    50: '#e6f7f0',
                    100: '#b3e8cc',
                    200: '#80d9a8',
                    300: '#4dca84',
                    400: '#1abb60',
                    500: '#00A86B',
                    600: '#008656',
                    700: '#006541',
                    800: '#00432b',
                    900: '#002216',
                },
                'clinico-blanco': '#FAFCFE',
                'clinico-gris': '#F0F4F8',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Lora', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms, typography],
};

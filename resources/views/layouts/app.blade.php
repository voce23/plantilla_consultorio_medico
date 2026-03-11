<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- SEO Meta Tags Component --}}
        <x-seo-meta 
            :title="isset($pageTitle) ? (string)$pageTitle : 'Inicio'"
            :description="isset($pageDescription) ? (string)$pageDescription : 'Clínica médica especializada con los mejores doctores. Agenda tu cita en línea fácilmente.'"
        />

        {{-- Preconnect para performance --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="dns-prefetch" href="https://fonts.googleapis.com">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

        {{-- Google Fonts con display=swap --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Styles --}}
        @livewireStyles
        
        {{-- Stack para estilos adicionales --}}
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-clinico-blanco">
        {{-- Skip to main content link para accesibilidad --}}
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-medico-azul-600 focus:text-white focus:px-4 focus:py-2 focus:rounded-lg">
            Saltar al contenido principal
        </a>
        <x-banner />

        <!-- Barra superior de contacto -->
        <x-top-bar />

        <div class="min-h-screen">
            <!-- Navegación principal sticky -->
            <div class="sticky top-0 z-50">
                @livewire('navigation-menu')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white border-b border-gray-100 shadow-sm">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main id="main-content" tabindex="-1">
                {{ $slot }}
            </main>

            <!-- Footer médico -->
            <x-footer />
        </div>

        <!-- Botón WhatsApp flotante -->
        <x-whatsapp-button />

        @stack('modals')

        @livewireScripts
    </body>
</html>

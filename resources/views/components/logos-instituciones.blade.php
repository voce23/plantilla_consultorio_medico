<!-- Logos de Instituciones -->
<!-- 📁 Archivo: resources/views/components/logos-instituciones.blade.php -->

@props([
    'instituciones' => [],
    'titulo' => 'Instituciones donde hemos colaborado'
])

<section class="py-16 bg-clinico-gris">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Título -->
        <div class="mb-12 text-center">
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl font-serif">
                {{ $titulo }}
            </h2>
            <p class="mt-4 text-gray-600">
                Reconocidos por las mejores instituciones de salud
            </p>
        </div>

        <!-- Grid de logos -->
        <div 
            class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-6"
            x-data="{ hoveredIndex: null }"
        >
            @php
                $institucionesDefault = [
                    ['nombre' => 'Hospital Nacional', 'logo' => null],
                    ['nombre' => 'Clínica Internacional', 'logo' => null],
                    ['nombre' => 'Universidad de Medicina', 'logo' => null],
                    ['nombre' => 'Centro de Salud Premium', 'logo' => null],
                    ['nombre' => 'Instituto Cardiológico', 'logo' => null],
                    ['nombre' => 'Hospital San Juan', 'logo' => null],
                ];
                $instituciones = !empty($instituciones) ? $instituciones : $institucionesDefault;
            @endphp

            @foreach($instituciones as $index => $institucion)
                <div 
                    class="group relative flex items-center justify-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300"
                    x-on:mouseenter="hoveredIndex = {{ $index }}"
                    x-on:mouseleave="hoveredIndex = null"
                >
                    @if(isset($institucion['logo']) && $institucion['logo'])
                        <!-- Logo real -->
                        <img 
                            src="{{ asset('storage/' . $institucion['logo']) }}" 
                            alt="{{ $institucion['nombre'] }}"
                            class="h-12 w-auto object-contain filter grayscale group-hover:grayscale-0 transition-all duration-500"
                        >
                    @else
                        <!-- Placeholder con iniciales -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 group-hover:from-medico-azul-100 group-hover:to-medico-verde-100 flex items-center justify-center transition-all duration-500">
                                <span class="text-xl font-bold text-gray-500 group-hover:text-medico-azul-600 transition-colors duration-300">
                                    {{ collect(explode(' ', $institucion['nombre']))->take(2)->map(fn($w) => Str::substr($w, 0, 1))->join('') }}
                                </span>
                            </div>
                            <span class="mt-2 text-xs text-gray-500 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                {{ Str::limit($institucion['nombre'], 20) }}
                            </span>
                        </div>
                    @endif

                    <!-- Tooltip con nombre completo -->
                    <div 
                        class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 translate-y-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"
                    >
                        <div class="px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg whitespace-nowrap">
                            {{ $institucion['nombre'] }}
                            <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-900 rotate-45"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

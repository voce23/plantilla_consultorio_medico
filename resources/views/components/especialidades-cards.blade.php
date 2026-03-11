<!-- Cards de Especialidades Médicas con Hover Animado -->
<!-- 📁 Archivo: resources/views/components/especialidades-cards.blade.php -->

@props([
    'especialidades' => [],
    'columnas' => 3
])

<section class="py-16 bg-white" x-data="{ hoveredCard: null }">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Grid de cards -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-{{ $columnas }}">
            @foreach($especialidades as $index => $especialidad)
                <div 
                    class="group relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-500 hover:shadow-xl hover:-translate-y-2"
                    x-on:mouseenter="hoveredCard = {{ $index }}"
                    x-on:mouseleave="hoveredCard = null"
                >
                    <!-- Fondo decorativo animado -->
                    <div class="absolute inset-0 bg-gradient-to-br from-medico-azul-500 to-medico-verde-500 opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                    
                    <!-- Contenido de la card -->
                    <div class="relative p-6">
                        <!-- Icono con fondo -->
                        <div class="flex items-center justify-center w-16 h-16 mb-6 bg-gradient-to-br from-medico-azul-100 to-medico-verde-100 rounded-2xl group-hover:from-medico-azul-500 group-hover:to-medico-verde-500 transition-all duration-300">
                            <x-icono-medico 
                                :icono="$especialidad['icono'] ?? 'estetoscopio'" 
                                class="w-8 h-8 text-medico-azul-600 group-hover:text-white transition-colors duration-300" 
                            />
                        </div>
                        
                        <!-- Título -->
                        <h3 class="mb-3 text-xl font-bold text-gray-900 group-hover:text-medico-azul-600 transition-colors duration-300">
                            {{ $especialidad['nombre'] }}
                        </h3>
                        
                        <!-- Descripción -->
                        <p class="mb-4 text-gray-600 line-clamp-3">
                            {{ $especialidad['descripcion'] ?? 'Especialidad médica disponible para consultas y tratamientos.' }}
                        </p>
                        
                        <!-- Estadísticas -->
                        <div class="flex items-center gap-4 mb-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-medico-verde-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $especialidad['doctores_count'] ?? 0 }} doctores
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                {{ $especialidad['servicios_count'] ?? 0 }} servicios
                            </span>
                        </div>
                        
                        <!-- Botón Ver más -->
                        <a 
                            href="{{ route('especialidades.show', $especialidad['slug'] ?? $especialidad['id'] ?? '#') }}"
                            class="inline-flex items-center text-medico-azul-600 font-medium group-hover:text-medico-azul-700 transition-colors duration-300"
                        >
                            Ver especialidad
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Barra inferior animada -->
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-medico-azul-500 to-medico-verde-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

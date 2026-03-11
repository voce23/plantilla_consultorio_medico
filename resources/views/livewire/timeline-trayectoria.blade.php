<!-- Timeline de Trayectoria Profesional -->
<!-- 📁 Archivo: resources/views/livewire/timeline-trayectoria.blade.php -->

<section class="py-20 bg-white" x-data="{ visible: new Array({{ count($eventos) }}).fill(false) }">
    <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <!-- Título de la sección -->
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-serif">
                Trayectoria Profesional
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Una vida dedicada a la medicina y el cuidado de la salud
            </p>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- Línea vertical central -->
            <div class="absolute left-8 md:left-1/2 transform md:-translate-x-px top-0 bottom-0 w-0.5 bg-gradient-to-b from-medico-azul-500 via-medico-verde-500 to-medico-azul-200"></div>

            <!-- Eventos del timeline -->
            @foreach($eventos as $index => $evento)
                <div 
                    class="relative mb-12 last:mb-0"
                    x-intersect="visible[{{ $index }}] = true"
                    x-data="{ show: false }"
                    x-init="setTimeout(() => { if(visible[{{ $index }}]) show = true }, {{ $index * 150 }})"
                >
                    <!-- Año (punto central) -->
                    <div 
                        x-show="show"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform scale-0"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="absolute left-8 md:left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg z-10
                        {{ $evento['tipo'] === 'titulo' ? 'bg-gradient-to-br from-medico-azul-500 to-medico-azul-600' : 
                           ($evento['tipo'] === 'estudio' ? 'bg-gradient-to-br from-medico-verde-500 to-medico-verde-600' : 
                           'bg-gradient-to-br from-gray-600 to-gray-700') }}"
                    >
                        {{ $evento['anio'] }}
                    </div>

                    <!-- Contenido del evento -->
                    <div 
                        x-show="show"
                        x-transition:enter="transition ease-out duration-500 delay-100"
                        x-transition:enter-start="opacity-0 transform {{ $index % 2 === 0 ? '-translate-x-8' : 'translate-x-8' }}"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        class="ml-24 md:ml-0 md:w-5/12 
                        {{ $index % 2 === 0 ? 'md:pr-12 md:text-right' : 'md:ml-auto md:pl-12' }}"
                    >
                        <!-- Card del evento -->
                        <div class="p-6 bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            <!-- Icono según tipo -->
                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full mb-4
                                {{ $evento['tipo'] === 'titulo' ? 'bg-medico-azul-100 text-medico-azul-600' : 
                                   ($evento['tipo'] === 'estudio' ? 'bg-medico-verde-100 text-medico-verde-600' : 
                                   'bg-gray-100 text-gray-600') }}">
                                @if($evento['tipo'] === 'titulo')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                @elseif($evento['tipo'] === 'estudio')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- Título -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $evento['titulo'] }}
                            </h3>

                            <!-- Institución -->
                            <p class="text-medico-azul-600 font-medium mb-2">
                                {{ $evento['institucion'] }}
                            </p>

                            <!-- Descripción -->
                            <p class="text-gray-600 text-sm">
                                {{ $evento['descripcion'] }}
                            </p>

                            <!-- Badge de tipo -->
                            <span class="inline-block mt-4 px-3 py-1 text-xs font-medium rounded-full
                                {{ $evento['tipo'] === 'titulo' ? 'bg-medico-azul-100 text-medico-azul-700' : 
                                   ($evento['tipo'] === 'estudio' ? 'bg-medico-verde-100 text-medico-verde-700' : 
                                   'bg-gray-100 text-gray-700') }}">
                                @if($evento['tipo'] === 'titulo')
                                    Título
                                @elseif($evento['tipo'] === 'estudio')
                                    Estudio
                                @else
                                    Cargo
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

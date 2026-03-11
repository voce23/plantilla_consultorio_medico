<!-- Carrusel de Testimonios -->
<!-- 📁 Archivo: resources/views/livewire/carrusel-testimonios.blade.php -->

<section class="py-20 bg-clinico-gris overflow-hidden" x-data="{ autoPlay: @js($autoPlay) }" x-init="if(autoPlay) { setInterval(() => $wire.siguiente(), {{ $intervalo }}) }">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Título -->
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-serif">
                Lo que dicen nuestros pacientes
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Testimonios reales de personas que confiaron en nosotros
            </p>
        </div>

        @if(count($testimonios) > 0)
            <!-- Contenedor del carrusel -->
            <div class="relative max-w-4xl mx-auto">
                <!-- Botón anterior -->
                <button
                    type="button"
                    wire:click="anterior"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 lg:-translate-x-16 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-medico-azul-600 hover:shadow-xl transition-all duration-300"
                    aria-label="Testimonio anterior"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Botón siguiente -->
                <button
                    type="button"
                    wire:click="siguiente"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-16 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-medico-azul-600 hover:shadow-xl transition-all duration-300"
                    aria-label="Siguiente testimonio"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Tarjeta de testimonio -->
                <div class="relative bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    @foreach($testimonios as $index => $testimonio)
                        <div
                            wire:key="testimonio-{{ $index }}"
                            x-show="$wire.testimonioActual === {{ $index }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            style="display: {{ $testimonioActual === $index ? 'block' : 'none' }}"
                        >
                            <!-- Comillas decorativas -->
                            <div class="absolute top-4 left-4 text-8xl text-medico-azul-100 font-serif leading-none select-none">
                                "
                            </div>

                            <!-- Contenido -->
                            <div class="relative z-10 text-center">
                                <!-- Estrellas -->
                                <div class="flex justify-center gap-1 mb-6">
                                    @for($i = 0; $i < $testimonio['estrellas']; $i++)
                                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>

                                <!-- Comentario -->
                                <blockquote class="text-xl md:text-2xl text-gray-700 italic mb-8 leading-relaxed">
                                    "{{ $testimonio['comentario'] }}"
                                </blockquote>

                                <!-- Autor -->
                                <div class="flex items-center justify-center gap-4">
                                    @if($testimonio['foto'])
                                        <img 
                                            src="{{ asset('storage/' . $testimonio['foto']) }}" 
                                            alt="{{ $testimonio['nombre'] }}"
                                            class="w-16 h-16 rounded-full object-cover border-4 border-medico-azul-100"
                                        >
                                    @else
                                        <div class="w-16 h-16 rounded-full bg-medico-azul-100 flex items-center justify-center border-4 border-medico-azul-200">
                                            <span class="text-2xl font-bold text-medico-azul-600">
                                                {{ collect(explode(' ', $testimonio['nombre']))->map(fn($n) => substr($n, 0, 1))->join('') }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        <p class="font-bold text-gray-900 text-lg">{{ $testimonio['nombre'] }}</p>
                                        @if($testimonio['servicio'])
                                            <p class="text-medico-azul-600 text-sm">{{ $testimonio['servicio'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Indicadores (dots) -->
                    <div class="flex justify-center gap-2 mt-8">
                        @foreach($testimonios as $index => $testimonio)
                            <button
                                type="button"
                                wire:click="irA({{ $index }})"
                                class="w-3 h-3 rounded-full transition-all duration-300 {{ $testimonioActual === $index ? 'bg-medico-azul-500 w-8' : 'bg-gray-300 hover:bg-gray-400' }}"
                                aria-label="Ir al testimonio {{ $index + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <p class="text-gray-500">Aún no hay testimonios destacados</p>
            </div>
        @endif
    </div>
</section>

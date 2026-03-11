<!-- Stats Counter - Contador de Estadísticas Animado -->
<!-- 📁 Archivo: resources/views/components/stats-counter.blade.php -->

@props([
    'stats' => [],
    'titulo' => null,
])

@php
$statsDefault = [
    ['valor' => 15000, 'sufijo' => '+', 'label' => 'Pacientes Atendidos', 'icono' => 'users'],
    ['valor' => 15, 'sufijo' => '+', 'label' => 'Años de Experiencia', 'icono' => 'calendar'],
    ['valor' => 25, 'sufijo' => '+', 'label' => 'Especialidades', 'icono' => 'academic-cap'],
    ['valor' => 98, 'sufijo' => '%', 'label' => 'Satisfacción', 'icono' => 'heart'],
];
$stats = !empty($stats) ? $stats : $statsDefault;
@endphp

<section 
    class="py-20 bg-gradient-to-br from-medico-azul-600 to-medico-azul-800 relative overflow-hidden"
    x-data="statsCounter()"
    x-intersect="startAnimation = true"
>
    <!-- Decoración de fondo -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-medico-verde-400 rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 relative z-10">
        <!-- Título opcional -->
        @if($titulo)
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white sm:text-4xl font-serif">
                    {{ $titulo }}
                </h2>
            </div>
        @endif

        <!-- Grid de estadísticas -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($stats as $index => $stat)
                <div 
                    class="text-center"
                    x-data="{ 
                        current: 0, 
                        target: {{ $stat['valor'] }},
                        duration: 2000,
                        startTime: null
                    }"
                    x-init="
                        $watch('startAnimation', (value) => {
                            if (value) {
                                setTimeout(() => {
                                    const animate = (timestamp) => {
                                        if (!startTime) startTime = timestamp;
                                        const progress = Math.min((timestamp - startTime) / duration, 1);
                                        const easeOut = 1 - Math.pow(1 - progress, 3);
                                        current = Math.floor(easeOut * target);
                                        if (progress < 1) {
                                            requestAnimationFrame(animate);
                                        }
                                    };
                                    requestAnimationFrame(animate);
                                }, {{ $index * 150 }});
                            }
                        })
                    "
                >
                    <!-- Icono -->
                    <div class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-white bg-opacity-20 rounded-2xl">
                        @switch($stat['icono'])
                            @case('users')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                @break
                            @case('calendar')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                @break
                            @case('academic-cap')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                </svg>
                                @break
                            @case('heart')
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                @break
                            @default
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                        @endswitch
                    </div>

                    <!-- Número animado -->
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                        <span x-text="current">0</span>{{ $stat['sufijo'] }}
                    </div>

                    <!-- Label -->
                    <p class="text-medico-azul-100 text-lg">
                        {{ $stat['label'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Script para el contador -->
    <script>
        function statsCounter() {
            return {
                startAnimation: false,
            }
        }
    </script>
</section>

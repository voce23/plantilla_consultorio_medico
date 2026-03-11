<!-- Stats Badge Component - Estadísticas médicas animadas -->
<!-- 📁 Archivo: resources/views/components/stats-badge.blade.php -->

@props([
    'stats' => [
        ['value' => '5,000+', 'label' => 'Pacientes Atendidos', 'icon' => 'users'],
        ['value' => '15+', 'label' => 'Años de Experiencia', 'icon' => 'calendar'],
        ['value' => '20+', 'label' => 'Especialistas', 'icon' => 'stethoscope'],
        ['value' => '98%', 'label' => 'Satisfacción', 'icon' => 'heart'],
    ]
])

<!-- Sección de estadísticas con contador animado -->
<section 
    x-data="statsCounter()"
    x-intersect="startCounting = true"
    class="py-16 bg-white"
>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            @foreach($stats as $index => $stat)
                <div 
                    x-show="startCounting"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    style="transition-delay: {{ $index * 100 }}ms"
                    class="text-center"
                >
                    <!-- Icono -->
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full {{ $index % 2 === 0 ? 'bg-medico-azul-100' : 'bg-medico-verde-100' }}">
                        @if($stat['icon'] === 'users')
                            <svg class="w-8 h-8 {{ $index % 2 === 0 ? 'text-medico-azul-600' : 'text-medico-verde-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'calendar')
                            <svg class="w-8 h-8 {{ $index % 2 === 0 ? 'text-medico-azul-600' : 'text-medico-verde-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        @elseif($stat['icon'] === 'stethoscope')
                            <svg class="w-8 h-8 {{ $index % 2 === 0 ? 'text-medico-azul-600' : 'text-medico-verde-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @elseif($stat['icon'] === 'heart')
                            <svg class="w-8 h-8 {{ $index % 2 === 0 ? 'text-medico-azul-600' : 'text-medico-verde-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @endif
                    </div>
                    
                    <!-- Valor -->
                    <div 
                        class="text-3xl font-bold {{ $index % 2 === 0 ? 'text-medico-azul-600' : 'text-medico-verde-600' }} sm:text-4xl"
                        x-text="'{{ $stat['value'] }}'"
                    >
                        {{ $stat['value'] }}
                    </div>
                    
                    <!-- Etiqueta -->
                    <div class="mt-2 text-sm text-gray-600 sm:text-base">
                        {{ $stat['label'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function statsCounter() {
    return {
        startCounting: false,
    }
}
</script>

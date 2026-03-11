<!-- Selector de Horarios -->
<!-- 📁 Archivo: resources/views/livewire/horario-selector.blade.php -->

<div class="w-full">
    <!-- Título -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900">
            Selecciona un Horario
        </h3>
        <p class="text-sm text-gray-500">
            @if($doctorId && $fecha)
                Horarios disponibles para {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
            @else
                Selecciona un doctor y fecha para ver horarios
            @endif
        </p>
    </div>

    <!-- Grid de horarios -->
    @if(!empty($horarios))
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
            @foreach($horarios as $slot)
                <button
                    type="button"
                    wire:click="seleccionarHora('{{ $slot['hora'] }}')"
                    @disabled(!$slot['disponible'])
                    class="relative px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200
                        {{ $horaSeleccionada === $slot['hora'] 
                            ? 'bg-medico-azul-500 text-white shadow-lg shadow-medico-azul-500/30 transform scale-105' 
                            : ($slot['disponible'] 
                                ? 'bg-white text-gray-700 border-2 border-gray-200 hover:border-medico-azul-300 hover:bg-medico-azul-50' 
                                : 'bg-gray-100 text-gray-400 cursor-not-allowed border-2 border-gray-200') }}"
                >
                    {{ $slot['formato'] }}
                    
                    <!-- Indicador de seleccionado -->
                    @if($horaSeleccionada === $slot['hora'])
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-medico-verde-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @endif

                    <!-- Indicador de ocupado -->
                    @if(!$slot['disponible'])
                        <span class="absolute inset-0 flex items-center justify-center">
                            <span class="w-full h-0.5 bg-gray-400 transform rotate-45"></span>
                        </span>
                    @endif
                </button>
            @endforeach
        </div>

        <!-- Leyenda -->
        <div class="mt-4 flex items-center gap-6 text-sm">
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-medico-azul-500 rounded"></span>
                <span class="text-gray-600">Seleccionado</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-white border-2 border-gray-200 rounded"></span>
                <span class="text-gray-600">Disponible</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-4 h-4 bg-gray-100 border-2 border-gray-200 rounded relative">
                    <span class="absolute inset-0 flex items-center justify-center">
                        <span class="w-full h-0.5 bg-gray-400 transform rotate-45"></span>
                    </span>
                </span>
                <span class="text-gray-600">Ocupado</span>
            </div>
        </div>
    @else
        <!-- Estado vacío -->
        <div class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-500">
                @if(!$doctorId)
                    Selecciona un doctor primero
                @elseif(!$fecha)
                    Selecciona una fecha
                @else
                    No hay horarios disponibles
                @endif
            </p>
        </div>
    @endif

    <!-- Hora seleccionada -->
    @if($horaSeleccionada)
        <div class="mt-4 p-4 bg-medico-azul-50 rounded-xl border border-medico-azul-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Hora seleccionada:</p>
                    <p class="text-lg font-bold text-medico-azul-700">
                        {{ \Carbon\Carbon::parse($horaSeleccionada)->format('h:i A') }}
                    </p>
                </div>
                <button
                    type="button"
                    wire:click="$set('horaSeleccionada', null)"
                    class="text-sm text-red-600 hover:text-red-800 underline"
                >
                    Cambiar
                </button>
            </div>
        </div>
    @endif
</div>

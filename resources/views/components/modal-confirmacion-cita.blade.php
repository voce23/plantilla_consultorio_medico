<!-- Modal de Confirmación de Cita -->
<!-- 📁 Archivo: resources/views/components/modal-confirmacion-cita.blade.php -->

@props([
    'mostrar' => false,
    'cita' => null,
])

<div
    x-data="{ abierto: @js($mostrar) }"
    x-show="abierto"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    @keydown.escape.window="abierto = false"
>
    <!-- Overlay oscuro -->
    <div 
        x-show="abierto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm"
        @click="abierto = false"
    ></div>

    <!-- Contenedor del modal -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="abierto"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 transform scale-95 translate-y-4"
            class="relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white shadow-2xl"
            @click.outside="abierto = false"
        >
            <!-- Header con gradiente -->
            <div class="bg-gradient-to-r from-medico-azul-500 to-medico-verde-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirmar Cita
                    </h3>
                    <button
                        type="button"
                        @click="abierto = false"
                        class="text-white hover:text-gray-200 transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Contenido del resumen -->
            <div class="px-6 py-6">
                <p class="text-gray-600 mb-6">
                    Por favor, revisa los detalles de tu cita antes de confirmar:
                </p>

                @if($cita)
                    <div class="space-y-4">
                        <!-- Paciente -->
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 bg-medico-azul-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Paciente</p>
                                <p class="font-semibold text-gray-900">{{ $cita['paciente_nombre'] ?? 'No especificado' }}</p>
                            </div>
                        </div>

                        <!-- Doctor -->
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 bg-medico-verde-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-medico-verde-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Doctor</p>
                                <p class="font-semibold text-gray-900">{{ $cita['doctor_nombre'] ?? 'No especificado' }}</p>
                            </div>
                        </div>

                        <!-- Especialidad -->
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Especialidad</p>
                                <p class="font-semibold text-gray-900">{{ $cita['especialidad'] ?? 'No especificada' }}</p>
                            </div>
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Fecha</p>
                                    <p class="font-semibold text-gray-900">{{ $cita['fecha'] ?? 'No especificada' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Hora</p>
                                    <p class="font-semibold text-gray-900">{{ $cita['hora'] ?? 'No especificada' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Motivo -->
                        @if(isset($cita['motivo']) && $cita['motivo'])
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500 mb-1">Motivo de la consulta</p>
                                <p class="text-gray-900">{{ $cita['motivo'] }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-gray-500">No hay información de cita para mostrar</p>
                    </div>
                @endif
            </div>

            <!-- Footer con botones -->
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end gap-3">
                <button
                    type="button"
                    @click="abierto = false"
                    class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Cancelar
                </button>
                <button
                    type="button"
                    @click="$dispatch('confirmar-cita'); abierto = false"
                    class="px-4 py-2 text-white bg-medico-azul-500 rounded-lg hover:bg-medico-azul-600 transition-colors flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Confirmar Cita
                </button>
            </div>
        </div>
    </div>
</div>

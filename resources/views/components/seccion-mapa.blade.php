<!-- Sección Google Maps - Cómo Llegar -->
<!-- 📁 Archivo: resources/views/components/seccion-mapa.blade.php -->

@props([
    'titulo' => '¿Cómo llegar?',
    'direccion' => 'Av. Salud 123, Colonia Médica, Ciudad de México',
    'telefono' => '+52 123 456 7890',
    'email' => 'contacto@clinicasalud.com',
    'googleMapsUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.888123456789!2d-99.12345678901234!3d19.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA3JzI0LjQiTiA5OcKwMDcnMjQuNCJX!5e0!3m2!1ses!2smx!4v1234567890123!5m2!1ses!2smx',
    'instrucciones' => [],
])

@php
$instruccionesDefault = [
    'Estamos ubicados en Av. Salud 123, a 2 cuadras del Metro Hospital General.',
    'Si vienes en auto, tenemos estacionamiento gratuito para pacientes.',
    'También puedes llegar en transporte público: Rutas 15, 28 y 45 pasan por la puerta.',
];
$instrucciones = !empty($instrucciones) ? $instrucciones : $instruccionesDefault;
@endphp

<section class="py-20 bg-white" id="como-llegar">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Título -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-medico-azul-100 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-serif">{{ $titulo }}</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Visítanos en nuestra ubicación principal. Estamos conveniently ubicados para atenderte mejor.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información de Contacto -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Dirección -->
                <div class="bg-clinico-gris rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-medico-azul-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Dirección</h3>
                            <p class="text-gray-600 text-sm">{{ $direccion }}</p>
                            <a 
                                href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($direccion) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-1 text-medico-azul-600 hover:text-medico-azul-700 text-sm font-medium mt-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 7m0 13V7"/>
                                </svg>
                                Obtener direcciones
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Teléfono -->
                <div class="bg-clinico-gris rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-medico-verde-400 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-medico-azul-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Teléfono</h3>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $telefono) }}" class="text-gray-600 text-sm hover:text-medico-azul-600 transition">
                                {{ $telefono }}
                            </a>
                            <p class="text-gray-500 text-xs mt-1">Lun - Vie: 8:00 - 20:00</p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-clinico-gris rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-medico-azul-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                            <a href="mailto:{{ $email }}" class="text-gray-600 text-sm hover:text-medico-azul-600 transition">
                                {{ $email }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Instrucciones -->
                <div class="bg-medico-azul-50 rounded-2xl p-6 border border-medico-azul-100">
                    <h3 class="font-bold text-medico-azul-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Instrucciones
                    </h3>
                    <ul class="space-y-3">
                        @foreach($instrucciones as $instruccion)
                            <li class="flex items-start gap-3 text-sm text-medico-azul-800">
                                <svg class="w-5 h-5 text-medico-azul-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $instruccion }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Mapa -->
            <div class="lg:col-span-2">
                <div class="bg-gray-100 rounded-2xl overflow-hidden shadow-lg h-full min-h-[400px] lg:min-h-[600px]">
                    <iframe
                        src="{{ $googleMapsUrl }}"
                        width="100%"
                        height="100%"
                        style="border:0; min-height: 100%;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Ubicación de Clínica Salud"
                        class="w-full h-full"
                    ></iframe>
                </div>
            </div>
        </div>

        <!-- Botón de Acción -->
        <div class="mt-12 text-center">
            <a 
                href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($direccion) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-8 py-4 bg-medico-azul-500 text-white font-medium rounded-xl hover:bg-medico-azul-600 hover:shadow-lg transition-all duration-300"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 7m0 13V7"/>
                </svg>
                Abrir en Google Maps
            </a>
        </div>
    </div>
</section>

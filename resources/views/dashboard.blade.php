<!-- Dashboard Médico -->
<!-- 📁 Archivo: resources/views/dashboard.blade.php -->
<x-app-layout>
    <!-- Hero Section Principal -->
    <x-hero-section />

    <!-- Estadísticas médicas -->
    <x-stats-badge />

    <!-- Sección de servicios destacados -->
    <section class="py-16 bg-clinico-gris">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-serif">
                    Nuestros Servicios
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Contamos con una amplia gama de especialidades médicas para cuidar de tu salud
                </p>
            </div>

            <!-- Grid de servicios -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $servicios = [
                        ['nombre' => 'Medicina General', 'icono' => 'heart', 'descripcion' => 'Consultas de rutina y prevención'],
                        ['nombre' => 'Cardiología', 'icono' => 'activity', 'descripcion' => 'Cuidado del corazón'],
                        ['nombre' => 'Pediatría', 'icono' => 'users', 'descripcion' => 'Atención infantil especializada'],
                        ['nombre' => 'Ginecología', 'icono' => 'heart', 'descripcion' => 'Salud de la mujer'],
                        ['nombre' => 'Dermatología', 'icono' => 'eye', 'descripcion' => 'Cuidado de la piel'],
                        ['nombre' => 'Traumatología', 'icono' => 'activity', 'descripcion' => 'Lesiones y huesos'],
                    ];
                @endphp

                @foreach($servicios as $servicio)
                    <div class="p-6 bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-medico-azul-100 rounded-xl group-hover:bg-medico-azul-500 transition-colors">
                                <svg class="w-6 h-6 text-medico-azul-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-semibold text-gray-900">{{ $servicio['nombre'] }}</h3>
                        </div>
                        <p class="text-gray-600">{{ $servicio['descripcion'] }}</p>
                        <a href="#" class="inline-flex items-center mt-4 text-medico-azul-600 hover:text-medico-azul-700 font-medium">
                            Ver más
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sección CTA final -->
    <section class="py-20 bg-gradient-to-r from-medico-azul-600 to-medico-azul-700">
        <div class="px-4 mx-auto max-w-4xl text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white sm:text-4xl font-serif">
                ¿Listo para cuidar tu salud?
            </h2>
            <p class="mt-4 text-lg text-medico-azul-100">
                Agenda tu cita hoy y comienza tu camino hacia una vida más saludable
            </p>
            <div class="mt-8">
                <a 
                    href="#reservar" 
                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-medico-azul-600 bg-white rounded-xl hover:bg-gray-100 transition-all duration-300 hover:shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Reservar Mi Cita
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Hero Section Médico -->
<!-- 📁 Archivo: resources/views/components/hero-section.blade.php -->
<section 
    x-data="{ show: false }" 
    x-init="setTimeout(() => show = true, 100)"
    class="relative overflow-hidden bg-gradient-to-br from-clinico-blanco via-white to-medico-azul-50"
>
    <!-- Fondo decorativo -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute rounded-full opacity-50 -top-40 -right-40 w-80 h-80 bg-medico-azul-100 blur-3xl"></div>
        <div class="absolute rounded-full opacity-50 -bottom-40 -left-40 w-80 h-80 bg-medico-verde-100 blur-3xl"></div>
    </div>

    <div class="relative px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">
        <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16">
            
            <!-- Columna izquierda: Texto y CTAs -->
            <div 
                x-show="show"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 transform -translate-x-8"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                class="text-center lg:text-left"
            >
                <!-- Badge superior -->
                <div class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium rounded-full bg-medico-verde-100 text-medico-verde-700">
                    <span class="w-2 h-2 mr-2 rounded-full bg-medico-verde-500 animate-pulse"></span>
                    Atención médica de calidad
                </div>

                <!-- Headline principal con degradado -->
                <h1 class="mb-6 font-serif text-4xl font-bold leading-tight tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Tu salud merece
                    <span class="block mt-2 text-transparent bg-gradient-to-r from-medico-azul-500 via-medico-azul-600 to-medico-verde-500 bg-clip-text">
                        la mejor atención
                    </span>
                </h1>

                <!-- Subtítulo -->
                <p class="max-w-xl mx-auto mb-8 text-lg text-gray-600 sm:text-xl lg:mx-0">
                    Más de <strong class="text-medico-azul-600">15 años</strong> cuidando de tu familia. 
                    Especialistas comprometidos con tu bienestar y el de tus seres queridos.
                </p>

                <!-- Botones CTA -->
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-center lg:justify-start">
                    <!-- Botón primario: Reservar Cita -->
                    <a 
                        href="{{ route('citas.agendar') }}"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white transition-all duration-300 rounded-xl bg-medico-azul-500 hover:bg-medico-azul-600 hover:shadow-lg hover:shadow-medico-azul-500/30 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-medico-azul-500 focus:ring-offset-2"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Reservar Cita
                    </a>

                    <!-- Botón secundario: Ver Servicios -->
                    <a 
                        href="{{ route('servicios') }}"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold transition-all duration-300 border-2 rounded-xl text-medico-azul-600 border-medico-azul-200 hover:border-medico-azul-500 hover:bg-medico-azul-50 focus:outline-none focus:ring-2 focus:ring-medico-azul-500 focus:ring-offset-2"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Ver Servicios
                    </a>
                </div>

                <!-- Badges de estadísticas -->
                <div class="grid grid-cols-3 gap-4 pt-8 mt-10 border-t border-gray-200">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-medico-azul-600 sm:text-3xl">+5,000</div>
                        <div class="text-sm text-gray-500">Pacientes atendidos</div>
                    </div>
                    <div class="text-center border-l border-r border-gray-200">
                        <div class="text-2xl font-bold text-medico-verde-600 sm:text-3xl">15+</div>
                        <div class="text-sm text-gray-500">Años de experiencia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-medico-azul-600 sm:text-3xl">20+</div>
                        <div class="text-sm text-gray-500">Especialistas</div>
                    </div>
                </div>
            </div>

            <!-- Columna derecha: Imagen -->
            <div 
                x-show="show"
                x-transition:enter="transition ease-out duration-700 delay-200"
                x-transition:enter-start="opacity-0 transform translate-x-8 scale-95"
                x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                class="relative"
            >
                <!-- Contenedor de imagen con decoración -->
                <div class="relative">
                    <!-- Fondo decorativo detrás de la imagen -->
                    <div class="absolute inset-0 transform scale-105 bg-gradient-to-br from-medico-azul-400 to-medico-verde-400 rounded-3xl rotate-3 opacity-20"></div>
                    
                    <!-- Imagen principal -->
                    <div class="relative overflow-hidden shadow-2xl bg-gradient-to-br from-medico-azul-100 to-medico-verde-100 rounded-3xl">
                        <!-- Placeholder de imagen médica -->
                        <div class="aspect-[4/5] sm:aspect-square lg:aspect-[4/5] flex items-center justify-center bg-gradient-to-br from-medico-azul-200 to-medico-verde-200">
                            <div class="p-8 text-center">
                                <!-- Icono médico SVG -->
                                <svg class="w-32 h-32 mx-auto text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>
                                </svg>
                                <p class="mt-4 font-medium text-white">Doctor(a) Principal</p>
                                <p class="text-sm text-white/70">Imagen profesional</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card flotante: Horario -->
                    <div class="absolute hidden p-4 bg-white shadow-lg -left-4 bottom-20 rounded-xl sm:block">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-medico-verde-100">
                                <svg class="w-5 h-5 text-medico-verde-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Horario Flexible</p>
                                <p class="text-xs text-gray-500">Lun-Sáb 8AM-8PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card flotante: Citas disponibles -->
                    <div class="absolute hidden p-4 bg-white shadow-lg -right-4 top-20 rounded-xl sm:block">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-medico-azul-100">
                                <svg class="w-5 h-5 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Citas Hoy</p>
                                <p class="text-xs font-medium text-medico-verde-600">8 disponibles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ondas decorativas inferiores -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-auto text-white" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path fill="currentColor" d="M0,0 C480,100 960,100 1440,0 L1440,100 L0,100 Z"></path>
        </svg>
    </div>
</section>

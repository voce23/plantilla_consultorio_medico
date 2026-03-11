<!-- Componente Doctor Profile - Sección About -->
<!-- 📁 Archivo: resources/views/components/doctor-profile.blade.php -->

@props([
    'doctor' => null,
    'showStats' => true
])

<section class="py-20 overflow-hidden bg-clinico-gris">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16">
            
            <!-- Columna izquierda: Foto del doctor -->
            <div 
                class="relative"
                x-data="{ show: false }"
                x-intersect="show = true"
            >
                <!-- Decoración de fondo -->
                <div class="absolute inset-0 transform scale-105 bg-gradient-to-br from-medico-azul-500 to-medico-verde-500 rounded-3xl rotate-3 opacity-10"></div>
                <div class="absolute w-32 h-32 rounded-full -top-4 -right-4 bg-medico-azul-100 blur-2xl opacity-60"></div>
                <div class="absolute w-32 h-32 rounded-full -bottom-4 -left-4 bg-medico-verde-100 blur-2xl opacity-60"></div>
                
                <!-- Contenedor de la foto con clip-path -->
                <div 
                    x-show="show"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="relative"
                >
                    <!-- Marco decorativo -->
                    <div class="absolute inset-0 transform bg-gradient-to-br from-medico-azul-500 to-medico-verde-500 rounded-3xl -rotate-2"></div>
                    
                    <!-- Foto con clip-path hexagonal -->
                    <div class="relative p-3 bg-white shadow-2xl rounded-3xl">
                        <div class="relative overflow-hidden rounded-2xl" style="clip-path: polygon(0 0, 100% 0, 100% 85%, 85% 100%, 0 100%);">
                            @if($doctor && $doctor->foto)
                                <img 
                                    src="{{ asset('storage/' . $doctor->foto) }}" 
                                    alt="{{ $doctor->nombre_completo }}"
                                    class="w-full h-[400px] lg:h-[500px] object-cover"
                                >
                            @else
                                <!-- Placeholder cuando no hay foto -->
                                <div class="w-full h-[400px] lg:h-[500px] bg-gradient-to-br from-medico-azul-200 to-medico-verde-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-32 h-32 mx-auto text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <p class="mt-4 font-medium text-white">Dr(a). {{ $doctor->nombre_completo ?? 'Médico' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Badge flotante con especialidad -->
                    @if($doctor && $doctor->especialidad)
                        <div class="absolute hidden p-4 bg-white shadow-lg -right-2 top-8 rounded-xl lg:block">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-medico-azul-100">
                                    <x-icono-medico :icono="$doctor->especialidad->icono ?? 'estetoscopio'" class="w-5 h-5 text-medico-azul-600" />
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $doctor->especialidad->nombre }}</p>
                                    <p class="text-xs text-gray-500">Especialista</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Columna derecha: Información del doctor -->
            <div 
                x-data="{ show: false }"
                x-intersect="show = true"
            >
                <div 
                    x-show="show"
                    x-transition:enter="transition ease-out duration-700 delay-200"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                >
                    <!-- Badge superior -->
                    <div class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium rounded-full bg-medico-verde-100 text-medico-verde-700">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Médico Certificado
                    </div>

                    <!-- Título -->
                    <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900 sm:text-4xl">
                        Sobre el Doctor
                    </h2>

                    <!-- Nombre del doctor -->
                    <h3 class="mb-6 text-2xl font-bold text-transparent bg-gradient-to-r from-medico-azul-600 to-medico-verde-600 bg-clip-text">
                        {{ $doctor->nombre_completo ?? 'Dr. Juan Pérez García' }}
                    </h3>

                    <!-- Biografía -->
                    <div class="mb-8 prose prose-lg text-gray-600">
                        @if($doctor && $doctor->biografia)
                            <p>{{ $doctor->biografia }}</p>
                        @else
                            <p>
                                Con más de 15 años de experiencia en el campo de la medicina, nuestro especialista 
                                se ha dedicado a brindar atención de calidad a cada uno de sus pacientes. 
                                Graduado de las mejores universidades del país y con estudios de especialización 
                                en el extranjero, combina conocimiento técnico con un trato humano y cercano.
                            </p>
                            <p>
                                Su filosofía de trabajo se basa en escuchar al paciente, entender sus necesidades 
                                y ofrecer soluciones personalizadas. Cada consulta es una oportunidad para mejorar 
                                la calidad de vida de quienes confían en nosotros.
                            </p>
                        @endif
                    </div>

                    <!-- Estadísticas rápidas -->
                    @if($showStats)
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <div class="p-4 text-center bg-white shadow-sm rounded-xl">
                                <div class="text-2xl font-bold text-medico-azul-600">15+</div>
                                <div class="text-sm text-gray-500">Años Exp.</div>
                            </div>
                            <div class="p-4 text-center bg-white shadow-sm rounded-xl">
                                <div class="text-2xl font-bold text-medico-verde-600">5,000+</div>
                                <div class="text-sm text-gray-500">Pacientes</div>
                            </div>
                            <div class="p-4 text-center bg-white shadow-sm rounded-xl">
                                <div class="text-2xl font-bold text-medico-azul-600">98%</div>
                                <div class="text-sm text-gray-500">Satisfacción</div>
                            </div>
                        </div>
                    @endif

                    <!-- Credenciales -->
                    @if($doctor)
                        <div class="flex flex-wrap gap-3">
                            @if($doctor->cmp)
                                <span class="inline-flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full">
                                    <svg class="w-4 h-4 mr-1 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    CMP: {{ $doctor->cmp }}
                                </span>
                            @endif
                            @if($doctor->email)
                                <span class="inline-flex items-center px-3 py-1 text-sm text-gray-700 bg-gray-100 rounded-full">
                                    <svg class="w-4 h-4 mr-1 text-medico-verde-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $doctor->email }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <!-- Botón CTA -->
                    <div class="mt-8">
                        <a 
                            href="#reservar" 
                            class="inline-flex items-center px-8 py-4 text-base font-semibold text-white transition-all duration-300 rounded-xl bg-medico-azul-500 hover:bg-medico-azul-600 hover:shadow-lg hover:shadow-medico-azul-500/30 hover:-translate-y-0.5"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Agendar Consulta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--
    📁 resources/views/welcome.blade.php
    Página de inicio de la Clínica Médica
--}}
<x-app-layout>

    {{-- Hero Section --}}
    <x-hero-section />

    {{-- Especialidades destacadas --}}
    @php
        $especialidades = cache()->remember('home_especialidades', 3600, function () {
            return \App\Models\Especialidad::activas()->ordenadas()->limit(6)->get()->map(fn($e) => [
                'id'              => $e->id,
                'nombre'          => $e->nombre,
                'slug'            => $e->slug,
                'descripcion'     => $e->descripcion,
                'icono'           => $e->icono ?? 'estetoscopio',
                'doctores_count'  => 0,
                'servicios_count' => 0,
            ])->toArray();
        });
    @endphp

    @if(count($especialidades) > 0)
        {{-- Encabezado de sección Especialidades --}}
        <section class="py-12 bg-white">
            <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                <div class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium rounded-full bg-medico-azul-100 text-medico-azul-700">
                    Nuestras Especialidades
                </div>
                <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">
                    Atención médica integral
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Contamos con especialistas en todas las áreas para cuidar de tu salud y la de tu familia.
                </p>
            </div>
        </section>
        <x-especialidades-cards :especialidades="$especialidades" />
    @else
        {{-- Sección placeholder cuando no hay especialidades en BD --}}
        <section class="py-16 bg-white" id="servicios">
            <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                <div class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium rounded-full bg-medico-azul-100 text-medico-azul-700">
                    Nuestros Servicios
                </div>
                <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Atención médica integral</h2>
                <p class="mt-4 text-lg text-gray-600">Contamos con especialistas en todas las áreas para cuidar de tu salud.</p>
                <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach([
                        ['icono' => '🫀', 'nombre' => 'Cardiología',     'desc' => 'Diagnóstico y tratamiento de enfermedades del corazón.'],
                        ['icono' => '🦷', 'nombre' => 'Odontología',      'desc' => 'Cuidado integral de tu salud bucal y dental.'],
                        ['icono' => '🧠', 'nombre' => 'Neurología',       'desc' => 'Atención especializada del sistema nervioso.'],
                        ['icono' => '👁️', 'nombre' => 'Oftalmología',     'desc' => 'Salud visual y cirugía ocular avanzada.'],
                        ['icono' => '🦴', 'nombre' => 'Traumatología',    'desc' => 'Tratamiento de huesos, músculos y articulaciones.'],
                        ['icono' => '🩺', 'nombre' => 'Medicina General', 'desc' => 'Consultas generales y atención preventiva.'],
                    ] as $s)
                    <div class="p-8 text-left transition shadow-sm bg-clinico-gris rounded-2xl hover:shadow-md">
                        <div class="mb-4 text-4xl">{{ $s['icono'] }}</div>
                        <h3 class="mb-2 text-xl font-bold text-gray-900">{{ $s['nombre'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $s['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('servicios') }}" class="inline-flex items-center gap-2 px-8 py-4 mt-10 font-semibold text-white transition bg-medico-azul-500 hover:bg-medico-azul-600 rounded-xl">
                    Ver todos los servicios
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </section>
    @endif

    {{-- Sección CTA Reserva de Cita --}}
    <section class="py-16 bg-gradient-to-r from-medico-azul-600 to-medico-azul-800" id="reservar">
        <div class="max-w-4xl px-4 mx-auto text-center sm:px-6 lg:px-8">
            <h2 class="font-serif text-3xl font-bold text-white sm:text-4xl">¿Listo para agendar tu cita?</h2>
            <p class="mt-4 text-xl text-medico-azul-100">
                Reserva tu consulta en línea de forma rápida y sencilla. Nuestros especialistas te esperan.
            </p>
            <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
                <a href="{{ route('citas.agendar') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-medico-verde-500 hover:bg-medico-verde-400 text-white font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Reservar Cita Ahora
                </a>
                <a href="{{ route('contacto') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 text-lg font-semibold text-white transition-all duration-300 border-2 border-white hover:bg-white hover:text-medico-azul-700 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Contáctanos
                </a>
            </div>
        </div>
    </section>

    {{-- Sección Por qué elegirnos --}}
    <section class="py-16 bg-clinico-gris">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">¿Por qué elegirnos?</h2>
                <p class="mt-4 text-lg text-gray-600">Comprometidos con tu bienestar y el de tu familia.</p>
            </div>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    [
                        'svg'    => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'titulo' => 'Médicos Certificados',
                        'desc'   => 'Todos nuestros especialistas cuentan con certificaciones y actualizaciones constantes.',
                    ],
                    [
                        'svg'    => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'titulo' => 'Horarios Flexibles',
                        'desc'   => 'Atención de lunes a sábado con horarios adaptados a tu rutina.',
                    ],
                    [
                        'svg'    => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18',
                        'titulo' => 'Tecnología Avanzada',
                        'desc'   => 'Equipos de última generación para diagnósticos precisos y tratamientos efectivos.',
                    ],
                    [
                        'svg'    => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'titulo' => 'Atención Personalizada',
                        'desc'   => 'Cada paciente recibe un trato humano, cálido y completamente individualizado.',
                    ],
                ] as $item)
                <div class="p-8 text-center transition-all duration-300 bg-white shadow-sm rounded-2xl hover:shadow-md hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-medico-azul-100 rounded-2xl">
                        <svg class="w-8 h-8 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['svg'] }}"/>
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900">{{ $item['titulo'] }}</h3>
                    <p class="text-sm leading-relaxed text-gray-600">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>

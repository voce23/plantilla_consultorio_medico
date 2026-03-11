{{-- 📁 resources/views/paginas/nosotros.blade.php --}}
@php
use App\Models\Doctor;
$doctores = Doctor::where('activo', true)->with('especialidad')->limit(4)->get();
@endphp

<x-app-layout>
    {{-- Header --}}
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Sobre Nosotros</h1>
            <p class="mt-4 text-medico-azul-100">Más de 10 años cuidando la salud de tu familia</p>
        </div>
    </section>

    {{-- Misión y Visión --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-medico-verde-500 font-semibold text-sm uppercase tracking-wide">Nuestra Historia</span>
                    <h2 class="mt-2 text-3xl font-bold text-gray-900 font-serif">Una clínica fundada con vocación de servicio</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Fundada en 2014, nuestra clínica nació con el propósito de brindar atención médica de alta calidad, accesible y cercana a la comunidad. Lo que empezó como un consultorio con dos especialidades, hoy se ha convertido en un centro médico integral con más de 15 especialistas.
                    </p>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Creemos que cada paciente merece ser tratado con respeto, calidez y excelencia médica. Por eso, todos nuestros médicos son seleccionados no solo por su preparación académica, sino también por su vocación de servicio.
                    </p>
                    <div class="mt-8 grid grid-cols-3 gap-6 text-center">
                        <div class="bg-clinico-gris rounded-xl p-4">
                            <p class="text-3xl font-bold text-medico-azul-600">10+</p>
                            <p class="text-sm text-gray-500 mt-1">Años de experiencia</p>
                        </div>
                        <div class="bg-clinico-gris rounded-xl p-4">
                            <p class="text-3xl font-bold text-medico-verde-500">15+</p>
                            <p class="text-sm text-gray-500 mt-1">Especialistas</p>
                        </div>
                        <div class="bg-clinico-gris rounded-xl p-4">
                            <p class="text-3xl font-bold text-medico-azul-600">5000+</p>
                            <p class="text-sm text-gray-500 mt-1">Pacientes atendidos</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-medico-azul-600 rounded-2xl p-8 text-white">
                        <svg class="w-10 h-10 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-xl font-bold font-serif">Nuestra Misión</h3>
                        <p class="mt-3 text-medico-azul-100 text-sm leading-relaxed">Brindar atención médica integral, humana y de calidad, contribuyendo al bienestar y la salud de nuestros pacientes y su familia.</p>
                    </div>
                    <div class="bg-medico-verde-500 rounded-2xl p-8 text-white mt-8">
                        <svg class="w-10 h-10 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <h3 class="text-xl font-bold font-serif">Nuestra Visión</h3>
                        <p class="mt-3 text-medico-verde-100 text-sm leading-relaxed">Ser el centro médico de referencia de la región, reconocido por la excelencia clínica, la innovación y el trato humano excepcional.</p>
                    </div>
                    <div class="bg-clinico-gris rounded-2xl p-8 col-span-2">
                        <h3 class="text-lg font-bold text-gray-800 font-serif">Nuestros Valores</h3>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            @foreach(['Excelencia médica', 'Trato humano', 'Ética profesional', 'Innovación continua', 'Trabajo en equipo', 'Compromiso social'] as $valor)
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <svg class="w-4 h-4 text-medico-verde-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $valor }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Equipo médico destacado --}}
    @if($doctores->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 font-serif">Nuestro Equipo Médico</h2>
                <p class="mt-4 text-gray-500">Profesionales altamente calificados a tu servicio</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($doctores as $doctor)
                    <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                        <div class="w-20 h-20 bg-medico-azul-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Dr/a. {{ $doctor->nombre_completo }}</h3>
                        @if($doctor->especialidad)
                            <p class="text-sm text-medico-azul-600 mt-1">{{ $doctor->especialidad->nombre }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('doctores.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white rounded-xl font-medium transition">
                    Ver todos los médicos →
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="py-16 bg-medico-azul-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white font-serif">¿Listo para cuidar tu salud?</h2>
            <p class="mt-4 text-medico-azul-100">Agenda tu cita hoy y recibe atención personalizada con nuestros especialistas.</p>
            <a href="{{ route('citas.agendar') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-4 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-semibold transition text-lg">
                Reservar Cita
            </a>
        </div>
    </section>
</x-app-layout>

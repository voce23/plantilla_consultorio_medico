{{-- 📁 resources/views/paginas/servicios.blade.php --}}
@php
use App\Models\Servicio;
use App\Models\Especialidad;
$servicios = Servicio::where('activo', true)->with('especialidad')->get();
$especialidades = Especialidad::where('activo', true)->whereHas('servicios', fn($q) => $q->where('activo', true))->get();
@endphp

<x-app-layout>
    <section class="py-16 bg-medico-azul-900">
        <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl font-bold text-white sm:text-4xl">Nuestros Servicios</h1>
            <p class="mt-4 text-medico-azul-100">Atención médica integral para toda la familia</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if($servicios->count() > 0)
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($servicios as $servicio)
                        <div class="flex flex-col transition-all bg-white border border-gray-100 shadow-sm rounded-2xl p-7 hover:shadow-md">
                            <div class="flex items-center justify-center w-12 h-12 mb-5 bg-medico-verde-100 rounded-xl">
                                <svg class="w-6 h-6 text-medico-verde-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            @if($servicio->especialidad)
                                <span class="mb-1 text-xs font-semibold tracking-wide uppercase text-medico-azul-600">
                                    {{ $servicio->especialidad->nombre }}
                                </span>
                            @endif
                            <h2 class="font-serif text-lg font-bold text-gray-900">{{ $servicio->nombre }}</h2>
                            @if($servicio->descripcion)
                                <p class="flex-1 mt-3 text-sm leading-relaxed text-gray-500">{{ $servicio->descripcion }}</p>
                            @endif
                            <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-100">
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    @if($servicio->duracion_minutos)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $servicio->duracion_minutos }} min
                                        </span>
                                    @endif
                                    @if($servicio->precio)
                                        <span class="font-semibold text-medico-azul-600">
                                            S/ {{ number_format($servicio->precio, 2) }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('citas.agendar') }}" class="px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-medico-azul-600 hover:bg-medico-azul-700">
                                    Reservar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center">
                    <p class="text-gray-500">No hay servicios disponibles en este momento.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-medico-azul-900">
        <div class="max-w-3xl px-4 mx-auto text-center">
            <h2 class="font-serif text-3xl font-bold text-white">¿Tienes alguna duda?</h2>
            <p class="mt-4 text-medico-azul-100">Nuestro equipo está disponible para orientarte sobre qué servicio es el más indicado para ti.</p>
            <div class="flex flex-col items-center justify-center gap-4 mt-8 sm:flex-row">
                <a href="{{ route('citas.agendar') }}" class="inline-flex items-center gap-2 px-8 py-4 font-semibold text-white transition bg-medico-verde-500 hover:bg-medico-verde-600 rounded-xl">
                    Agendar Cita
                </a>
                <a href="{{ route('contacto') }}" class="inline-flex items-center gap-2 px-8 py-4 font-semibold text-white transition bg-white/10 hover:bg-white/20 rounded-xl">
                    Contáctanos
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

{{-- 📁 resources/views/paginas/especialidad-detalle.blade.php --}}
@php
use App\Models\Especialidad;
use App\Models\Doctor;

$especialidad = Especialidad::where('slug', $slug)->where('activo', true)->firstOrFail();
$doctores = Doctor::where('especialidad_id', $especialidad->id)->where('activo', true)->get();
$servicios = $especialidad->servicios()->where('activo', true)->get();
@endphp

<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">{{ $especialidad->nombre }}</h1>
            <p class="mt-4 text-medico-azul-100">Especialidad médica</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            {{-- Descripción --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <div class="w-16 h-16 bg-medico-azul-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-9 h-9 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif">{{ $especialidad->nombre }}</h2>
                    @if($especialidad->descripcion)
                        <p class="mt-4 text-gray-600 leading-relaxed">{{ $especialidad->descripcion }}</p>
                    @endif
                    <a href="{{ route('citas.agendar') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white rounded-xl font-medium transition">
                        Agendar consulta
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['Diagnóstico preciso', 'Tratamiento personalizado', 'Seguimiento continuo', 'Tecnología avanzada'] as $beneficio)
                        <div class="bg-clinico-gris rounded-xl p-5">
                            <svg class="w-5 h-5 text-medico-verde-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm font-medium text-gray-800">{{ $beneficio }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Servicios de la especialidad --}}
            @if($servicios->count() > 0)
                <div class="border-t border-gray-100 pt-10">
                    <h3 class="text-xl font-bold text-gray-900 font-serif mb-6">Servicios disponibles</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($servicios as $servicio)
                            <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                                <h4 class="font-semibold text-gray-900">{{ $servicio->nombre }}</h4>
                                @if($servicio->descripcion)
                                    <p class="mt-2 text-sm text-gray-500">{{ $servicio->descripcion }}</p>
                                @endif
                                <div class="mt-3 flex items-center gap-4 text-sm text-gray-400">
                                    @if($servicio->duracion_minutos)
                                        <span>{{ $servicio->duracion_minutos }} min</span>
                                    @endif
                                    @if($servicio->precio)
                                        <span class="font-semibold text-medico-azul-600">S/ {{ number_format($servicio->precio, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Médicos de esta especialidad --}}
            @if($doctores->count() > 0)
                <div class="border-t border-gray-100 pt-10">
                    <h3 class="text-xl font-bold text-gray-900 font-serif mb-6">Especialistas en {{ $especialidad->nombre }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($doctores as $doctor)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                                <div class="w-16 h-16 bg-medico-azul-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-medico-azul-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Dr/a. {{ $doctor->nombre_completo }}</h4>
                                @if($doctor->cmp)
                                    <p class="text-xs text-gray-400 mt-1">{{ $doctor->cmp }}</p>
                                @endif
                                <a href="{{ route('doctores.show', \Illuminate\Support\Str::slug($doctor->nombre_completo)) }}"
                                   class="mt-4 inline-flex items-center gap-1 text-sm text-medico-azul-600 font-medium">
                                    Ver perfil →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Back link --}}
            <div class="border-t border-gray-100 pt-6">
                <a href="{{ route('especialidades.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-medico-azul-600 hover:text-medico-azul-700">
                    ← Ver todas las especialidades
                </a>
            </div>

        </div>
    </section>
</x-app-layout>

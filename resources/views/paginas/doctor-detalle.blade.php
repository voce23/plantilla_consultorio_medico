{{-- 📁 resources/views/paginas/doctor-detalle.blade.php --}}
@php
use App\Models\Doctor;
use Illuminate\Support\Str;

$doctor = Doctor::where('activo', true)
    ->with('especialidad')
    ->get()
    ->first(fn($d) => Str::slug($d->nombre_completo) === $slug);

if (!$doctor) abort(404);
@endphp

<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">
                Dr/a. {{ $doctor->nombre_completo }}
            </h1>
            @if($doctor->especialidad)
                <p class="mt-4 text-medico-azul-100">{{ $doctor->especialidad->nombre }}</p>
            @endif
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- Sidebar: foto + datos --}}
                <div class="space-y-6">
                    {{-- Foto --}}
                    <div class="bg-medico-azul-100 rounded-2xl overflow-hidden aspect-square flex items-center justify-center">
                        @if($doctor->foto)
                            <img src="{{ asset('storage/' . $doctor->foto) }}"
                                 alt="Dr. {{ $doctor->nombre_completo }}"
                                 class="w-full h-full object-cover">
                        @else
                            <svg class="w-32 h-32 text-medico-azul-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Info rápida --}}
                    <div class="bg-clinico-gris rounded-2xl p-6 space-y-4">
                        @if($doctor->especialidad)
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Especialidad</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $doctor->especialidad->nombre }}</p>
                            </div>
                        @endif
                        @if($doctor->cmp)
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Código CMP</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $doctor->cmp }}</p>
                            </div>
                        @endif
                        @if($doctor->email)
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Correo</p>
                                <p class="mt-1 text-sm text-medico-azul-600">{{ $doctor->email }}</p>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('citas.agendar') }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-semibold transition">
                        Reservar Cita
                    </a>
                </div>

                {{-- Contenido principal --}}
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 font-serif">Sobre el doctor</h2>
                        @if($doctor->biografia)
                            <div class="mt-4 text-gray-600 leading-relaxed prose max-w-none">
                                {!! nl2br(e($doctor->biografia)) !!}
                            </div>
                        @else
                            <p class="mt-4 text-gray-400">No hay información disponible en este momento.</p>
                        @endif
                    </div>

                    @if($doctor->especialidad)
                        <div class="border-t border-gray-100 pt-8">
                            <h3 class="text-lg font-bold text-gray-900 font-serif">Especialidad</h3>
                            <div class="mt-4 bg-medico-azul-50 rounded-xl p-5">
                                <p class="font-semibold text-medico-azul-700">{{ $doctor->especialidad->nombre }}</p>
                                @if($doctor->especialidad->descripcion)
                                    <p class="mt-2 text-sm text-gray-600">{{ $doctor->especialidad->descripcion }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="border-t border-gray-100 pt-8">
                        <a href="{{ route('doctores.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-medico-azul-600 hover:text-medico-azul-700">
                            ← Ver todos los médicos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

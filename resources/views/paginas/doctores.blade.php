{{-- 📁 resources/views/paginas/doctores.blade.php --}}
@php
use App\Models\Doctor;
use App\Models\Especialidad;
$doctores = Doctor::where('activo', true)->with('especialidad')->get();
$especialidades = Especialidad::where('activo', true)->get();
@endphp

<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Nuestros Médicos</h1>
            <p class="mt-4 text-medico-azul-100">Especialistas comprometidos con tu salud y bienestar</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($doctores->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($doctores as $doctor)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden">
                            {{-- Foto o avatar --}}
                            <div class="h-48 bg-medico-azul-100 flex items-center justify-center">
                                @if($doctor->foto)
                                    <img src="{{ asset('storage/' . $doctor->foto) }}"
                                         alt="Dr. {{ $doctor->nombre_completo }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <svg class="w-24 h-24 text-medico-azul-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="p-6">
                                @if($doctor->especialidad)
                                    <span class="text-xs font-semibold text-medico-azul-600 uppercase tracking-wide">
                                        {{ $doctor->especialidad->nombre }}
                                    </span>
                                @endif
                                <h2 class="mt-1 text-xl font-bold text-gray-900 font-serif">
                                    Dr/a. {{ $doctor->nombre_completo }}
                                </h2>
                                @if($doctor->cmp)
                                    <p class="text-xs text-gray-400 mt-1">{{ $doctor->cmp }}</p>
                                @endif
                                @if($doctor->biografia)
                                    <p class="mt-3 text-sm text-gray-600 line-clamp-3">{{ $doctor->biografia }}</p>
                                @endif
                                <a href="{{ route('doctores.show', Str::slug($doctor->nombre_completo)) }}"
                                   class="mt-5 inline-flex items-center gap-1 text-sm font-medium text-medico-azul-600 hover:text-medico-azul-700">
                                    Ver perfil completo →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">No hay médicos disponibles en este momento.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-medico-azul-900">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white font-serif">¿Quieres agendar una cita?</h2>
            <p class="mt-4 text-medico-azul-100">Elige tu especialista y reserva tu consulta en minutos.</p>
            <a href="{{ route('citas.agendar') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-4 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-semibold transition">
                Reservar Cita
            </a>
        </div>
    </section>
</x-app-layout>

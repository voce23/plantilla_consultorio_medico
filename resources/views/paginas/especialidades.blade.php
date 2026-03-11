{{-- 📁 resources/views/paginas/especialidades.blade.php --}}
@php
use App\Models\Especialidad;
$especialidades = Especialidad::where('activo', true)->get();
@endphp

<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Especialidades Médicas</h1>
            <p class="mt-4 text-medico-azul-100">Atención especializada en las principales áreas de la medicina</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($especialidades->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($especialidades as $especialidad)
                        <a href="{{ route('especialidades.show', $especialidad->slug) }}"
                           class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-lg hover:border-medico-azul-200 transition-all">
                            <div class="w-14 h-14 bg-medico-azul-100 rounded-xl flex items-center justify-center mb-5 group-hover:bg-medico-azul-600 transition-colors">
                                <svg class="w-7 h-7 text-medico-azul-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 font-serif group-hover:text-medico-azul-600 transition-colors">
                                {{ $especialidad->nombre }}
                            </h2>
                            @if($especialidad->descripcion)
                                <p class="mt-3 text-gray-500 text-sm leading-relaxed line-clamp-3">{{ $especialidad->descripcion }}</p>
                            @endif
                            <span class="mt-5 inline-flex items-center gap-1 text-sm font-medium text-medico-azul-600">
                                Ver más
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">No hay especialidades disponibles aún.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-medico-azul-900">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white font-serif">¿No encuentras tu especialidad?</h2>
            <p class="mt-4 text-medico-azul-100">Contáctanos y te orientamos con el especialista adecuado para ti.</p>
            <a href="{{ route('contacto') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-4 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-semibold transition">
                Contáctanos
            </a>
        </div>
    </section>
</x-app-layout>

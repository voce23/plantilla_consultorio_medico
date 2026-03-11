<!-- Footer Global -->
<!-- 📁 Archivo: resources/views/components/footer.blade.php -->

@php
use App\Models\Especialidad;

$especialidades = cache()->remember('footer_especialidades', 3600, function () {
    return Especialidad::activas()->ordenadas()->limit(6)->get();
});
@endphp

<footer class="bg-medico-azul-900 text-white">
    <!-- Contenido Principal -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Columna 1: Logo y Descripción -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-medico-verde-400 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-medico-azul-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold font-serif">Clínica Salud</span>
                </div>
                <p class="text-medico-azul-100 text-sm leading-relaxed mb-6">
                    Comprometidos con tu bienestar. Ofrecemos atención médica de calidad con los mejores especialistas y tecnología de vanguardia.
                </p>
                <x-redes-sociales class="justify-start" />
            </div>

            <!-- Columna 2: Links Rápidos -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-medico-verde-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Links Rápidos
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('inicio') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nosotros') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Sobre Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('servicios') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Servicios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Blog de Salud
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacto') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Contacto
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('citas.agendar') }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Agendar Cita
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Columna 3: Especialidades -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-medico-verde-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    Especialidades
                </h3>
                <ul class="space-y-3">
                    @foreach($especialidades as $especialidad)
                        <li>
                            <a href="{{ route('especialidades.show', $especialidad->slug) }}" class="text-medico-azul-100 hover:text-medico-verde-400 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                {{ $especialidad->nombre }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('especialidades.index') }}" class="text-medico-verde-400 hover:text-medico-verde-300 transition flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Ver todas →
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Columna 4: Contacto -->
            <div>
                <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-medico-verde-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Contacto
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-medico-verde-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-medico-azul-100 text-sm">
                            Av. Salud 123, Colonia Médica<br>
                            Ciudad de México, CP 12345
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-medico-verde-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+521234567890" class="text-medico-azul-100 hover:text-medico-verde-400 transition text-sm">
                            +52 123 456 7890
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-medico-verde-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:contacto@clinicasalud.com" class="text-medico-azul-100 hover:text-medico-verde-400 transition text-sm">
                            contacto@clinicasalud.com
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-medico-verde-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-medico-azul-100 text-sm">
                            Lun - Vie: 8:00 - 20:00<br>
                            Sáb: 9:00 - 14:00
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Barra Inferior -->
    <div class="border-t border-medico-azul-800">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-medico-azul-200 text-sm text-center md:text-left">
                    © {{ date('Y') }} Clínica Salud. Todos los derechos reservados.
                </p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('politica-privacidad') }}" class="text-medico-azul-200 hover:text-medico-verde-400 text-sm transition">
                        Política de Privacidad
                    </a>
                    <a href="{{ route('terminos-uso') }}" class="text-medico-azul-200 hover:text-medico-verde-400 text-sm transition">
                        Términos de Uso
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

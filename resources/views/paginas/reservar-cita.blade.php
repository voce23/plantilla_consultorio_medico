{{-- 📁 resources/views/paginas/reservar-cita.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Reservar Cita</h1>
            <p class="mt-4 text-medico-azul-100">Agenda tu consulta en línea fácilmente</p>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-clinico-gris rounded-2xl p-12">
                <svg class="w-16 h-16 text-medico-verde-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Formulario en construcción</h2>
                <p class="text-gray-500 mb-2">El sistema de citas en línea se desarrollará en el próximo módulo.</p>
                <p class="text-gray-500">Por ahora, contáctanos directamente:</p>
                <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:+521234567890" class="inline-flex items-center gap-2 px-6 py-3 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Llamar ahora
                    </a>
                    <a href="{{ route('inicio') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-medico-azul-600 text-medico-azul-600 hover:bg-medico-azul-50 rounded-xl font-medium transition">
                        ← Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

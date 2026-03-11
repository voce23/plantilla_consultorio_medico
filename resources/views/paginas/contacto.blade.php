{{-- 📁 resources/views/paginas/contacto.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Contacto</h1>
            <p class="mt-4 text-medico-azul-100">Estamos aquí para ayudarte</p>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-clinico-gris rounded-2xl p-12">
                <svg class="w-16 h-16 text-medico-azul-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Página en construcción</h2>
                <p class="text-gray-500">Esta sección se desarrollará en el próximo módulo.</p>
                <a href="{{ route('inicio') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white rounded-xl font-medium transition">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

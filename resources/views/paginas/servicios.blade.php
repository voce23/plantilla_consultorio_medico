{{-- 📁 resources/views/paginas/servicios.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Nuestros Servicios</h1>
            <p class="mt-4 text-medico-azul-100">Atención médica integral para toda la familia</p>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-clinico-gris rounded-2xl p-12">
                <svg class="w-16 h-16 text-medico-verde-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
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

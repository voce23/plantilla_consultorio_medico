{{-- 📁 resources/views/paginas/doctor-detalle.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif capitalize">Dr. {{ str_replace('-', ' ', $slug) }}</h1>
            <p class="mt-4 text-medico-azul-100">Perfil médico</p>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-clinico-gris rounded-2xl p-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Página en construcción</h2>
                <p class="text-gray-500">El perfil de este médico se desarrollará en el próximo módulo.</p>
                <a href="{{ route('doctores.index') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white rounded-xl font-medium transition">
                    ← Ver todos los médicos
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

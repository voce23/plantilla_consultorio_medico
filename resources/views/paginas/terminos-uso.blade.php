{{-- 📁 resources/views/paginas/terminos-uso.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Términos de Uso</h1>
            <p class="mt-4 text-medico-azul-100">Última actualización: {{ date('d \d\e F, Y') }}</p>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <h2>1. Aceptación de los Términos</h2>
                <p>Al acceder y utilizar el sitio web de Clínica Salud, usted acepta cumplir con estos términos y condiciones de uso.</p>

                <h2>2. Uso del Sitio</h2>
                <p>El contenido de este sitio es para información general únicamente. No reemplaza la consulta médica profesional. Siempre consulte a un médico calificado para diagnóstico y tratamiento.</p>

                <h2>3. Propiedad Intelectual</h2>
                <p>Todo el contenido, incluyendo textos, imágenes, logotipos y gráficos, es propiedad de Clínica Salud y está protegido por las leyes de derechos de autor.</p>

                <h2>4. Limitación de Responsabilidad</h2>
                <p>Clínica Salud no será responsable por daños directos, indirectos o consecuentes que resulten del uso o la imposibilidad de usar este sitio.</p>

                <h2>5. Cambios a los Términos</h2>
                <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Los cambios entran en vigor inmediatamente después de su publicación.</p>

                <h2>6. Contacto</h2>
                <p>Para preguntas sobre estos términos, contáctenos en <a href="mailto:legal@clinicasalud.com" class="text-medico-azul-600 hover:underline">legal@clinicasalud.com</a>.</p>
            </div>
            <div class="mt-8">
                <a href="{{ route('inicio') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white rounded-xl font-medium transition">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

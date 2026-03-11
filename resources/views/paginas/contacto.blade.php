{{-- 📁 resources/views/paginas/contacto.blade.php --}}
<x-app-layout>
    <section class="bg-medico-azul-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">Contáctanos</h1>
            <p class="mt-4 text-medico-azul-100">Estamos aquí para ayudarte. Escríbenos o llámanos.</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Formulario de contacto --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif mb-2">Envíanos un mensaje</h2>
                    <p class="text-gray-500 mb-8">Responderemos en menos de 24 horas.</p>

                    @if(session('success'))
                        <div class="mb-6 bg-medico-verde-50 border border-medico-verde-200 text-medico-verde-700 px-5 py-4 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contacto.enviar') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                <input type="text" name="nombre" placeholder="Tu nombre"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                                <input type="text" name="apellido" placeholder="Tu apellido"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                            <input type="email" name="email" placeholder="correo@ejemplo.com"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="tel" name="telefono" placeholder="+51 999 000 000"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Asunto</label>
                            <select name="asunto" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                                <option value="">Selecciona un asunto</option>
                                <option value="cita">Consulta sobre citas</option>
                                <option value="servicios">Información de servicios</option>
                                <option value="especialidades">Consulta de especialidades</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                            <textarea name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm resize-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-medico-azul-600 hover:bg-medico-azul-700 text-white font-semibold rounded-xl transition">
                            Enviar mensaje
                        </button>
                    </form>
                </div>

                {{-- Info de contacto --}}
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 font-serif mb-2">Información de contacto</h2>
                        <p class="text-gray-500">También puedes comunicarte directamente con nosotros.</p>
                    </div>

                    <div class="space-y-5">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-medico-azul-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Dirección</p>
                                <p class="text-gray-500 text-sm mt-1">Av. Principal 123, Miraflores<br>Lima, Perú</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-medico-verde-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-medico-verde-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Teléfono</p>
                                <p class="text-gray-500 text-sm mt-1">+51 (01) 234-5678</p>
                                <p class="text-gray-500 text-sm">+51 999 000 111</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-medico-azul-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-medico-azul-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Correo electrónico</p>
                                <p class="text-gray-500 text-sm mt-1">info@clinicamedica.com</p>
                                <p class="text-gray-500 text-sm">citas@clinicamedica.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-medico-verde-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-medico-verde-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Horario de atención</p>
                                <p class="text-gray-500 text-sm mt-1">Lunes a Viernes: 8:00 am – 8:00 pm</p>
                                <p class="text-gray-500 text-sm">Sábados: 9:00 am – 2:00 pm</p>
                            </div>
                        </div>
                    </div>

                    {{-- Mapa placeholder --}}
                    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm h-56 bg-clinico-gris flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <p class="text-sm">Mapa de ubicación</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>

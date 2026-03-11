<!-- Página de Política de Privacidad -->
<!-- 📁 Archivo: resources/views/paginas/politica-privacidad.blade.php -->

<x-app-layout>
    <!-- Header -->
    <section class="bg-medico-azul-900 py-16">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white sm:text-4xl font-serif">
                Política de Privacidad
            </h1>
            <p class="mt-4 text-medico-azul-100">
                Última actualización: {{ date('d \d\e F, Y') }}
            </p>
        </div>
    </section>

    <!-- Contenido con TOC Sticky -->
    <section class="py-12 bg-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                
                <!-- Tabla de Contenidos (Sticky) -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 bg-clinico-gris rounded-2xl p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            Contenido
                        </h2>
                        <nav class="space-y-2">
                            <a href="#introduccion" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                1. Introducción
                            </a>
                            <a href="#datos-recopilados" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                2. Datos que Recopilamos
                            </a>
                            <a href="#uso-datos" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                3. Uso de los Datos
                            </a>
                            <a href="#proteccion-datos" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                4. Protección de Datos
                            </a>
                            <a href="#compartir-datos" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                5. Compartir Información
                            </a>
                            <a href="#derechos" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                6. Tus Derechos
                            </a>
                            <a href="#cookies" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                7. Cookies
                            </a>
                            <a href="#cambios" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                8. Cambios a esta Política
                            </a>
                            <a href="#contacto" class="block text-sm text-gray-600 hover:text-medico-azul-600 py-1 border-l-2 border-transparent hover:border-medico-azul-500 pl-3 transition">
                                9. Contacto
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Contenido Principal -->
                <article class="lg:col-span-3 prose prose-lg max-w-none">
                    
                    <!-- Introducción -->
                    <div id="introduccion" class="scroll-mt-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introducción</h2>
                        <p class="text-gray-600 mb-4">
                            En Clínica Salud, nos tomamos muy en serio la privacidad de nuestros pacientes y visitantes. Esta Política de Privacidad describe cómo recopilamos, usamos, almacenamos y protegemos su información personal cuando utiliza nuestros servicios médicos, sitio web y aplicaciones móviles.
                        </p>
                        <p class="text-gray-600 mb-4">
                            Al acceder a nuestros servicios, usted acepta las prácticas descritas en esta política. Si no está de acuerdo con alguna parte de esta política, le recomendamos no utilizar nuestros servicios.
                        </p>
                    </div>

                    <!-- Datos Recopilados -->
                    <div id="datos-recopilados" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Datos que Recopilamos</h2>
                        <p class="text-gray-600 mb-4">
                            Podemos recopilar los siguientes tipos de información:
                        </p>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">2.1 Información Personal</h3>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Nombre completo</li>
                            <li>Fecha de nacimiento</li>
                            <li>Número de teléfono</li>
                            <li>Correo electrónico</li>
                            <li>Dirección</li>
                            <li>Identificación oficial</li>
                        </ul>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">2.2 Información Médica</h3>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Historial médico</li>
                            <li>Alergias y condiciones preexistentes</li>
                            <li>Medicamentos actuales</li>
                            <li>Resultados de exámenes y estudios</li>
                            <li>Notas de consultas médicas</li>
                        </ul>
                    </div>

                    <!-- Uso de Datos -->
                    <div id="uso-datos" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Uso de los Datos</h2>
                        <p class="text-gray-600 mb-4">
                            Utilizamos su información personal para los siguientes propósitos:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Proporcionar servicios médicos de calidad</li>
                            <li>Agendar y confirmar citas</li>
                            <li>Mantener su historial médico actualizado</li>
                            <li>Enviar recordatorios de citas y tratamientos</li>
                            <li>Procesar pagos y facturación</li>
                            <li>Cumplir con obligaciones legales y regulatorias</li>
                            <li>Mejorar nuestros servicios mediante análisis estadísticos</li>
                        </ul>
                    </div>

                    <!-- Protección de Datos -->
                    <div id="proteccion-datos" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Protección de Datos</h2>
                        <p class="text-gray-600 mb-4">
                            Implementamos medidas de seguridad técnicas, administrativas y físicas para proteger su información:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Encriptación SSL/TLS para transmisiones de datos</li>
                            <li>Firewalls y sistemas de detección de intrusiones</li>
                            <li>Acceso restringido a personal autorizado</li>
                            <li>Copias de seguridad regulares</li>
                            <li>Cumplimiento con la NOM-004-SSA3-2012 ( expediente clínico)</li>
                        </ul>
                    </div>

                    <!-- Compartir Datos -->
                    <div id="compartir-datos" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Compartir Información</h2>
                        <p class="text-gray-600 mb-4">
                            No vendemos ni alquilamos su información personal. Solo compartimos datos en las siguientes circunstancias:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Con su consentimiento explícito</li>
                            <li>Con otros profesionales de la salud involucrados en su tratamiento</li>
                            <li>Con aseguradoras para procesos de reclamación</li>
                            <li>Cuando sea requerido por ley o orden judicial</li>
                            <li>En casos de emergencia médica</li>
                        </ul>
                    </div>

                    <!-- Derechos -->
                    <div id="derechos" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Tus Derechos</h2>
                        <p class="text-gray-600 mb-4">
                            De acuerdo con la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, usted tiene derecho a:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Acceder a sus datos personales</li>
                            <li>Rectificar datos inexactos o incompletos</li>
                            <li>Cancelar sus datos cuando considere que no son necesarios</li>
                            <li>Oponerse al tratamiento de sus datos para fines específicos</li>
                            <li>Revocar su consentimiento en cualquier momento</li>
                        </ul>
                        <p class="text-gray-600 mb-4">
                            Para ejercer estos derechos, envíe una solicitud a <a href="mailto:privacidad@clinicasalud.com" class="text-medico-azul-600 hover:underline">privacidad@clinicasalud.com</a>.
                        </p>
                    </div>

                    <!-- Cookies -->
                    <div id="cookies" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies</h2>
                        <p class="text-gray-600 mb-4">
                            Utilizamos cookies y tecnologías similares para mejorar su experiencia en nuestro sitio web:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li><strong>Cookies esenciales:</strong> Necesarias para el funcionamiento del sitio</li>
                            <li><strong>Cookies de preferencias:</strong> Recuerdan sus configuraciones</li>
                            <li><strong>Cookies analíticas:</strong> Nos ayudan a entender cómo usa el sitio</li>
                            <li><strong>Cookies de marketing:</strong> Utilizadas para personalizar anuncios</li>
                        </ul>
                        <p class="text-gray-600 mb-4">
                            Puede configurar su navegador para rechazar cookies, aunque esto puede afectar la funcionalidad del sitio.
                        </p>
                    </div>

                    <!-- Cambios -->
                    <div id="cambios" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Cambios a esta Política</h2>
                        <p class="text-gray-600 mb-4">
                            Podemos actualizar esta Política de Privacidad periódicamente. Los cambios significativos serán notificados mediante:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mb-4 space-y-1">
                            <li>Un aviso prominente en nuestro sitio web</li>
                            <li>Correo electrónico a los usuarios registrados</li>
                            <li>Actualización de la fecha de "última modificación"</li>
                        </ul>
                    </div>

                    <!-- Contacto -->
                    <div id="contacto" class="scroll-mt-24 mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Contacto</h2>
                        <p class="text-gray-600 mb-4">
                            Si tiene preguntas, inquietudes o desea ejercer sus derechos de privacidad, contáctenos:
                        </p>
                        <div class="bg-clinico-gris rounded-xl p-6">
                            <p class="text-gray-700 mb-2">
                                <strong>Responsable de Protección de Datos:</strong><br>
                                Clínica Salud S.A. de C.V.
                            </p>
                            <p class="text-gray-700 mb-2">
                                <strong>Email:</strong> 
                                <a href="mailto:privacidad@clinicasalud.com" class="text-medico-azul-600 hover:underline">privacidad@clinicasalud.com</a>
                            </p>
                            <p class="text-gray-700 mb-2">
                                <strong>Teléfono:</strong> +52 123 456 7890
                            </p>
                            <p class="text-gray-700">
                                <strong>Dirección:</strong> Av. Salud 123, Colonia Médica, Ciudad de México
                            </p>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>
</x-app-layout>

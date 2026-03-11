{{-- 📁 resources/views/paginas/reservar-cita.blade.php --}}
@php
use App\Models\Especialidad;
use App\Models\Doctor;
use App\Models\Servicio;

$especialidades = Especialidad::where('activo', true)->orderBy('nombre')->get();
$doctores = Doctor::where('activo', true)->with('especialidad')->orderBy('nombre')->get();
$servicios = Servicio::where('activo', true)->with('especialidad')->orderBy('nombre')->get();

$horarios = [
    '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
    '11:00', '11:30', '12:00', '14:00', '14:30', '15:00',
    '15:30', '16:00', '16:30', '17:00', '17:30', '18:00',
];
@endphp

<x-app-layout>
    {{-- Header --}}
    <section class="py-16 bg-medico-azul-900">
        <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl font-bold text-white sm:text-4xl">Reservar Cita</h1>
            <p class="mt-4 text-medico-azul-100">Completa el formulario y nos ponemos en contacto contigo para confirmar</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">

            {{-- Alerta de éxito --}}
            @if(session('cita_exitosa'))
                <div class="mb-8 bg-medico-verde-50 border border-medico-verde-200 rounded-2xl p-6 flex items-start gap-4">
                    <svg class="w-8 h-8 text-medico-verde-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-medico-verde-800 text-lg">¡Cita registrada con éxito!</p>
                        <p class="mt-1 text-medico-verde-700">{{ session('cita_exitosa') }}</p>
                        <p class="mt-1 text-sm text-medico-verde-600">Te llamaremos pronto para confirmar tu horario.</p>
                    </div>
                </div>
            @endif

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-5">
                    <p class="font-semibold text-red-700 mb-2">Por favor corrige los siguientes campos:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm p-8 lg:p-10">

                {{-- Pasos clickeables --}}
                <div class="flex items-center justify-center gap-2 mb-10" id="stepper">
                    @foreach(['Tus datos', 'Especialidad', 'Fecha y hora', 'Confirmar'] as $i => $paso)
                        <button type="button" onclick="goToStep({{ $i }})" class="flex items-center gap-2 group" data-step="{{ $i }}">
                            <div class="step-circle flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold transition-all duration-200
                                {{ $i === 0 ? 'bg-medico-azul-600 text-white' : 'bg-gray-100 text-gray-400 group-hover:bg-gray-200' }}">
                                {{ $i + 1 }}
                            </div>
                            <span class="step-label text-sm hidden sm:block transition-all duration-200
                                {{ $i === 0 ? 'text-medico-azul-600 font-semibold' : 'text-gray-400 group-hover:text-gray-600' }}">
                                {{ $paso }}
                            </span>
                        </button>
                        @if($i < 3)
                            <div class="step-line flex-1 h-px bg-gray-200 max-w-12 transition-all duration-200"></div>
                        @endif
                    @endforeach
                </div>

                <form action="{{ route('citas.guardar') }}" method="POST" id="citaForm" class="space-y-8">
                    @csrf

                    {{-- Sección 1: Datos del paciente --}}
                    <div class="form-step" data-step="0">
                        <h2 class="text-lg font-bold text-gray-900 font-serif mb-5 flex items-center gap-2">
                            <span class="w-7 h-7 bg-medico-azul-100 text-medico-azul-700 rounded-full flex items-center justify-center text-sm font-bold shrink-0">1</span>
                            Tus datos personales
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('nombre') border-red-400 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Apellido <span class="text-red-500">*</span></label>
                                <input type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Tu apellido"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('apellido') border-red-400 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                                <input type="tel" name="telefono" value="{{ old('telefono') }}" placeholder="+51 999 000 000"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('telefono') border-red-400 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">DNI / Documento</label>
                                <input type="text" name="dni" value="{{ old('dni') }}" placeholder="12345678"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                                <select name="sexo" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                                    <option value="">Selecciona...</option>
                                    <option value="M" {{ old('sexo') === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('sexo') === 'F' ? 'selected' : '' }}>Femenino</option>
                                    <option value="O" {{ old('sexo') === 'O' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="button" onclick="nextStep()" class="px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white font-semibold rounded-xl transition flex items-center gap-2">
                                Siguiente
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Sección 2: Especialidad y doctor --}}
                    <div class="form-step hidden" data-step="1">
                        <h2 class="text-lg font-bold text-gray-900 font-serif mb-5 flex items-center gap-2">
                            <span class="w-7 h-7 bg-medico-azul-100 text-medico-azul-700 rounded-full flex items-center justify-center text-sm font-bold shrink-0">2</span>
                            Especialidad y médico
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad <span class="text-red-500">*</span></label>
                                <select name="especialidad_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('especialidad_id') border-red-400 @enderror">
                                    <option value="">Selecciona una especialidad</option>
                                    @foreach($especialidades as $esp)
                                        <option value="{{ $esp->id }}" {{ old('especialidad_id') == $esp->id ? 'selected' : '' }}>
                                            {{ $esp->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Médico preferido</label>
                                <select name="doctor_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                                    <option value="">Sin preferencia</option>
                                    @foreach($doctores as $doc)
                                        <option value="{{ $doc->id }}" {{ old('doctor_id') == $doc->id ? 'selected' : '' }}>
                                            Dr/a. {{ $doc->nombre_completo }}
                                            @if($doc->especialidad) — {{ $doc->especialidad->nombre }} @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                                <select name="servicio_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm">
                                    <option value="">Selecciona un servicio (opcional)</option>
                                    @foreach($servicios as $serv)
                                        <option value="{{ $serv->id }}" {{ old('servicio_id') == $serv->id ? 'selected' : '' }}>
                                            {{ $serv->nombre }}
                                            @if($serv->precio) — S/ {{ number_format($serv->precio, 2) }} @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-between">
                            <button type="button" onclick="prevStep()" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Anterior
                            </button>
                            <button type="button" onclick="nextStep()" class="px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white font-semibold rounded-xl transition flex items-center gap-2">
                                Siguiente
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Sección 3: Fecha y hora --}}
                    <div class="form-step hidden" data-step="2">
                        <h2 class="text-lg font-bold text-gray-900 font-serif mb-5 flex items-center gap-2">
                            <span class="w-7 h-7 bg-medico-azul-100 text-medico-azul-700 rounded-full flex items-center justify-center text-sm font-bold shrink-0">3</span>
                            Fecha y hora preferida
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha <span class="text-red-500">*</span></label>
                                <input type="date" name="fecha" value="{{ old('fecha') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('fecha') border-red-400 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Hora <span class="text-red-500">*</span></label>
                                <select name="hora" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm @error('hora') border-red-400 @enderror">
                                    <option value="">Selecciona un horario</option>
                                    @foreach($horarios as $h)
                                        <option value="{{ $h }}" {{ old('hora') === $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-between">
                            <button type="button" onclick="prevStep()" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Anterior
                            </button>
                            <button type="button" onclick="nextStep()" class="px-6 py-3 bg-medico-azul-600 hover:bg-medico-azul-700 text-white font-semibold rounded-xl transition flex items-center gap-2">
                                Siguiente
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Sección 4: Confirmar --}}
                    <div class="form-step hidden" data-step="3">
                        <h2 class="text-lg font-bold text-gray-900 font-serif mb-5 flex items-center gap-2">
                            <span class="w-7 h-7 bg-medico-azul-100 text-medico-azul-700 rounded-full flex items-center justify-center text-sm font-bold shrink-0">4</span>
                            Confirma tu cita
                        </h2>
                        <div class="bg-gray-50 rounded-xl p-6 space-y-4 mb-6">
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-500 text-sm">Paciente</span>
                                <span class="text-gray-900 font-medium text-sm text-right" id="resumen-nombre">—</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-500 text-sm">Teléfono</span>
                                <span class="text-gray-900 font-medium text-sm" id="resumen-telefono">—</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-500 text-sm">Especialidad</span>
                                <span class="text-gray-900 font-medium text-sm text-right" id="resumen-especialidad">—</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-500 text-sm">Médico</span>
                                <span class="text-gray-900 font-medium text-sm text-right" id="resumen-doctor">Sin preferencia</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-500 text-sm">Fecha y hora</span>
                                <span class="text-gray-900 font-medium text-sm" id="resumen-fecha">—</span>
                            </div>
                            <div>
                                <span class="text-gray-500 text-sm block mb-1">Motivo</span>
                                <p class="text-gray-900 text-sm bg-white p-3 rounded-lg border border-gray-200" id="resumen-motivo">Sin motivo especificado</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Motivo de la consulta (opcional)</label>
                            <textarea name="motivo" rows="3" placeholder="Describe brevemente el motivo de tu consulta..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medico-azul-400 text-gray-800 text-sm resize-none">{{ old('motivo') }}</textarea>
                        </div>
                        <div class="mt-8 flex justify-between">
                            <button type="button" onclick="prevStep()" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Anterior
                            </button>
                            <button type="submit"
                                class="px-8 py-4 bg-medico-azul-600 hover:bg-medico-azul-700 text-white font-semibold rounded-xl transition text-base flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Solicitar cita
                            </button>
                        </div>
                        <p class="mt-4 text-center text-xs text-gray-400">
                            Tu cita quedará en estado <strong>pendiente</strong> hasta que te confirmemos por teléfono o email.
                        </p>
                    </div>
                </form>

                {{-- JavaScript para el wizard --}}
                <script>
                    let currentStep = 0;
                    const totalSteps = 4;

                    function updateStepper() {
                        // Actualizar círculos y etiquetas del stepper
                        document.querySelectorAll('#stepper [data-step]').forEach((btn, index) => {
                            const circle = btn.querySelector('.step-circle');
                            const label = btn.querySelector('.step-label');

                            if (index === currentStep) {
                                circle.className = 'step-circle flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold transition-all duration-200 bg-medico-azul-600 text-white';
                                label.className = 'step-label text-sm hidden sm:block transition-all duration-200 text-medico-azul-600 font-semibold';
                            } else if (index < currentStep) {
                                circle.className = 'step-circle flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold transition-all duration-200 bg-medico-verde-500 text-white cursor-pointer hover:bg-medico-verde-600';
                                label.className = 'step-label text-sm hidden sm:block transition-all duration-200 text-medico-verde-600 font-medium';
                            } else {
                                circle.className = 'step-circle flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold transition-all duration-200 bg-gray-100 text-gray-400 group-hover:bg-gray-200';
                                label.className = 'step-label text-sm hidden sm:block transition-all duration-200 text-gray-400 group-hover:text-gray-600';
                            }
                        });

                        // Actualizar líneas entre pasos
                        document.querySelectorAll('.step-line').forEach((line, index) => {
                            if (index < currentStep) {
                                line.classList.remove('bg-gray-200');
                                line.classList.add('bg-medico-verde-300');
                            } else {
                                line.classList.remove('bg-medico-verde-300');
                                line.classList.add('bg-gray-200');
                            }
                        });

                        // Mostrar/ocultar secciones del formulario
                        document.querySelectorAll('.form-step').forEach((step, index) => {
                            if (index === currentStep) {
                                step.classList.remove('hidden');
                            } else {
                                step.classList.add('hidden');
                            }
                        });

                        // Actualizar resumen en paso 4
                        if (currentStep === 3) {
                            updateResumen();
                        }
                    }

                    function goToStep(step) {
                        if (step >= 0 && step < totalSteps) {
                            currentStep = step;
                            updateStepper();
                        }
                    }

                    function nextStep() {
                        if (currentStep < totalSteps - 1) {
                            currentStep++;
                            updateStepper();
                        }
                    }

                    function prevStep() {
                        if (currentStep > 0) {
                            currentStep--;
                            updateStepper();
                        }
                    }

                    function updateResumen() {
                        const nombre = document.querySelector('input[name="nombre"]')?.value || '';
                        const apellido = document.querySelector('input[name="apellido"]')?.value || '';
                        const telefono = document.querySelector('input[name="telefono"]')?.value || '';
                        const fecha = document.querySelector('input[name="fecha"]')?.value || '';
                        const hora = document.querySelector('select[name="hora"]')?.value || '';
                        const motivo = document.querySelector('textarea[name="motivo"]')?.value || '';

                        const especialidadSelect = document.querySelector('select[name="especialidad_id"]');
                        const especialidad = especialidadSelect?.options[especialidadSelect.selectedIndex]?.text || '—';

                        const doctorSelect = document.querySelector('select[name="doctor_id"]');
                        const doctor = doctorSelect?.value ? doctorSelect.options[doctorSelect.selectedIndex]?.text : 'Sin preferencia';

                        document.getElementById('resumen-nombre').textContent = nombre + (apellido ? ' ' + apellido : '') || '—';
                        document.getElementById('resumen-telefono').textContent = telefono || '—';
                        document.getElementById('resumen-especialidad').textContent = especialidad !== 'Selecciona una especialidad' ? especialidad : '—';
                        document.getElementById('resumen-doctor').textContent = doctor;
                        document.getElementById('resumen-fecha').textContent = (fecha && hora) ? fecha + ' a las ' + hora : '—';
                        document.getElementById('resumen-motivo').textContent = motivo || 'Sin motivo especificado';
                    }

                    // Inicializar
                    document.addEventListener('DOMContentLoaded', function() {
                        updateStepper();
                    });
                </script>
            </div>

            {{-- Alternativa por teléfono --}}
            <div class="mt-8 bg-medico-verde-50 border border-medico-verde-100 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left">
                <div class="w-14 h-14 bg-medico-verde-500 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">¿Prefieres llamarnos?</p>
                    <p class="text-sm text-gray-500 mt-1">También puedes agendar tu cita por teléfono. Atendemos de Lunes a Viernes 8am–8pm.</p>
                </div>
                <a href="tel:+5112345678" class="inline-flex items-center gap-2 px-6 py-3 bg-medico-verde-500 hover:bg-medico-verde-600 text-white rounded-xl font-medium transition shrink-0">
                    Llamar ahora
                </a>
            </div>

        </div>
    </section>
</x-app-layout>

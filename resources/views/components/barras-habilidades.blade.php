<!-- Barras de Habilidades Animadas -->
<!-- 📁 Archivo: resources/views/components/barras-habilidades.blade.php -->

@props([
    'habilidades' => [],
    'titulo' => 'Áreas de Especialización'
])

<section 
    class="py-20 bg-white"
    x-data="skillsAnimation()"
    x-intersect="startAnimation = true"
>
    <div class="px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <!-- Título -->
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl font-serif">
                {{ $titulo }}
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Experiencia y dominio en diversas áreas médicas
            </p>
        </div>

        @php
            $habilidadesDefault = [
                ['nombre' => 'Cardiología Clínica', 'porcentaje' => 95, 'color' => 'medico-azul'],
                ['nombre' => 'Ecocardiografía', 'porcentaje' => 90, 'color' => 'medico-verde'],
                ['nombre' => 'Medicina Preventiva', 'porcentaje' => 85, 'color' => 'medico-azul'],
                ['nombre' => 'Diagnóstico Clínico', 'porcentaje' => 92, 'color' => 'medico-verde'],
                ['nombre' => 'Atención al Paciente', 'porcentaje' => 98, 'color' => 'medico-azul'],
            ];
            $habilidades = !empty($habilidades) ? $habilidades : $habilidadesDefault;
        @endphp

        <!-- Lista de habilidades -->
        <div class="space-y-8">
            @foreach($habilidades as $index => $habilidad)
                <div 
                    class="group"
                    x-data="{ visible: false, width: 0 }"
                    x-intersect="visible = true"
                    x-init="
                        $watch('startAnimation', (value) => {
                            if(value && visible) {
                                setTimeout(() => {
                                    width = {{ $habilidad['porcentaje'] }};
                                }, {{ $index * 150 }});
                            }
                        })
                    "
                >
                    <!-- Encabezado de la habilidad -->
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-{{ $habilidad['color'] }}-600 transition-colors">
                            {{ $habilidad['nombre'] }}
                        </h3>
                        <span 
                            class="text-lg font-bold text-{{ $habilidad['color'] }}-600"
                            x-text="width + '%'"
                        >
                            0%
                        </span>
                    </div>

                    <!-- Barra de progreso -->
                    <div class="relative h-4 bg-gray-200 rounded-full overflow-hidden">
                        <!-- Fondo decorativo -->
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-100 to-gray-200"></div>
                        
                        <!-- Barra animada -->
                        <div 
                            class="absolute inset-y-0 left-0 rounded-full transition-all duration-1000 ease-out bg-gradient-to-r 
                            {{ $habilidad['color'] === 'medico-azul' ? 'from-medico-azul-400 to-medico-azul-600' : 'from-medico-verde-400 to-medico-verde-600' }}"
                            :style="'width: ' + width + '%'"
                        >
                            <!-- Efecto de brillo -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse"></div>
                        </div>

                        <!-- Marcadores de porcentaje -->
                        <div class="absolute inset-0 flex justify-between items-center px-2">
                            @for($i = 25; $i <= 75; $i += 25)
                                <div class="w-0.5 h-2 bg-gray-300 rounded-full opacity-50"></div>
                            @endfor
                        </div>
                    </div>

                    <!-- Descripción opcional -->
                    @if(isset($habilidad['descripcion']))
                        <p class="mt-2 text-sm text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $habilidad['descripcion'] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Resumen de habilidades -->
        <div class="mt-12 p-6 bg-gradient-to-r from-medico-azul-50 to-medico-verde-50 rounded-2xl">
            <div class="flex items-center justify-center space-x-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-medico-azul-600">{{ count($habilidades) }}</div>
                    <div class="text-sm text-gray-600">Especialidades</div>
                </div>
                <div class="w-px h-12 bg-gray-300"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-medico-verde-600">
                        {{ round(collect($habilidades)->avg('porcentaje')) }}%
                    </div>
                    <div class="text-sm text-gray-600">Promedio</div>
                </div>
                <div class="w-px h-12 bg-gray-300"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-medico-azul-600">15+</div>
                    <div class="text-sm text-gray-600">Años Exp.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function skillsAnimation() {
    return {
        startAnimation: false,
    }
}
</script>
